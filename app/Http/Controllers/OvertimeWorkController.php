<?php

namespace App\Http\Controllers;

<<<<<<< Updated upstream:app/Http/Controllers/OvertimeWorkController.php
use App\Models\OvertimeWork;
=======
use App\Models\Settings;
use App\Services\BackupService;
>>>>>>> Stashed changes:app/Http/Controllers/SettingsController.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OvertimeWorkController extends Controller
{
    protected $backupService;

    public function __construct(BackupService $backupService)
    {
        $this->backupService = $backupService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
<<<<<<< Updated upstream:app/Http/Controllers/OvertimeWorkController.php
        //
=======
        $backups = $this->backupService->getBackups();
        return view('settings.index', compact('backups'));
    }

    /**
     * Create backup
     */
    public function createBackup(Request $request)
    {
        $request->validate([
            'include_database' => 'boolean',
            'note' => 'nullable|string|max:500'
        ]);

        $includeDatabase = $request->input('include_database', true);
        $note = $request->input('note');

        $result = $this->backupService->createBackup($includeDatabase, $note);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => 'Backup created successfully!',
                'filename' => $result['filename'],
                'size' => $result['size']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Backup failed: ' . $result['message']
            ], 500);
        }
    }

    /**
     * Download backup file
     */
    public function downloadBackup($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (!file_exists($filePath)) {
            abort(404, 'Backup file not found');
        }

        return Response::download($filePath);
    }

    /**
     * Delete backup file
     */
    public function deleteBackup($filename)
    {
        $result = $this->backupService->deleteBackup($filename);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Backup deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Backup file not found'
            ], 404);
        }
    }

    /**
     * Restore from backup
     */
    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|mimes:zip|max:102400' // 100MB max
        ]);

        $file = $request->file('backup_file');
        $tempPath = storage_path('app/backups/temp_' . time() . '.zip');
        
        // Move uploaded file to temp location
        $file->move(storage_path('app/backups'), basename($tempPath));

        // Restore
        $result = $this->backupService->restore($tempPath);

        // Cleanup temp file
        if (file_exists($tempPath)) {
            unlink($tempPath);
        }

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => 'System restored successfully! Please refresh the page.',
                'restored_at' => $result['restored_at']
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Restore failed: ' . $result['message']
            ], 500);
        }
>>>>>>> Stashed changes:app/Http/Controllers/SettingsController.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OvertimeWork $overtimeWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OvertimeWork $overtimeWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OvertimeWork $overtimeWork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OvertimeWork $overtimeWork)
    {
        //
    }
}