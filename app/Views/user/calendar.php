<?= $this->include('layouts/user/header', ['title' => 'Calendar • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Calendar</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="btn-group me-3" role="group">
                    <button class="btn btn-outline-secondary btn-sm" id="prevMonthBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="currentMonthBtn">
                        <span id="currentMonth">March 2024</span>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="nextMonthBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-calendar me-1"></i> View
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item active" href="#"><i class="fas fa-calendar-alt me-2"></i> Month</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-week me-2"></i> Week</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-day me-2"></i> Day</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="addEventBtn">
                    <i class="fas fa-plus me-1"></i> Add Event
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

        <!-- Calendar Stats -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: #6366f1;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-value" id="totalEvents">18</div>
                    <div class="stat-label">This Month</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value" id="completedEvents">12</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: #f59e0b;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-value" id="pendingEvents">4</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.2); color: #ef4444;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value" id="overdueEvents">2</div>
                    <div class="stat-label">Overdue</div>
                </div>
            </div>
        </div>

        <!-- Calendar Container -->
        <div class="stat-card">
            <!-- Calendar Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>March 2024</h5>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" class="form-control" placeholder="Search events..." id="eventSearch">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary" id="todayBtn">
                        <i class="fas fa-calendar-day me-1"></i> Today
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-container">
                <!-- Day Headers -->
                <div class="calendar-week-header">
                    <div class="calendar-day-header">Sun</div>
                    <div class="calendar-day-header">Mon</div>
                    <div class="calendar-day-header">Tue</div>
                    <div class="calendar-day-header">Wed</div>
                    <div class="calendar-day-header">Thu</div>
                    <div class="calendar-day-header">Fri</div>
                    <div class="calendar-day-header">Sat</div>
                </div>

                <!-- Calendar Days -->
                <div class="calendar-grid">
                    <!-- Week 1 -->
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day">
                        <div class="day-number">1</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Project Kickoff</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">2</div>
                    </div>

                    <!-- Week 2 -->
                    <div class="calendar-day">
                        <div class="day-number">3</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(16, 185, 129, 0.2); border-left-color: #10b981;">
                                <div class="event-title">Design Review</div>
                                <div class="event-project">Portfolio Website</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">4</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">5</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(245, 158, 11, 0.2); border-left-color: #f59e0b;">
                                <div class="event-title">API Research</div>
                                <div class="event-project">API Integration</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">6</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">7</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Sprint Planning</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">8</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">9</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(16, 185, 129, 0.2); border-left-color: #10b981;">
                                <div class="event-title">Code Review</div>
                                <div class="event-project">E-commerce Backend</div>
                            </div>
                        </div>
                    </div>

                    <!-- Week 3 -->
                    <div class="calendar-day">
                        <div class="day-number">10</div>
                        <div class="day-events">
                            <div class="calendar-event completed" style="background-color: rgba(16, 185, 129, 0.2); border-left-color: #10b981;">
                                <div class="event-title">Design System</div>
                                <div class="event-project">Portfolio Website</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">11</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Dashboard UI</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                            <div class="calendar-event" style="background-color: rgba(245, 158, 11, 0.2); border-left-color: #f59e0b;">
                                <div class="event-title">Mobile Design</div>
                                <div class="event-project">Mobile App</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">12</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">13</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">14</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Project Setup</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">15</div>
                        <div class="day-events">
                            <div class="calendar-event completed" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Project Setup</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                                <div class="event-status"><i class="fas fa-check"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">16</div>
                    </div>

                    <!-- Week 4 -->
                    <div class="calendar-day">
                        <div class="day-number">17</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">18</div>
                        <div class="day-events">
                            <div class="calendar-event overdue" style="background-color: rgba(239, 68, 68, 0.2); border-left-color: #ef4444;">
                                <div class="event-title">API Documentation</div>
                                <div class="event-project">API Integration</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day today">
                        <div class="day-number">19</div>
                        <div class="day-badge">Today</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Dashboard Tests</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                            <div class="calendar-event" style="background-color: rgba(16, 185, 129, 0.2); border-left-color: #10b981;">
                                <div class="event-title">Authentication</div>
                                <div class="event-project">E-commerce Backend</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">20</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(99, 102, 241, 0.2); border-left-color: #6366f1;">
                                <div class="event-title">Design Dashboard</div>
                                <div class="event-project">ChegeOS Dashboard</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">21</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">22</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(245, 158, 11, 0.2); border-left-color: #f59e0b;">
                                <div class="event-title">Database Schema</div>
                                <div class="event-project">E-commerce Backend</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">23</div>
                    </div>

                    <!-- Week 5 -->
                    <div class="calendar-day">
                        <div class="day-number">24</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">25</div>
                        <div class="day-events">
                            <div class="calendar-event" style="background-color: rgba(245, 158, 11, 0.2); border-left-color: #f59e0b;">
                                <div class="event-title">Mobile UI</div>
                                <div class="event-project">Mobile App</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">26</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">27</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">28</div>
                        <div class="day-events">
                            <div class="calendar-event overdue" style="background-color: rgba(239, 68, 68, 0.2); border-left-color: #ef4444;">
                                <div class="event-title">Rate Limiting</div>
                                <div class="event-project">API Integration</div>
                            </div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">29</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">30</div>
                    </div>

                    <!-- Week 6 -->
                    <div class="calendar-day">
                        <div class="day-number">31</div>
                    </div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                    <div class="calendar-day empty-day"></div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-list-ul me-2"></i>Upcoming Events</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Event</th>
                                <th>Project</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="small">Today</td>
                                <td>
                                    <strong>Dashboard Unit Tests</strong>
                                    <div class="small text-muted">Write unit tests for dashboard</div>
                                </td>
                                <td><span class="badge bg-primary">ChegeOS</span></td>
                                <td><span class="badge bg-warning">In Progress</span></td>
                                <td class="small">2:00 PM - 4:00 PM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">Mar 20</td>
                                <td>
                                    <strong>Design Dashboard Layout</strong>
                                    <div class="small text-muted">Create wireframes</div>
                                </td>
                                <td><span class="badge bg-primary">ChegeOS</span></td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td class="small">10:00 AM - 12:00 PM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">Mar 22</td>
                                <td>
                                    <strong>Database Schema Setup</strong>
                                    <div class="small text-muted">Design database tables</div>
                                </td>
                                <td><span class="badge bg-success">E-commerce</span></td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td class="small">3:00 PM - 5:00 PM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="small">Mar 25</td>
                                <td>
                                    <strong>Mobile App UI Design</strong>
                                    <div class="small text-muted">React Native components</div>
                                </td>
                                <td><span class="badge bg-warning">Mobile App</span></td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                                <td class="small">11:00 AM - 1:00 PM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Project Distribution</h5>
                    <div class="project-distribution">
                        <div class="distribution-item">
                            <div class="d-flex justify-content-between">
                                <span>ChegeOS Dashboard</span>
                                <span class="text-muted">8 events</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: 44%"></div>
                            </div>
                        </div>
                        <div class="distribution-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>API Integration</span>
                                <span class="text-muted">4 events</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: 22%"></div>
                            </div>
                        </div>
                        <div class="distribution-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>E-commerce Backend</span>
                                <span class="text-muted">3 events</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 17%"></div>
                            </div>
                        </div>
                        <div class="distribution-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Portfolio Website</span>
                                <span class="text-muted">2 events</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: 11%"></div>
                            </div>
                        </div>
                        <div class="distribution-item mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Mobile App</span>
                                <span class="text-muted">1 event</span>
                            </div>
                            <div class="progress mt-1" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: 6%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Calendar Styles */
        .calendar-container {
            background-color: #0f172a;
            border-radius: var(--border-radius);
            border: 1px solid #334155;
            padding: 1rem;
        }

        .calendar-week-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            margin-bottom: 1rem;
        }

        .calendar-day-header {
            text-align: center;
            padding: 0.5rem;
            font-weight: 600;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            min-height: 500px;
        }

        .calendar-day {
            background-color: #1e293b;
            border: 1px solid #334155;
            padding: 0.5rem;
            min-height: 100px;
            position: relative;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background-color: #1e293b;
            border-color: #475569;
        }

        .calendar-day.today {
            background-color: rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
        }

        .calendar-day.empty-day {
            background-color: #0f172a;
            border-color: #0f172a;
        }

        .day-number {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: #e2e8f0;
        }

        .day-badge {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background-color: #6366f1;
            color: white;
            font-size: 0.7rem;
            padding: 0.1rem 0.4rem;
            border-radius: 3px;
        }

        .day-events {
            overflow-y: auto;
            max-height: calc(100% - 2rem);
        }

        .calendar-event {
            background-color: rgba(99, 102, 241, 0.1);
            border-left: 3px solid #6366f1;
            border-radius: 4px;
            padding: 0.4rem;
            margin-bottom: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-event:hover {
            transform: translateX(2px);
        }

        .calendar-event.completed {
            opacity: 0.7;
        }

        .calendar-event.overdue {
            border-left-color: #ef4444;
            background-color: rgba(239, 68, 68, 0.1);
        }

        .event-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 0.1rem;
        }

        .event-project {
            font-size: 0.7rem;
            color: #94a3b8;
        }

        .event-status {
            position: absolute;
            top: 0.3rem;
            right: 0.3rem;
            color: #10b981;
            font-size: 0.8rem;
        }

        .project-distribution {
            padding: 0.5rem 0;
        }

        .distribution-item {
            margin-bottom: 0.5rem;
        }

        /* Scrollbar Styling */
        .day-events::-webkit-scrollbar {
            width: 4px;
        }

        .day-events::-webkit-scrollbar-track {
            background: transparent;
        }

        .day-events::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 2px;
        }
    </style>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-plus me-2"></i>Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEventForm">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Event Title *</label>
                            <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="eventDescription" rows="2" placeholder="Describe the event..."></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="eventProject" class="form-label">Project</label>
                                <select class="form-select" id="eventProject">
                                    <option value="chegeos">ChegeOS Dashboard</option>
                                    <option value="api">API Integration</option>
                                    <option value="mobile">Mobile App</option>
                                    <option value="portfolio">Portfolio Website</option>
                                    <option value="ecommerce">E-commerce Backend</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="eventDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="eventDate" value="2024-03-19">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="eventStartTime" class="form-label">Start Time</label>
                                <input type="time" class="form-control" id="eventStartTime" value="14:00">
                            </div>
                            <div class="col-md-6">
                                <label for="eventEndTime" class="form-label">End Time</label>
                                <input type="time" class="form-control" id="eventEndTime" value="16:00">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="eventStatus" class="form-label">Status</label>
                            <select class="form-select" id="eventStatus">
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEventBtn">Save Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Calendar Page JavaScript -->
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

            // Add Event button
            $('#addEventBtn').click(function() {
                $('#addEventModal').modal('show');
            });

            // Save event
            $('#saveEventBtn').click(function() {
                const eventTitle = $('#eventTitle').val();
                const description = $('#eventDescription').val();
                const project = $('#eventProject').val();
                const date = $('#eventDate').val();

                if (!eventTitle) {
                    showToast('Please enter an event title', 'danger');
                    return;
                }

                showToast(`Event "${eventTitle}" added successfully!`, 'success');

                // Reset form and close modal
                $('#addEventForm')[0].reset();
                $('#addEventModal').modal('hide');
            });

            // Today button
            $('#todayBtn').click(function() {
                const today = new Date();
                const day = today.getDate();
                const month = today.toLocaleString('default', { month: 'long' });
                const year = today.getFullYear();

                showToast(`Navigated to today: ${month} ${day}, ${year}`, 'info');

                // Highlight today's cell
                $('.calendar-day').removeClass('today');
                $(`.calendar-day .day-number:contains("${day}")`).closest('.calendar-day').addClass('today');
            });

            // Previous month
            $('#prevMonthBtn').click(function() {
                showToast('Navigating to previous month', 'info');
                // In real app, this would reload calendar with previous month
            });

            // Next month
            $('#nextMonthBtn').click(function() {
                showToast('Navigating to next month', 'info');
                // In real app, this would reload calendar with next month
            });

            // Event search
            $('#eventSearch').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();

                $('.calendar-event').each(function() {
                    const eventText = $(this).text().toLowerCase();
                    if (eventText.includes(searchTerm) || searchTerm === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Calendar event click
            $(document).on('click', '.calendar-event', function() {
                const eventTitle = $(this).find('.event-title').text();
                const project = $(this).find('.event-project').text();
                showToast(`Event: ${eventTitle} (${project})`, 'info');
            });

            // View event button in table
            $(document).on('click', '.btn-outline-info', function() {
                const eventTitle = $(this).closest('tr').find('strong').text();
                showToast(`Viewing event: ${eventTitle}`, 'info');
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