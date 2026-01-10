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
                        <div class="d-flex align-items-center" style="width: 500px;">
                            <select class="form-select me-2" id="quickProjectSelect">
                                <option value="">Select Project</option>
                                <option value="chegeos">ChegeOS Dashboard</option>
                                <option value="api">API Integration</option>
                                <option value="mobile">Mobile App</option>
                                <option value="portfolio">Portfolio Website</option>
                                <option value="ecommerce">E-commerce Backend</option>
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
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: #6366f1;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-value" id="todayTime">3.5</div>
                    <div class="stat-label">Today</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                    <div class="stat-value" id="weekTime">18.5</div>
                    <div class="stat-label">This Week</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: #f59e0b;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-value" id="monthTime">42.5</div>
                    <div class="stat-label">This Month</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.2); color: #ef4444;">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <div class="stat-value" id="avgDaily">4.2</div>
                    <div class="stat-label">Avg Daily (hrs)</div>
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
                                <th>Date</th>
                                <th>Project</th>
                                <th>Task</th>
                                <th>Duration</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="small">Today<br><span class="text-muted">2:00 PM - 4:30 PM</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: #6366f1;">
                                            <i class="fas fa-project-diagram" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span>ChegeOS Dashboard</span>
                                    </div>
                                </td>
                                <td>Dashboard UI Design</td>
                                <td><strong class="text-success">2.5 hours</strong></td>
                                <td class="small">Improved sidebar and card designs</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="small">Today<br><span class="text-muted">10:00 AM - 11:00 AM</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: #10b981;">
                                            <i class="fas fa-server" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span>E-commerce Backend</span>
                                    </div>
                                </td>
                                <td>Authentication System</td>
                                <td><strong class="text-success">1.0 hour</strong></td>
                                <td class="small">JWT implementation and testing</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="small">Yesterday<br><span class="text-muted">3:00 PM - 5:30 PM</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: #6366f1;">
                                            <i class="fas fa-project-diagram" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span>ChegeOS Dashboard</span>
                                    </div>
                                </td>
                                <td>Projects Page Development</td>
                                <td><strong class="text-success">2.5 hours</strong></td>
                                <td class="small">Built table view with filters</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="small">Mar 17<br><span class="text-muted">9:00 AM - 12:00 PM</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: #f59e0b;">
                                            <i class="fas fa-mobile-alt" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span>Mobile App</span>
                                    </div>
                                </td>
                                <td>UI Component Design</td>
                                <td><strong class="text-success">3.0 hours</strong></td>
                                <td class="small">React Native component library</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="small">Mar 16<br><span class="text-muted">1:00 PM - 4:00 PM</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="width: 24px; height: 24px; background-color: #0ea5e9;">
                                            <i class="fas fa-globe" style="font-size: 0.7rem;"></i>
                                        </div>
                                        <span>Portfolio Website</span>
                                    </div>
                                </td>
                                <td>Responsive Design</td>
                                <td><strong class="text-success">3.0 hours</strong></td>
                                <td class="small">Mobile responsiveness testing</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt-3">
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-history me-1"></i> Load More Entries
                        </button>
                    </div>
                </div>
            </div>

            <!-- Project Breakdown & Reports -->
            <div class="col-lg-4">
                <!-- Project Time Breakdown -->
                <div class="stat-card mb-4">
                    <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Project Time Breakdown</h5>
                    <div class="time-breakdown">
                        <div class="breakdown-item">
                            <div class="d-flex justify-content-between">
                                <span>ChegeOS Dashboard</span>
                                <span class="text-muted">8.5 hrs (46%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: 46%"></div>
                            </div>
                        </div>
                        <div class="breakdown-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>E-commerce Backend</span>
                                <span class="text-muted">4.0 hrs (22%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 22%"></div>
                            </div>
                        </div>
                        <div class="breakdown-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Portfolio Website</span>
                                <span class="text-muted">3.0 hrs (16%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: 16%"></div>
                            </div>
                        </div>
                        <div class="breakdown-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Mobile App</span>
                                <span class="text-muted">2.0 hrs (11%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: 11%"></div>
                            </div>
                        </div>
                        <div class="breakdown-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>API Integration</span>
                                <span class="text-muted">1.0 hr (5%)</span>
                            </div>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar bg-danger" style="width: 5%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Productivity -->
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Weekly Productivity</h5>
                    <div class="weekly-chart">
                        <div class="d-flex justify-content-between align-items-end mb-3" style="height: 120px;">
                            <div class="text-center">
                                <div class="chart-bar" style="height: 40%; background-color: #6366f1;"></div>
                                <div class="small mt-1">Mon</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 60%; background-color: #10b981;"></div>
                                <div class="small mt-1">Tue</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 80%; background-color: #f59e0b;"></div>
                                <div class="small mt-1">Wed</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 100%; background-color: #6366f1;"></div>
                                <div class="small mt-1">Thu</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 70%; background-color: #10b981;"></div>
                                <div class="small mt-1">Fri</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 30%; background-color: #ef4444;"></div>
                                <div class="small mt-1">Sat</div>
                            </div>
                            <div class="text-center">
                                <div class="chart-bar" style="height: 20%; background-color: #8b5cf6;"></div>
                                <div class="small mt-1">Sun</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>2.0 hrs</span>
                            <span>3.0 hrs</span>
                            <span>4.0 hrs</span>
                            <span>5.0 hrs</span>
                            <span>3.5 hrs</span>
                            <span>1.5 hrs</span>
                            <span>1.0 hrs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Manual Entry Modal -->
    <div class="modal fade" id="manualEntryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-clock me-2"></i>Manual Time Entry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="manualEntryForm">
                        <div class="mb-3">
                            <label for="entryProject" class="form-label">Project *</label>
                            <select class="form-select" id="entryProject" required>
                                <option value="">Select Project</option>
                                <option value="chegeos">ChegeOS Dashboard</option>
                                <option value="api">API Integration</option>
                                <option value="mobile">Mobile App</option>
                                <option value="portfolio">Portfolio Website</option>
                                <option value="ecommerce">E-commerce Backend</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="entryTask" class="form-label">Task / Description *</label>
                            <input type="text" class="form-control" id="entryTask" placeholder="What did you work on?" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="entryDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="entryDate" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="entryDuration" class="form-label">Duration (hours)</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="entryDuration" value="1.0" step="0.25" min="0.25">
                                    <span class="input-group-text">hours</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="entryNotes" class="form-label">Notes</label>
                            <textarea class="form-control" id="entryNotes" rows="3" placeholder="Additional notes about this work..."></textarea>
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

            // Timer variables
            let timerInterval = null;
            let timerSeconds = 0;
            let isTimerRunning = false;
            let isTimerPaused = false;

            // Start timer
            $('#startTimerBtn').click(function() {
                const project = $('#quickProjectSelect').val();
                const task = $('#quickTaskInput').val();

                if (!project || !task) {
                    showToast('Please select a project and enter a task', 'warning');
                    return;
                }

                // Show active timer section
                $('#quickStartSection').hide();
                $('#activeTimerSection').show();
                $('#currentTask').text(task);

                // Start timer
                startTimer();
                showToast(`Started tracking time for: ${task}`, 'success');
            });

            // Stop timer
            $('#stopTimerBtn').click(function() {
                stopTimer();

                const task = $('#currentTask').text();
                const hours = (timerSeconds / 3600).toFixed(2);

                // Show confirmation
                showToast(`Stopped timer. Logged ${hours} hours for: ${task}`, 'info');

                // Reset UI
                $('#quickStartSection').show();
                $('#activeTimerSection').hide();
                $('#quickProjectSelect').val('');
                $('#quickTaskInput').val('');

                // Update today's time
                const currentTime = parseFloat($('#todayTime').text());
                $('#todayTime').text((currentTime + parseFloat(hours)).toFixed(1));
            });

            // Pause/Resume timer
            $('#pauseTimerBtn').click(function() {
                if (isTimerPaused) {
                    resumeTimer();
                    $(this).html('<i class="fas fa-pause me-1"></i> Pause');
                    showToast('Timer resumed', 'info');
                } else {
                    pauseTimer();
                    $(this).html('<i class="fas fa-play me-1"></i> Resume');
                    showToast('Timer paused', 'warning');
                }
            });

            // Manual entry button
            $('#manualEntryBtn').click(function() {
                $('#manualEntryModal').modal('show');
            });

            // Save manual entry
            $('#saveEntryBtn').click(function() {
                const project = $('#entryProject').val();
                const task = $('#entryTask').val();
                const duration = $('#entryDuration').val();

                if (!project || !task || !duration) {
                    showToast('Please fill all required fields', 'warning');
                    return;
                }

                showToast(`Time entry saved: ${duration} hours for ${task}`, 'success');

                // Update stats
                const currentTime = parseFloat($('#todayTime').text());
                $('#todayTime').text((currentTime + parseFloat(duration)).toFixed(1));

                // Reset form and close modal
                $('#manualEntryForm')[0].reset();
                $('#manualEntryModal').modal('hide');
            });

            // Timer functions
            function startTimer() {
                timerSeconds = 0;
                isTimerRunning = true;
                isTimerPaused = false;
                updateTimerDisplay();

                timerInterval = setInterval(function() {
                    if (!isTimerPaused) {
                        timerSeconds++;
                        updateTimerDisplay();
                    }
                }, 1000);
            }

            function pauseTimer() {
                isTimerPaused = true;
                $('#timerDisplay').removeClass('timer-pulse');
            }

            function resumeTimer() {
                isTimerPaused = false;
                $('#timerDisplay').addClass('timer-pulse');
            }

            function stopTimer() {
                clearInterval(timerInterval);
                isTimerRunning = false;
                isTimerPaused = false;
                timerSeconds = 0;
                $('#timerDisplay').removeClass('timer-pulse');
            }

            function updateTimerDisplay() {
                const hours = Math.floor(timerSeconds / 3600);
                const minutes = Math.floor((timerSeconds % 3600) / 60);
                const seconds = timerSeconds % 60;

                $('#timerDisplay').text(
                    `${hours.toString().padStart(2, '0')}:` +
                    `${minutes.toString().padStart(2, '0')}:` +
                    `${seconds.toString().padStart(2, '0')}`
                );

                if (isTimerRunning && !isTimerPaused) {
                    $('#timerDisplay').addClass('timer-pulse');
                }
            }

            // Edit time entry
            $(document).on('click', '.btn-outline-warning', function() {
                const task = $(this).closest('tr').find('td:nth-child(3)').text();
                showToast(`Editing time entry for: ${task}`, 'info');
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

            // Simulate time updates (demo only)
            setInterval(function() {
                if (isTimerRunning && !isTimerPaused) {
                    // Update weekly total when timer is running
                    const weekTime = parseFloat($('#weekTime').text());
                    $('#weekTime').text((weekTime + 0.0003).toFixed(1)); // Add 1 second in hours
                }
            }, 1000);
        });
    </script>

<?= $this->include('layouts/user/footer') ?>