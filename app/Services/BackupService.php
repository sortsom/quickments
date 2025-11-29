<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Carbon\Carbon;

class BackupService
{
    protected $backupPath;
    protected $timestamp;

    public function __construct()
    {
        $this->backupPath = storage_path('app/backups');
        $this->timestamp = Carbon::now()->format('Y-m-d_His');
        
        // Create backup directory if it doesn't exist
        if (!File::exists($this->backupPath)) {
            File::makeDirectory($this->backupPath, 0755, true);
        }
    }

    /**
     * Create a complete backup
     */
    public function createBackup($includeDatabase = true, $note = null)
    {
        try {
            $backupFolder = $this->backupPath . '/' . $this->timestamp;
            File::makeDirectory($backupFolder, 0755, true);

            $manifest = [
                'created_at' => now()->toDateTimeString(),
                'note' => $note,
                'includes' => []
            ];

            // 1. Backup Database
            if ($includeDatabase) {
                $this->backupDatabase($backupFolder);
                $manifest['includes'][] = 'database';
            }

            // 2. Backup uploaded files (photos)
            $this->backupFiles($backupFolder);
            $manifest['includes'][] = 'files';

            // 3. Create manifest file
            File::put(
                $backupFolder . '/manifest.json',
                json_encode($manifest, JSON_PRETTY_PRINT)
            );

            // 4. Create ZIP file
            $zipFileName = "backup_{$this->timestamp}.zip";
            $zipFilePath = $this->backupPath . '/' . $zipFileName;
            
            $this->createZip($backupFolder, $zipFilePath);

            // 5. Cleanup temporary folder
            File::deleteDirectory($backupFolder);

            return [
                'success' => true,
                'filename' => $zipFileName,
                'path' => $zipFilePath,
                'size' => $this->formatBytes(filesize($zipFilePath))
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Backup all database tables
     */
    protected function backupDatabase($backupFolder)
    {
        $dbFolder = $backupFolder . '/database';
        File::makeDirectory($dbFolder, 0755, true);

        // Get all tables
        $tables = [
            'users',
            'members',
            'roles',
            'attendances',
            'attendance_details',
            'leave_types',
            'request_leaves',
            'holidays',
            'worktimes',
            'weeklies',
            'statuses',
            'settings',
            'cache',
            'cache_locks',
            'jobs',
            'job_batches',
            'failed_jobs',
            'password_reset_tokens',
            'sessions'
        ];

        foreach ($tables as $table) {
            if (DB::getSchemaBuilder()->hasTable($table)) {
                $data = DB::table($table)->get()->toArray();
                File::put(
                    $dbFolder . '/' . $table . '.json',
                    json_encode($data, JSON_PRETTY_PRINT)
                );
            }
        }
    }

    /**
     * Backup uploaded files
     */
    protected function backupFiles($backupFolder)
    {
        $filesFolder = $backupFolder . '/files';
        File::makeDirectory($filesFolder, 0755, true);

        // Backup public storage (user photos, avatars, etc.)
        $publicPath = public_path('storage');
        
        if (File::exists($publicPath)) {
            File::copyDirectory($publicPath, $filesFolder . '/storage');
        }

        // Backup storage/app/public
        $storagePath = storage_path('app/public');
        if (File::exists($storagePath)) {
            File::copyDirectory($storagePath, $filesFolder . '/app_public');
        }
    }

    /**
     * Create ZIP archive
     */
    protected function createZip($source, $destination)
    {
        if (!extension_loaded('zip')) {
            throw new \Exception('ZIP extension is not loaded');
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZipArchive::CREATE)) {
            throw new \Exception('Cannot create ZIP file');
        }

        $source = realpath($source);

        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($source) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
    }

    /**
     * Restore from backup
     */
    public function restore($zipFilePath)
    {
        try {
            $extractPath = $this->backupPath . '/restore_' . time();
            File::makeDirectory($extractPath, 0755, true);

            // Extract ZIP
            $zip = new ZipArchive();
            if ($zip->open($zipFilePath) !== true) {
                throw new \Exception('Cannot open backup file');
            }
            $zip->extractTo($extractPath);
            $zip->close();

            // Read manifest
            $manifestPath = $extractPath . '/manifest.json';
            if (!File::exists($manifestPath)) {
                throw new \Exception('Invalid backup file: manifest not found');
            }

            $manifest = json_decode(File::get($manifestPath), true);

            // Restore database
            if (in_array('database', $manifest['includes'])) {
                $this->restoreDatabase($extractPath . '/database');
            }

            // Restore files
            if (in_array('files', $manifest['includes'])) {
                $this->restoreFiles($extractPath . '/files');
            }

            // Cleanup
            File::deleteDirectory($extractPath);

            return [
                'success' => true,
                'message' => 'Backup restored successfully',
                'restored_at' => now()->toDateTimeString()
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Restore database tables
     */
    protected function restoreDatabase($dbFolder)
    {
        $jsonFiles = File::files($dbFolder);

        foreach ($jsonFiles as $file) {
            $tableName = pathinfo($file, PATHINFO_FILENAME);
            $data = json_decode(File::get($file), true);

            if (!empty($data) && DB::getSchemaBuilder()->hasTable($tableName)) {
                // Disable foreign key checks
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                
                // Truncate table
                DB::table($tableName)->truncate();

                // Insert data in chunks
                $chunks = array_chunk($data, 100);
                foreach ($chunks as $chunk) {
                    // Convert objects to arrays
                    $chunk = array_map(function($item) {
                        return (array) $item;
                    }, $chunk);
                    
                    DB::table($tableName)->insert($chunk);
                }

                // Re-enable foreign key checks
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            }
        }
    }

    /**
     * Restore files
     */
    protected function restoreFiles($filesFolder)
    {
        // Restore to public/storage
        if (File::exists($filesFolder . '/storage')) {
            $publicPath = public_path('storage');
            if (File::exists($publicPath)) {
                File::deleteDirectory($publicPath);
            }
            File::copyDirectory($filesFolder . '/storage', $publicPath);
        }

        // Restore to storage/app/public
        if (File::exists($filesFolder . '/app_public')) {
            $storagePath = storage_path('app/public');
            if (File::exists($storagePath)) {
                File::deleteDirectory($storagePath);
            }
            File::copyDirectory($filesFolder . '/app_public', $storagePath);
        }
    }

    /**
     * Get list of available backups
     */
    public function getBackups()
    {
        $backups = [];
        $files = File::files($this->backupPath);

        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'zip') {
                $backups[] = [
                    'filename' => basename($file),
                    'path' => $file,
                    'size' => $this->formatBytes(filesize($file)),
                    'created_at' => date('Y-m-d H:i:s', filemtime($file))
                ];
            }
        }

        return collect($backups)->sortByDesc('created_at')->values()->all();
    }

    /**
     * Delete a backup file
     */
    public function deleteBackup($filename)
    {
        $filePath = $this->backupPath . '/' . $filename;
        
        if (File::exists($filePath)) {
            File::delete($filePath);
            return true;
        }
        
        return false;
    }

    /**
     * Format bytes to human readable
     */
    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}