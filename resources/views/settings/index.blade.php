<x-app-layout>
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h3>{{ __('កំណត់') }}</h3>
            </div>
            @if (in_array(Auth::user()->role->role, ['owner']))
                <div class="d-print-none col-auto ms-auto">
                    <!-- Add any header buttons here if needed -->
                </div>
            @endif
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tab-appearance" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-palette me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25"></path>
                                        <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    </svg>
                                    Appearance
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-backup" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-export me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3"></path>
                                        <path d="M4 6v6c0 1.657 3.582 3 8 3c1.118 0 2.182 -.086 3.15 -.241"></path>
                                        <path d="M20 12v-6"></path>
                                        <path d="M4 12v6c0 1.657 3.582 3 8 3c.157 0 .312 -.002 .466 -.005"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16l3 3l-3 3"></path>
                                    </svg>
                                    Backup
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tab-restore" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database-import me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 6c0 1.657 3.582 3 8 3s8 -1.343 8 -3s-3.582 -3 -8 -3s-8 1.343 -8 3"></path>
                                        <path d="M4 6v6c0 1.657 3.582 3 8 3c.856 0 1.68 -.05 2.454 -.144"></path>
                                        <path d="M20 12v-6"></path>
                                        <path d="M4 12v6c0 1.657 3.582 3 8 3c.171 0 .341 -.002 .51 -.006"></path>
                                        <path d="M16 19l-3 -3l3 -3"></path>
                                        <path d="M13 19h9"></path>
                                    </svg>
                                    Restore
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Appearance Tab -->
                            <div class="tab-pane active show" id="tab-appearance" role="tabpanel">
                                <h3 class="card-title">Appearance Settings</h3>
                                <p class="text-secondary">Customize the look and feel of your application.</p>
                                <!-- Add your appearance settings here -->
                            </div>

                            <!-- Backup Tab -->
                            <div class="tab-pane" id="tab-backup" role="tabpanel">
                                <h3 class="card-title">Backup</h3>
                                <p class="text-secondary">បង្កើត backup សម្រាប់ប្រព័ន្ធគ្រប់គ្រងរបស់លោកអ្នក (theme, font, options ...) និងទិន្នន័យនៅក្នុងប្រព័ន្ធទាំងអស់។</p>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" id="includeDatabase" checked>
                                                <span class="form-check-label">System Settings (Theme, Fonts, Options)</span>
                                            </label>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" class="form-check-input" id="includeDatabaseData" checked disabled>
                                                <span class="form-check-label">Database (optional)</span>
                                            </label>
                                            <small class="form-hint">បើជ្រើសរើស នឹងបង្កើត backup ទិន្នន័យទាំងអស់</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Backup Note (optional)</label>
                                            <textarea class="form-control" id="backupNote" rows="3" placeholder="e.g. Before big update..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary" id="createBackupBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 11l5 5l5 -5"></path>
                                            <path d="M12 4l0 12"></path>
                                        </svg>
                                        Create Backup File
                                    </button>
                                </div>

                                <!-- Backup List -->
                                <hr class="my-4">
                                <h4 class="mb-3">Available Backups</h4>
                                
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Size</th>
                                                <th>Created At</th>
                                                <th class="w-1">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="backupList">
                                            @forelse($backups as $backup)
                                            <tr>
                                                <td>{{ $backup['filename'] }}</td>
                                                <td><span class="badge bg-azure-lt">{{ $backup['size'] }}</span></td>
                                                <td>{{ $backup['created_at'] }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('settings.backup.download', $backup['filename']) }}" class="btn btn-sm btn-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                                                <path d="M7 11l5 5l5 -5"></path>
                                                                <path d="M12 4l0 12"></path>
                                                            </svg>
                                                            Download
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger delete-backup" data-filename="{{ $backup['filename'] }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-secondary">គ្មាន backup ទេ។ សូមបង្កើតថ្មី!</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Restore Tab -->
                            <div class="tab-pane" id="tab-restore" role="tabpanel">
                                <h3 class="card-title">Restore</h3>
                                <p class="text-secondary">ស្ដារប្រព័ន្ធពី backup file ដែលបានរក្សាទុក។</p>

                                <div class="alert alert-warning" role="alert">
                                    <h4 class="alert-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 9v4"></path>
                                            <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                        ការព្រមាន!
                                    </h4>
                                    <div class="text-secondary">
                                        ការ restore ប្រព័ន្ធនឹងលុបទិន្នន័យបច្ចុប្បន្នទាំងអស់ និងជំនួសដោយទិន្នន័យពី backup file។ សូមប្រាកដថាអ្នកបានបង្កើត backup ថ្មីមុនពេល restore!
                                    </div>
                                </div>

                                <form id="restoreForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">ជ្រើសរើស Backup File (.zip)</label>
                                        <input type="file" class="form-control" id="backupFile" name="backup_file" accept=".zip" required>
                                    </div>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-restore me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3.06 13a9 9 0 1 0 .49 -4.087"></path>
                                                <path d="M3 4.001v5h5"></path>
                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                            </svg>
                                            Restore System
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Create Backup
        document.getElementById('createBackupBtn').addEventListener('click', function() {
            const btn = this;
            const originalHtml = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating backup...';

            const includeDatabase = document.getElementById('includeDatabase').checked;
            const note = document.getElementById('backupNote').value;

            fetch('{{ route("settings.backup.create") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    include_database: includeDatabase,
                    note: note
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ Backup created successfully!\n\nFile: ' + data.filename + '\nSize: ' + data.size);
                    location.reload();
                } else {
                    alert('❌ Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('❌ Error creating backup: ' + error);
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        });

        // Delete Backup
        document.querySelectorAll('.delete-backup').forEach(button => {
            button.addEventListener('click', function() {
                const filename = this.dataset.filename;
                
                if (!confirm('Are you sure you want to delete this backup?\n\n' + filename)) {
                    return;
                }

                fetch(`/settings/backup/delete/${filename}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('✅ Backup deleted successfully!');
                        location.reload();
                    } else {
                        alert('❌ Error: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('❌ Error deleting backup: ' + error);
                });
            });
        });

        // Restore System
        document.getElementById('restoreForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!confirm('⚠️ WARNING!\n\nThis will replace ALL current data with the backup data.\n\nAre you absolutely sure you want to continue?')) {
                return;
            }

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalHtml = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Restoring...';

            fetch('{{ route("settings.backup.restore") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ System restored successfully!\n\nThe page will reload now.');
                    window.location.reload();
                } else {
                    alert('❌ Error: ' + data.message);
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHtml;
                }
            })
            .catch(error => {
                alert('❌ Error restoring system: ' + error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalHtml;
            });
        });
    </script>
    @endpush
</x-app-layout>