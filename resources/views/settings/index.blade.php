<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="css/style.css">
    <div class="page-header d-print-none" aria-label="Page header">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Overview</div>
                    <h3>កំណត់</h3>
                </div>
                <div class="d-print-none col-auto ms-auto">
                    <!-- You can put a Save button here too if you want -->
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

            <!-- Tabs -->
            <ul class="nav nav-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#tab-settings-appearance" class="nav-link active" data-bs-toggle="tab">
                        🎨 Appearance
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-settings-backup" class="nav-link" data-bs-toggle="tab">
                        💾 Backup
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#tab-settings-restore" class="nav-link" data-bs-toggle="tab">
                        ♻️ Restore
                    </a>
                </li>
            </ul>

            <div class="card">
                <div class="card-body">
                    <div class="tab-content">

                        <!-- Appearance Tab -->
                        <div class="tab-pane active show" id="tab-settings-appearance">
                            <h3 class="card-title mb-3">System Theme</h3>
                            <form method="POST" action="#">
                                <!-- @csrf in Blade -->
                                <div class="row g-3">

                                    <!-- System font -->
                                    <div class="col-md-6">
                                        <label class="form-label">System Font</label>
                                        <select name="system_font" class="form-select">
                                            <option value="system-ui">System Default</option>
                                            <option value="inter">Inter</option>
                                            <option value="roboto">Roboto</option>
                                            <option value="noto-sans-khmer">Noto Sans Khmer</option>
                                        </select>
                                        <small class="form-hint">
                                            ជ្រើសរើសពុម្ពអក្សរសម្រាប់ប្រព័ន្ធទាំងមូល។
                                        </small>
                                    </div>

                                    <!-- Theme mode -->
                                    <div class="col-md-6">
                                        <label class="form-label">Theme Mode</label>
                                        <select name="theme_mode" class="form-select">
                                            <option value="system">Follow System</option>
                                            <option value="light">Light</option>
                                            <option value="dark">Dark</option>
                                        </select>
                                        <small class="form-hint">
                                            Light / Dark ឬតាមប្រព័ន្ធ។
                                        </small>
                                    </div>

                                    <!-- Primary color -->
                                    <div class="col-md-6">
                                        <label class="form-label">Primary Color</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Color</span>
                                            <input type="color" name="primary_color" value="#206bc4"
                                                class="form-control form-control-color" />
                                        </div>
                                        <small class="form-hint">
                                            ពណ៌សម្រាប់ប៊ូតុង និង link ចម្បង។
                                        </small>
                                    </div>

                                    <!-- Accent color -->
                                    <div class="col-md-6">
                                        <label class="form-label">Accent Color</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Color</span>
                                            <input type="color" name="accent_color" value="#12b886"
                                                class="form-control form-control-color" />
                                        </div>
                                    </div>

                                    <!-- Save button -->
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Save Theme Settings
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Backup Tab -->
                        <div class="tab-pane" id="tab-settings-backup">
                            <h3 class="card-title mb-3">Backup</h3>
                            <p class="text-muted">
                                បង្កើត backup សម្រាប់ការកំណត់ប្រព័ន្ធ (theme, font, options…)
                                និងទិន្នន័យដែលអ្នកកំណត់។
                            </p>

                            <form method="POST" action="#">
                                <!-- @csrf in Blade -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Include</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="backup_settings"
                                                id="backup_settings" checked>
                                            <label class="form-check-label" for="backup_settings">
                                                System Settings (Theme, Fonts, Options)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="backup_database"
                                                id="backup_database">
                                            <label class="form-check-label" for="backup_database">
                                                Database (optional)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Backup Note (optional)</label>
                                        <textarea name="backup_note" class="form-control" rows="2" placeholder="e.g. Before big update…"></textarea>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Create Backup File
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Restore Tab -->
                        <div class="tab-pane" id="tab-settings-restore">
                            <h3 class="card-title mb-3">Restore</h3>
                            <p class="text-muted">
                                Restore ពី backup file មួយ។ សូមប្រុងប្រយ័ត្ន ព្រោះវាអាចប្តូរការកំណត់បច្ចុប្បន្ន។
                            </p>

                            <form method="POST" action="#" enctype="multipart/form-data">
                                <!-- @csrf in Blade -->
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Backup File (.zip / .json)</label>
                                        <input type="file" name="backup_file" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Restore Options</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="restore_settings"
                                                id="restore_settings" checked>
                                            <label class="form-check-label" for="restore_settings">
                                                Restore System Settings Only
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="restore_database"
                                                id="restore_database">
                                            <label class="form-check-label" for="restore_database">
                                                Restore Database (danger)
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-danger">
                                            Restore From Backup
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div><!-- /tab-content -->
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
