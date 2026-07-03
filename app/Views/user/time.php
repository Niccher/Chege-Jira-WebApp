<?= $this->include('layouts/user/header', ['title' => 'Time Tracking • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Time Tracking</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar me-1"></i> This Week
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item active" href="#"><i class="fas fa-calendar-week me-2"></i> This Week</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-alt me-2"></i> This Month</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-day me-2"></i> Today</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-filter me-2"></i> Custom Range</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="manualEntryBtn">
                    <i class="fas fa-plus me-1"></i> Manual Entry
                </button>

                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                        JD
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Active Timer Section -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="stat-card" id="activeTimerSection" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><i class="fas fa-clock me-2 text-primary"></i>Currently Tracking</h5>
                            <p class="small text-muted mb-0">Working on: <span id="currentTask">ChegeOS Dashboard UI</span></p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="display-4 me-4" id="timerDisplay">00:00:00</div>
                            <button class="btn btn-success btn-lg me-2" id="stopTimerBtn">
                                <i class="fas fa-stop me-1"></i> Stop
                            </button>
                            <button class="btn btn-outline-secondary btn-lg" id="pauseTimerBtn">
                                <i class="fas fa-pause me-1"></i> Pause
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Start Timer -->
                <div class="stat-card" id="quickStartSection">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1"><i class="fas fa-play-circle me-2 text-success"></i>Quick Start Timer</h5>
                            <p class="small text-muted mb-0">Start tracking time for a task</p>
                        </div>
                        <div class="d-flex align-items-center" style="width: 600px;">
                            <select class="form-select me-2" id="quickProjectSelect">
                                <option value="">Select Project</option>
                                <?php foreach ($projects as $project): ?>
                                    <option value="<?= $project['id'] ?>"><?= esc($project['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="form-control me-2" id="quickTaskInput" placeholder="Task description...">
                            <button class="btn btn-primary btn-lg" id="startTimerBtn">
                                <i class="fas fa-play me-1"></i> Start
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Tracking Stats -->
        <div class="row mb-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Today (hrs)</div>
                    <div class="stat-value" id="todayTime"><?= $todayTime ?></div>
                    <div class="stat-change text-secondary mt-3 font-mono border-top pt-2">
                        <i class="fas fa-clock"></i> Logged today
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">This Week (hrs)</div>
                    <div class="stat-value text-primary" id="weekTime"><?= $weekTime ?></div>
                    <div class="stat-change text-primary mt-3 font-mono border-top border-primary border-opacity-25 pt-2">
                        <i class="fas fa-calendar-week"></i> Current week
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">This Month (hrs)</div>
                    <div class="stat-value text-warning" id="monthTime"><?= $monthTime ?></div>
                    <div class="stat-change text-warning mt-3 font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-calendar-alt"></i> Current month
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="stat-label mb-2">Avg Daily (hrs)</div>
                    <div class="stat-value text-success" id="avgDaily"><?= $avgDaily ?></div>
                    <div class="stat-change text-success mt-3 font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-tachometer-alt"></i> Daily pace
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Logs & Reports -->
        <div class="row">
            <!-- Time Entries -->
            <div class="col-lg-8">
                <div class="stat-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Time Entries</h5>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary active">All</button>
                            <button class="btn btn-sm btn-outline-secondary">Today</button>
                            <button class="btn btn-sm btn-outline-secondary">This Week</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-dark" id="timeEntriesTable">
                            <thead>
                            <tr>
                                <th>Date / Time</th>
                                <th>Project</th>
                                <th>Task</th>
                                <th>Duration</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($time_logs)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No time entries found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($time_logs as $log): ?>
                                <tr>
                                    <td class="small">
                                        <?= date('M d', strtotime($log['start_time'])) ?><br>
                                        <span class="text-muted"><?= date('H:i', strtotime($log['start_time'])) ?> - <?= $log['end_time'] ? date('H:i', strtotime($log['end_time'])) : '...' ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: <?= $log['project_color'] ?? '#64748b' ?>;">
                                                <i class="fas fa-project-diagram" style="font-size: 0.7rem;"></i>
                                            </div>
                                            <span><?= esc($log['project_name'] ?? 'Personal') ?></span>
                                        </div>
                                    </td>
                                    <td><?= esc($log['task_name']) ?></td>
                                    <td><strong class="text-success"><?= round(($log['duration'] ?? 0) / 3600, 2) ?> hours</strong></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <?= $pager->links('time_logs', 'bootstrap_full') ?>
                    </div>
                </div>
            </div>

            <!-- Project Breakdown & Reports -->
            <div class="col-lg-4">
                <!-- Project Time Breakdown -->
                <div class="stat-card mb-4" id="projectBreakdownCard">
                    <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Project Time Breakdown</h5>
                    <div class="time-breakdown">
                        <?php if (empty($project_breakdown)): ?>
                            <p class="text-center py-3 text-muted">No data available.</p>
                        <?php else: ?>
                            <?php foreach ($project_breakdown as $item): 
                                $percent = round(($item['total_duration'] / $total_all_duration) * 100);
                            ?>
                            <div class="breakdown-item mb-3">
                                <div class="d-flex justify-content-between">
                                    <span><?= esc($item['name'] ?? 'Personal') ?></span>
                                    <span class="text-muted"><?= round($item['total_duration'] / 3600, 1) ?> hrs (<?= $percent ?>%)</span>
                                </div>
                                <div class="progress mt-1" style="height: 8px;">
                                    <div class="progress-bar" style="width: <?= $percent ?>%; background-color: <?= $item['color'] ?? '#64748b' ?>;"></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button class="btn btn-sm btn-outline-secondary <?= $breakdown_current_page <= 1 ? 'disabled' : '' ?>" 
                                onclick="window.location.search = '?page_breakdown=<?= $breakdown_current_page - 1 ?>'">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <span class="small text-muted">Page <?= $breakdown_current_page ?> of <?= $breakdown_total_pages ?></span>
                        <button class="btn btn-sm btn-outline-secondary <?= $breakdown_current_page >= $breakdown_total_pages ? 'disabled' : '' ?>"
                                onclick="window.location.search = '?page_breakdown=<?= $breakdown_current_page + 1 ?>'">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div> <!-- Close Main Row -->

    <!-- Manual Entry Modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-clock me-2"></i>Manual Time Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="manualEntryForm" action="<?= site_url('time/manual') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="entryProject" class="form-label">Project *</label>
                            <select class="form-select" id="entryProject" name="project_id" required>
                                <option value="">Select Project</option>
                                <?php foreach ($projects as $project): ?>
                                    <option value="<?= $project['id'] ?>"><?= esc($project['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="entryTask" class="form-label">Task / Description *</label>
                            <input type="text" class="form-control" id="entryTask" name="task_name" placeholder="What did you work on?" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="entryDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="entryDate" name="date" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="entryDuration" class="form-label">Duration (hours)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="entryDuration" name="duration" value="1.0" step="0.25" min="0.25">
                                    <span class="input-group-text">hours</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="entryNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="entryNotes" name="notes" rows="3" placeholder="Additional notes about this work..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEntryBtn">Save Entry</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <style>
        /* Time Tracking Styles */
        .breakdown-item, .distribution-item {
            margin-bottom: 1rem;
        }

        .chart-bar {
            width: 30px;
            border-radius: 4px 4px 0 0;
            transition: height 0.3s;
        }

        .weekly-chart {
            padding: 1rem;
        }

        /* Timer animation */
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .timer-pulse {
            animation: pulse 2s infinite;
        }
    </style>

    <!-- Time Tracking JavaScript -->
    <script>
        $(document).ready(function() {
            // Sidebar toggle logic (consistent across pages)
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('sidebar-collapsed');
                $('#mainContent').toggleClass('full-width');
                localStorage.setItem('sidebarCollapsed', $('#sidebar').hasClass('sidebar-collapsed'));
            });

            // Timer variables
            let timerInterval = null;
            let currentLogId = localStorage.getItem('active_timer_log_id');
            let startTimestamp = localStorage.getItem('active_timer_start');

            // Initialize timer on load if active
            if (currentLogId && startTimestamp) {
                resumeActiveTimer();
            }

            // Start timer
            $('#startTimerBtn').click(function() {
                const project = $('#quickProjectSelect').val();
                const task = $('#quickTaskInput').val();

                if (!project || !task) {
                    showToast('Please select a project and enter a task', 'warning');
                    return;
                }

                $.post('<?= site_url('time/start') ?>', {
                    project_id: project,
                    task_name: task
                }, function(response) {
                    if (response.status === 'success') {
                        currentLogId = response.id;
                        startTimestamp = Date.now();
                        
                        localStorage.setItem('active_timer_log_id', currentLogId);
                        localStorage.setItem('active_timer_start', startTimestamp);
                        localStorage.setItem('active_timer_task', task);

                        showActiveTimerUI(task, 0);
                        startTimerInterval(0);
                        showToast(`Started tracking time for: ${task}`, 'success');
                    }
                });
            });

            // Stop timer
            $('#stopTimerBtn').click(function() {
                if (!currentLogId) return;

                $.post('<?= site_url('time/stop') ?>/' + currentLogId, {}, function(response) {
                    if (response.status === 'success') {
                        clearInterval(timerInterval);
                        localStorage.removeItem('active_timer_log_id');
                        localStorage.removeItem('active_timer_start');
                        localStorage.removeItem('active_timer_task');
                        
                        showToast(`Time logged successfully!`, 'success');
                        setTimeout(() => window.location.reload(), 1500);
                    }
                });
            });

            // Manual entry button
            $('#manualEntryBtn').click(function() {
                $('#manualEntryModal').modal('show');
            });

            $('#saveEntryBtn').click(function() {
                $('#manualEntryForm').submit();
            });

            function resumeActiveTimer() {
                const task = localStorage.getItem('active_timer_task');
                const elapsedSeconds = Math.floor((Date.now() - parseInt(startTimestamp)) / 1000);
                
                showActiveTimerUI(task, elapsedSeconds);
                startTimerInterval(elapsedSeconds);
            }

            function showActiveTimerUI(task, initialSeconds) {
                $('#quickStartSection').hide();
                $('#activeTimerSection').show();
                $('#currentTask').text(task);
                updateTimerDisplay(initialSeconds);
            }

            function startTimerInterval(initialSeconds) {
                let seconds = initialSeconds;
                clearInterval(timerInterval);
                timerInterval = setInterval(function() {
                    seconds++;
                    updateTimerDisplay(seconds);
                }, 1000);
            }

            function updateTimerDisplay(totalSeconds) {
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                $('#timerDisplay').text(
                    `${hours.toString().padStart(2, '0')}:` +
                    `${minutes.toString().padStart(2, '0')}:` +
                    `${seconds.toString().padStart(2, '0')}`
                );
                $('#timerDisplay').addClass('timer-pulse');
            }

            function showToast(message, type = 'info') {
                const toastId = 'toast-' + Date.now();
                const toastHtml = `
                    <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">${message}</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>`;
                $('.toast-container').append(toastHtml);
                new bootstrap.Toast(document.getElementById(toastId)).show();
            }
        });
    </script>

<?= $this->include('layouts/user/footer') ?>