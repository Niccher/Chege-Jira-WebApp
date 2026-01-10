<?= $this->include('layouts/user/header', ['title' => 'Settings • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Settings</h1>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-sm me-2" id="saveSettingsBtn">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>

                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        JD
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item active" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Settings Navigation -->
        <div class="row mb-4">
            <div class="col-lg-3">
                <div class="stat-card">
                    <nav class="nav flex-column settings-nav">
                        <a class="nav-link active" href="#profile" data-bs-toggle="tab">
                            <i class="fas fa-user me-2"></i> Profile
                        </a>
                        <a class="nav-link" href="#appearance" data-bs-toggle="tab">
                            <i class="fas fa-palette me-2"></i> Appearance
                        </a>
                        <a class="nav-link" href="#notifications" data-bs-toggle="tab">
                            <i class="fas fa-bell me-2"></i> Notifications
                        </a>
                        <a class="nav-link" href="#projects" data-bs-toggle="tab">
                            <i class="fas fa-project-diagram me-2"></i> Projects
                        </a>
                        <a class="nav-link" href="#time-tracking" data-bs-toggle="tab">
                            <i class="fas fa-clock me-2"></i> Time Tracking
                        </a>
                        <a class="nav-link" href="#data" data-bs-toggle="tab">
                            <i class="fas fa-database me-2"></i> Data Management
                        </a>
                        <a class="nav-link" href="#account" data-bs-toggle="tab">
                            <i class="fas fa-shield-alt me-2"></i> Account & Security
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Settings Content -->
            <div class="col-lg-9">
                <div class="tab-content" id="settingsContent">
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="profile">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-user me-2"></i>Profile Settings</h5>

                            <form id="profileForm">
                                <div class="row mb-4">
                                    <div class="col-md-3 text-center">
                                        <div class="profile-avatar mb-3">
                                            <div class="user-avatar" style="width: 100px; height: 100px; font-size: 2rem;">
                                                JD
                                            </div>
                                            <button type="button" class="btn btn-sm btn-outline-secondary mt-2">
                                                <i class="fas fa-camera me-1"></i> Change
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstName" value="John">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" value="Developer">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email" value="john@example.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username" value="johndev">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Bio</label>
                                            <textarea class="form-control" id="bio" rows="3" placeholder="Tell us about yourself...">Full-stack developer passionate about side projects and productivity tools.</textarea>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="timezone" class="form-label">Timezone</label>
                                                <select class="form-select" id="timezone">
                                                    <option value="UTC-5" selected>EST (UTC-5)</option>
                                                    <option value="UTC-8">PST (UTC-8)</option>
                                                    <option value="UTC+0">GMT (UTC+0)</option>
                                                    <option value="UTC+1">CET (UTC+1)</option>
                                                    <option value="UTC+8">CST (UTC+8)</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="dateFormat" class="form-label">Date Format</label>
                                                <select class="form-select" id="dateFormat">
                                                    <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                                                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Appearance Tab -->
                    <div class="tab-pane fade" id="appearance">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-palette me-2"></i>Appearance Settings</h5>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="mb-3">Theme</h6>
                                    <div class="theme-selector">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="theme-option active" data-theme="dark">
                                                    <div class="theme-preview dark-theme">
                                                        <div class="preview-header"></div>
                                                        <div class="preview-sidebar"></div>
                                                        <div class="preview-content"></div>
                                                    </div>
                                                    <div class="theme-name text-center mt-2">Dark</div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="theme-option" data-theme="light">
                                                    <div class="theme-preview light-theme">
                                                        <div class="preview-header"></div>
                                                        <div class="preview-sidebar"></div>
                                                        <div class="preview-content"></div>
                                                    </div>
                                                    <div class="theme-name text-center mt-2">Light</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="theme-option" data-theme="auto">
                                                    <div class="theme-preview auto-theme">
                                                        <div class="preview-header"></div>
                                                        <div class="preview-sidebar"></div>
                                                        <div class="preview-content"></div>
                                                    </div>
                                                    <div class="theme-name text-center mt-2">Auto</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="mb-3">Accent Color</h6>
                                    <div class="color-selector">
                                        <div class="row">
                                            <?php
                                            $colors = [
                                                '#6366f1' => 'Indigo',
                                                '#10b981' => 'Emerald',
                                                '#f59e0b' => 'Amber',
                                                '#ef4444' => 'Red',
                                                '#8b5cf6' => 'Violet',
                                                '#0ea5e9' => 'Sky',
                                            ];
                                            ?>
                                            <?php foreach($colors as $hex => $name): ?>
                                                <div class="col-4 mb-3">
                                                    <div class="color-option <?= $hex == '#6366f1' ? 'active' : '' ?>" data-color="<?= $hex ?>">
                                                        <div class="color-preview" style="background-color: <?= $hex ?>;"></div>
                                                        <div class="color-name text-center small mt-1"><?= $name ?></div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Density</label>
                                        <div class="btn-group w-100" role="group">
                                            <input type="radio" class="btn-check" name="density" id="density-comfortable" checked>
                                            <label class="btn btn-outline-secondary" for="density-comfortable">Comfortable</label>

                                            <input type="radio" class="btn-check" name="density" id="density-compact">
                                            <label class="btn btn-outline-secondary" for="density-compact">Compact</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="animationsToggle" checked>
                                        <label class="form-check-label" for="animationsToggle">Enable animations</label>
                                    </div>

                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="sidebarCollapsedDefault">
                                        <label class="form-check-label" for="sidebarCollapsedDefault">Collapse sidebar by default</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Tab -->
                    <div class="tab-pane fade" id="notifications">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-bell me-2"></i>Notification Settings</h5>

                            <div class="mb-4">
                                <h6 class="mb-3">Email Notifications</h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailProjectUpdates" checked>
                                    <label class="form-check-label" for="emailProjectUpdates">Project updates and milestones</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailWeeklyReports" checked>
                                    <label class="form-check-label" for="emailWeeklyReports">Weekly productivity reports</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailProjectStalled">
                                    <label class="form-check-label" for="emailProjectStalled">Project stalled alerts</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">In-App Notifications</h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="inappDueDates" checked>
                                    <label class="form-check-label" for="inappDueDates">Upcoming due dates</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="inappAchievements" checked>
                                    <label class="form-check-label" for="inappAchievements">Achievements and streaks</label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="inappProductivityTips">
                                    <label class="form-check-label" for="inappProductivityTips">Productivity tips</label>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-3">Notification Frequency</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="notificationDigest" class="form-label">Email Digest</label>
                                        <select class="form-select" id="notificationDigest">
                                            <option value="daily">Daily</option>
                                            <option value="weekly" selected>Weekly</option>
                                            <option value="never">Never</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reminderTime" class="form-label">Daily Reminder Time</label>
                                        <input type="time" class="form-control" id="reminderTime" value="17:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Projects Tab -->
                    <div class="tab-pane fade" id="projects">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-project-diagram me-2"></i>Project Settings</h5>

                            <div class="mb-4">
                                <h6 class="mb-3">Default Project Settings</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="defaultPriority" class="form-label">Default Priority</label>
                                        <select class="form-select" id="defaultPriority">
                                            <option value="medium" selected>Medium</option>
                                            <option value="high">High</option>
                                            <option value="low">Low</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="defaultStatus" class="form-label">Default Status</label>
                                        <select class="form-select" id="defaultStatus">
                                            <option value="active" selected>Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="planning">Planning</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="autoArchiveCompleted" checked>
                                    <label class="form-check-label" for="autoArchiveCompleted">Auto-archive completed projects after 30 days</label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="showStalledAlerts" checked>
                                    <label class="form-check-label" for="showStalledAlerts">Show alerts for stalled projects (14+ days inactive)</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Kanban Board</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="defaultColumns" class="form-label">Default Columns</label>
                                        <select class="form-select" id="defaultColumns">
                                            <option value="4" selected>Planning, In Progress, Testing, Finished</option>
                                            <option value="3">Todo, Doing, Done</option>
                                            <option value="5">Backlog, Todo, In Progress, Review, Done</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="cardDensity" class="form-label">Card Density</label>
                                        <select class="form-select" id="cardDensity">
                                            <option value="comfortable" selected>Comfortable</option>
                                            <option value="compact">Compact</option>
                                            <option value="spacious">Spacious</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-3">Project Categories</h6>
                                <div class="mb-3">
                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        <span class="badge bg-primary p-2">Web <button class="btn btn-sm btn-link p-0 ms-1 text-white">&times;</button></span>
                                        <span class="badge bg-info p-2">Mobile <button class="btn btn-sm btn-link p-0 ms-1 text-white">&times;</button></span>
                                        <span class="badge bg-success p-2">API <button class="btn btn-sm btn-link p-0 ms-1 text-white">&times;</button></span>
                                        <span class="badge bg-warning p-2">Learning <button class="btn btn-sm btn-link p-0 ms-1 text-white">&times;</button></span>
                                        <span class="badge bg-dark p-2">Backend <button class="btn btn-sm btn-link p-0 ms-1 text-white">&times;</button></span>
                                    </div>
                                    <div class="input-group input-group-sm" style="width: 300px;">
                                        <input type="text" class="form-control" placeholder="Add new category...">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time Tracking Tab -->
                    <div class="tab-pane fade" id="time-tracking">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-clock me-2"></i>Time Tracking Settings</h5>

                            <div class="mb-4">
                                <h6 class="mb-3">Timer Settings</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="idleTimeout" class="form-label">Idle Timeout (minutes)</label>
                                        <input type="number" class="form-control" id="idleTimeout" value="5" min="1" max="60">
                                        <div class="form-text">Automatically pause timer after inactivity</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="roundingInterval" class="form-label">Rounding Interval (minutes)</label>
                                        <select class="form-select" id="roundingInterval">
                                            <option value="1">1 minute</option>
                                            <option value="5">5 minutes</option>
                                            <option value="15" selected>15 minutes</option>
                                            <option value="30">30 minutes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="autoStartBreak" checked>
                                    <label class="form-check-label" for="autoStartBreak">Auto-start break after 2 hours of work</label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="playTimerSound">
                                    <label class="form-check-label" for="playTimerSound">Play sound when timer starts/stops</label>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Weekly Goals</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="weeklyGoal" class="form-label">Weekly Goal (hours)</label>
                                        <input type="number" class="form-control" id="weeklyGoal" value="20" min="1" max="80">
                                        <div class="form-text">Target hours per week</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dailyGoal" class="form-label">Daily Goal (hours)</label>
                                        <input type="number" class="form-control" id="dailyGoal" value="4" min="1" max="12">
                                        <div class="form-text">Target hours per day</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-3">Reports</h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="autoWeeklyReport" checked>
                                    <label class="form-check-label" for="autoWeeklyReport">Send weekly time report every Monday</label>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="showBillableHours">
                                    <label class="form-check-label" for="showBillableHours">Show billable hours column</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Management Tab -->
                    <div class="tab-pane fade" id="data">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-database me-2"></i>Data Management</h5>

                            <div class="mb-4">
                                <h6 class="mb-3">Export Data</h6>
                                <p class="small text-muted mb-3">Export all your data for backup or migration.</p>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-file-csv me-2"></i> Export as CSV
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-file-excel me-2"></i> Export as Excel
                                        </button>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-file-archive me-2"></i> Full Backup
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Import Data</h6>
                                <p class="small text-muted mb-3">Import data from other project management tools.</p>
                                <div class="mb-3">
                                    <label for="importSource" class="form-label">Import From</label>
                                    <select class="form-select" id="importSource">
                                        <option value="">Select source...</option>
                                        <option value="trello">Trello</option>
                                        <option value="asana">Asana</option>
                                        <option value="notion">Notion</option>
                                        <option value="csv">CSV File</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="importFile" class="form-label">Upload File</label>
                                    <input class="form-control" type="file" id="importFile">
                                </div>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-upload me-2"></i> Start Import
                                </button>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Data Cleanup</h6>
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i> These actions cannot be undone.
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <button class="btn btn-outline-danger w-100" id="deleteOldProjectsBtn">
                                            <i class="fas fa-trash me-2"></i> Delete Archived Projects
                                        </button>
                                        <div class="form-text">Projects archived more than 1 year ago</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <button class="btn btn-outline-danger w-100" id="clearTimeLogsBtn">
                                            <i class="fas fa-clock me-2"></i> Clear Old Time Logs
                                        </button>
                                        <div class="form-text">Time logs older than 2 years</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h6 class="mb-3">Storage Usage</h6>
                                <div class="storage-usage">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="small">Used: 24.5 MB</span>
                                        <span class="small">Total: 1 GB</span>
                                    </div>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 2.45%;"></div>
                                    </div>
                                    <div class="small text-muted mt-1">2.45% of storage used</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account & Security Tab -->
                    <div class="tab-pane fade" id="account">
                        <div class="stat-card">
                            <h5 class="mb-4"><i class="fas fa-shield-alt me-2"></i>Account & Security</h5>

                            <div class="mb-4">
                                <h6 class="mb-3">Change Password</h6>
                                <form id="passwordForm">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="currentPassword" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="currentPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPassword">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmPassword">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="changePasswordBtn">
                                        <i class="fas fa-key me-1"></i> Change Password
                                    </button>
                                </form>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Two-Factor Authentication</h6>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> Two-factor authentication adds an extra layer of security to your account.
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="twoFactorToggle">
                                    <label class="form-check-label" for="twoFactorToggle">Enable two-factor authentication</label>
                                </div>
                                <button class="btn btn-outline-secondary">
                                    <i class="fas fa-qrcode me-2"></i> Setup Authenticator App
                                </button>
                            </div>

                            <div class="mb-4">
                                <h6 class="mb-3">Active Sessions</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-dark">
                                        <thead>
                                        <tr>
                                            <th>Device</th>
                                            <th>Location</th>
                                            <th>Last Active</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <i class="fas fa-desktop me-2"></i> Windows Chrome
                                            </td>
                                            <td>New York, US</td>
                                            <td>Just now</td>
                                            <td><span class="badge bg-success">Current</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fas fa-mobile-alt me-2"></i> iPhone Safari
                                            </td>
                                            <td>New York, US</td>
                                            <td>2 hours ago</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fas fa-desktop me-2"></i> MacOS Safari
                                            </td>
                                            <td>New York, US</td>
                                            <td>1 week ago</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-sign-out-alt me-1"></i> Logout All Other Devices
                                </button>
                            </div>

                            <div>
                                <h6 class="mb-3">Danger Zone</h6>
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i> These actions are irreversible. Proceed with caution.
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <button class="btn btn-outline-danger w-100" id="deactivateAccountBtn">
                                            <i class="fas fa-user-slash me-2"></i> Deactivate Account
                                        </button>
                                        <div class="form-text">Your data will be preserved for 30 days</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <button class="btn btn-danger w-100" id="deleteAccountBtn">
                                            <i class="fas fa-trash me-2"></i> Delete Account
                                        </button>
                                        <div class="form-text">All data will be permanently deleted</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Settings Styles */
        .settings-nav .nav-link {
            padding: 0.75rem 1rem;
            color: #cbd5e1;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .settings-nav .nav-link:hover {
            background-color: #334155;
            color: white;
        }

        .settings-nav .nav-link.active {
            background-color: #334155;
            color: white;
            border-left: 3px solid #6366f1;
        }

        /* Theme Selector */
        .theme-option {
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: all 0.2s;
        }

        .theme-option:hover {
            background-color: #334155;
        }

        .theme-option.active {
            border-color: #6366f1;
            background-color: rgba(99, 102, 241, 0.1);
        }

        .theme-preview {
            width: 100%;
            height: 100px;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .dark-theme {
            background-color: #0f172a;
            border: 1px solid #334155;
        }

        .light-theme {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
        }

        .auto-theme {
            background: linear-gradient(135deg, #0f172a 50%, #f8fafc 50%);
            border: 1px solid #334155;
        }

        .theme-preview .preview-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 20px;
            background-color: #1e293b;
        }

        .dark-theme .preview-header {
            background-color: #1e293b;
        }

        .light-theme .preview-header {
            background-color: #e2e8f0;
        }

        .auto-theme .preview-header {
            background: linear-gradient(90deg, #1e293b 50%, #e2e8f0 50%);
        }

        .theme-preview .preview-sidebar {
            position: absolute;
            left: 0;
            top: 20px;
            bottom: 0;
            width: 30px;
            background-color: #334155;
        }

        .dark-theme .preview-sidebar {
            background-color: #334155;
        }

        .light-theme .preview-sidebar {
            background-color: #cbd5e1;
        }

        .auto-theme .preview-sidebar {
            background: linear-gradient(180deg, #334155 50%, #cbd5e1 50%);
        }

        .theme-preview .preview-content {
            position: absolute;
            left: 30px;
            top: 20px;
            right: 0;
            bottom: 0;
            background-color: transparent;
        }

        .theme-name {
            font-weight: 500;
            color: #e2e8f0;
        }

        /* Color Selector */
        .color-option {
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            border: 2px solid transparent;
            transition: all 0.2s;
        }

        .color-option:hover {
            background-color: #334155;
        }

        .color-option.active {
            border-color: #6366f1;
            background-color: rgba(99, 102, 241, 0.1);
        }

        .color-preview {
            width: 100%;
            height: 40px;
            border-radius: 6px;
            margin-bottom: 0.25rem;
        }

        .color-name {
            color: #94a3b8;
        }

        /* Switch customization */
        .form-switch .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        /* Storage usage */
        .storage-usage {
            padding: 1rem;
            background-color: #1e293b;
            border-radius: 8px;
            border: 1px solid #334155;
        }

        /* Profile avatar */
        .profile-avatar .user-avatar {
            margin: 0 auto;
        }

        /* Toggle button group */
        .btn-group .btn-check:checked + .btn {
            background-color: #6366f1;
            border-color: #6366f1;
            color: white;
        }

        /* Alert customization */
        .alert {
            border: 1px solid;
            background-color: transparent;
        }

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            color: #93c5fd;
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #fcd34d;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #fca5a5;
        }
    </style>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Settings JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

            // Sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-collapsed');
                $('#mainContent').toggleClass('full-width');

                const icon = $(this).find('i');
                if (icon.hasClass('fa-bars')) {
                    icon.removeClass('fa-bars').addClass('fa-times');
                } else {
                    icon.removeClass('fa-times').addClass('fa-bars');
                }

                localStorage.setItem('sidebarCollapsed', $('#sidebar').hasClass('sidebar-collapsed'));
            });

            // Check saved sidebar state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                $('#sidebar').addClass('sidebar-collapsed');
                $('#mainContent').addClass('full-width');
                $('#sidebarToggle i').removeClass('fa-bars').addClass('fa-times');
            }

            // Save settings
            $('#saveSettingsBtn').click(function() {
                showToast('Settings saved successfully!', 'success');
            });

            // Theme selection
            $('.theme-option').click(function() {
                $('.theme-option').removeClass('active');
                $(this).addClass('active');

                const theme = $(this).data('theme');
                if (theme === 'dark') {
                    $('html').attr('data-bs-theme', 'dark');
                } else if (theme === 'light') {
                    $('html').attr('data-bs-theme', 'light');
                } else {
                    // Auto theme - would check system preference in real app
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    $('html').attr('data-bs-theme', prefersDark ? 'dark' : 'light');
                }

                localStorage.setItem('theme', theme);
                showToast(`Theme changed to ${theme}`, 'info');
            });

            // Color selection
            $('.color-option').click(function() {
                $('.color-option').removeClass('active');
                $(this).addClass('active');

                const color = $(this).data('color');
                document.documentElement.style.setProperty('--primary-color', color);
                localStorage.setItem('accentColor', color);
                showToast(`Accent color changed`, 'info');
            });

            // Change password
            $('#changePasswordBtn').click(function() {
                const current = $('#currentPassword').val();
                const newPass = $('#newPassword').val();
                const confirm = $('#confirmPassword').val();

                if (!current || !newPass || !confirm) {
                    showToast('Please fill all password fields', 'warning');
                    return;
                }

                if (newPass !== confirm) {
                    showToast('New passwords do not match', 'danger');
                    return;
                }

                if (newPass.length < 8) {
                    showToast('Password must be at least 8 characters', 'warning');
                    return;
                }

                showToast('Password changed successfully!', 'success');
                $('#passwordForm')[0].reset();
            });

            // Dangerous actions
            $('#deleteOldProjectsBtn').click(function() {
                if (confirm('Delete all archived projects older than 1 year? This action cannot be undone.')) {
                    showToast('Archived projects deleted successfully', 'success');
                }
            });

            $('#clearTimeLogsBtn').click(function() {
                if (confirm('Clear all time logs older than 2 years? This action cannot be undone.')) {
                    showToast('Old time logs cleared', 'success');
                }
            });

            $('#deactivateAccountBtn').click(function() {
                if (confirm('Deactivate your account? Your data will be preserved for 30 days.')) {
                    showToast('Account deactivation scheduled', 'warning');
                }
            });

            $('#deleteAccountBtn').click(function() {
                if (confirm('Permanently delete your account and all data? This action cannot be undone.')) {
                    showToast('Account deletion scheduled', 'danger');
                }
            });

            // Logout other session
            $('.btn-outline-danger').click(function() {
                const device = $(this).closest('tr').find('td:first').text();
                if (confirm(`Logout from ${device}?`)) {
                    $(this).closest('tr').fadeOut(300, function() {
                        $(this).remove();
                        showToast('Session logged out', 'info');
                    });
                }
            });

            // Settings navigation
            $('.settings-nav a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');

                $('.settings-nav a').removeClass('active');
                $(this).addClass('active');
            });

            // Toast notification function
            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
            <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        `;

                $('.toast-container').append(toastHtml);
                const toast = new bootstrap.Toast(document.getElementById(toastId));
                toast.show();

                $(`#${toastId}`).on('hidden.bs.toast', function() {
                    $(this).remove();
                });
            }
        });
    </script>

<?= $this->include('layouts/user/footer') ?>