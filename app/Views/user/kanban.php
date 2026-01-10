<?= $this->include('layouts/user/header', ['title' => 'Kanban Board • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Kanban Board</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="input-group input-group-sm me-3" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search tasks..." id="taskSearch">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="newTaskBtn">
                    <i class="fas fa-plus me-1"></i> New Task
                </button>

                <div class="dropdown me-2">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i> All Tasks</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> My Tasks</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i> High Priority</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-clock me-2"></i> Due This Week</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-tag me-2"></i> By Project</a></li>
                    </ul>
                </div>

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

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: #6366f1;">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-value" id="totalTasks">24</div>
                    <div class="stat-label">Total Tasks</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: #f59e0b;">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div class="stat-value" id="inProgress">8</div>
                    <div class="stat-label">In Progress</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.2); color: #ef4444;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value" id="blockedTasks">3</div>
                    <div class="stat-label">Blocked</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: #10b981;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-value" id="completedTasks">13</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>
        </div>

        <!-- Kanban Board -->
        <div class="kanban-board" id="kanbanBoard">
            <div class="row">
                <!-- Planning Column -->
                <div class="col-lg-3 mb-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-primary">
                            <h6 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Planning</h6>
                            <span class="badge bg-light text-dark">5</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="1" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Design Dashboard Layout</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> ChegeOS Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Create wireframes and design system for dashboard</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-warning">Medium</span>
                                            <span class="badge bg-info">Design</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Mar 20
                                        </div>
                                    </div>
                                </div>
                                <div class="kanban-card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-assignee">
                                            <div class="user-avatar" style="width: 24px; height: 24px; font-size: 0.7rem;">JD</div>
                                        </div>
                                        <div class="task-comments">
                                            <i class="fas fa-comment"></i> 3
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="2" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Setup Database Schema</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> E-commerce Backend
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Design and implement database tables</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-primary">High</span>
                                            <span class="badge bg-dark">Backend</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Mar 22
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="3" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Research API Integrations</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> API Integration
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Research GitHub, GitLab, and Jira APIs</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-secondary">Low</span>
                                            <span class="badge bg-success">Research</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-plus me-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- In Progress Column -->
                <div class="col-lg-3 mb-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-warning">
                            <h6 class="mb-0"><i class="fas fa-spinner me-2"></i>In Progress</h6>
                            <span class="badge bg-light text-dark">8</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="4" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Implement Authentication</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> E-commerce Backend
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">JWT authentication and user management</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-primary">High</span>
                                            <span class="badge bg-danger">Security</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Today
                                        </div>
                                    </div>
                                </div>
                                <div class="kanban-card-footer">
                                    <div class="task-progress">
                                        <div class="progress" style="height: 4px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                        <div class="small text-muted">75% complete</div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="5" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Mobile App UI Design</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> Mobile App
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Create React Native UI components</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-warning">Medium</span>
                                            <span class="badge bg-info">Mobile</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Mar 25
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card blocked-task" data-task-id="6" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">API Rate Limiting</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> API Integration
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Waiting for API documentation from team</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-primary">High</span>
                                            <span class="badge bg-danger">Blocked</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Mar 18
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-plus me-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testing Column -->
                <div class="col-lg-3 mb-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-info">
                            <h6 class="mb-0"><i class="fas fa-vial me-2"></i>Testing</h6>
                            <span class="badge bg-light text-dark">4</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="7" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Dashboard Unit Tests</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> ChegeOS Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Write unit tests for dashboard components</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-warning">Medium</span>
                                            <span class="badge bg-success">Testing</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar me-1"></i> Mar 19
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="8" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Mobile App QA</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> Mobile App
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Quality assurance testing on iOS and Android</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-primary">High</span>
                                            <span class="badge bg-info">QA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-plus me-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finished Column -->
                <div class="col-lg-3 mb-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-success">
                            <h6 class="mb-0"><i class="fas fa-check-circle me-2"></i>Finished</h6>
                            <span class="badge bg-light text-dark">13</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="9" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Project Setup</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> ChegeOS Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Initial project setup and configuration</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-secondary">Low</span>
                                            <span class="badge bg-dark">Setup</span>
                                        </div>
                                        <div class="task-date small text-success">
                                            <i class="fas fa-check me-1"></i> Mar 15
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="10" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="task-title">Design System</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram me-1"></i> Portfolio Website
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Created color palette and typography system</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="task-meta">
                                            <span class="badge bg-warning">Medium</span>
                                            <span class="badge bg-info">Design</span>
                                        </div>
                                        <div class="task-date small text-success">
                                            <i class="fas fa-check me-1"></i> Mar 10
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-plus me-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Kanban Board Styles */
        .kanban-column {
            background-color: #1e293b;
            border-radius: var(--border-radius);
            border: 1px solid #334155;
            height: calc(100vh - 300px);
            display: flex;
            flex-direction: column;
        }

        .kanban-column-header {
            padding: 1rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .kanban-column-body {
            padding: 1rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .kanban-card {
            background-color: #0f172a;
            border-radius: 8px;
            border: 1px solid #334155;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: move;
            transition: all 0.2s;
        }

        .kanban-card:hover {
            border-color: #475569;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .kanban-card.blocked-task {
            border-left: 4px solid #ef4444;
            background-color: rgba(239, 68, 68, 0.05);
        }

        .kanban-card-header {
            margin-bottom: 0.75rem;
        }

        .task-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: #e2e8f0;
        }

        .task-project {
            margin-top: 0.25rem;
        }

        .kanban-card-body {
            margin-bottom: 0.75rem;
        }

        .kanban-card-body p {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 0.5rem;
        }

        .task-meta {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        .task-meta .badge {
            font-size: 0.65rem;
            padding: 0.25rem 0.5rem;
        }

        .task-date {
            font-size: 0.75rem;
        }

        .kanban-card-footer {
            border-top: 1px solid #334155;
            padding-top: 0.75rem;
        }

        .task-progress {
            width: 100%;
        }

        .task-assignee .user-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .task-comments {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        /* Scrollbar Styling */
        .kanban-column-body::-webkit-scrollbar {
            width: 6px;
        }

        .kanban-column-body::-webkit-scrollbar-track {
            background: #1e293b;
            border-radius: 3px;
        }

        .kanban-column-body::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 3px;
        }

        .kanban-column-body::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>

    <!-- New Task Modal -->
    <div class="modal fade" id="newTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newTaskForm">
                        <div class="mb-3">
                            <label for="taskTitle" class="form-label">Task Title *</label>
                            <input type="text" class="form-control" id="taskTitle" placeholder="Enter task title" required>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" rows="3" placeholder="Describe the task..."></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="taskProject" class="form-label">Project</label>
                                <select class="form-select" id="taskProject">
                                    <option value="chegeos">ChegeOS Dashboard</option>
                                    <option value="api">API Integration</option>
                                    <option value="mobile">Mobile App</option>
                                    <option value="portfolio">Portfolio Website</option>
                                    <option value="ecommerce">E-commerce Backend</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="taskColumn" class="form-label">Column</label>
                                <select class="form-select" id="taskColumn">
                                    <option value="planning">Planning</option>
                                    <option value="progress">In Progress</option>
                                    <option value="testing">Testing</option>
                                    <option value="finished">Finished</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="taskPriority" class="form-label">Priority</label>
                                <select class="form-select" id="taskPriority">
                                    <option value="high">High</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="taskDueDate" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="taskDueDate">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createTaskBtn">Create Task</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Kanban Page JavaScript -->
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

            // New Task button
            $('#newTaskBtn').click(function() {
                $('#newTaskModal').modal('show');
            });

            // Create task
            $('#createTaskBtn').click(function() {
                const taskTitle = $('#taskTitle').val();
                const description = $('#taskDescription').val();
                const project = $('#taskProject').val();
                const column = $('#taskColumn').val();

                if (!taskTitle) {
                    showToast('Please enter a task title', 'danger');
                    return;
                }

                showToast(`Task "${taskTitle}" created successfully!`, 'success');

                // Reset form and close modal
                $('#newTaskForm')[0].reset();
                $('#newTaskModal').modal('hide');
            });

            // Task search
            $('#taskSearch').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();

                $('.kanban-card').each(function() {
                    const cardText = $(this).text().toLowerCase();
                    if (cardText.includes(searchTerm) || searchTerm === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Drag and drop simulation (visual only)
            let draggedTask = null;

            $('.kanban-card').on('dragstart', function(e) {
                draggedTask = $(this);
                setTimeout(() => {
                    $(this).addClass('dragging');
                }, 0);
            });

            $('.kanban-card').on('dragend', function() {
                $(this).removeClass('dragging');
                draggedTask = null;
            });

            $('.kanban-column-body').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('drag-over');
            });

            $('.kanban-column-body').on('dragleave', function() {
                $(this).removeClass('drag-over');
            });

            $('.kanban-column-body').on('drop', function(e) {
                e.preventDefault();
                $(this).removeClass('drag-over');

                if (draggedTask) {
                    $(this).append(draggedTask);
                    const columnName = $(this).closest('.kanban-column').find('.kanban-column-header h6').text();
                    showToast(`Task moved to ${columnName}`, 'info');

                    // Update counts (simulated)
                    updateColumnCounts();
                }
            });

            function updateColumnCounts() {
                // Simulate updating counts
                $('.kanban-column').each(function() {
                    const count = $(this).find('.kanban-card:visible').length;
                    $(this).find('.kanban-column-header .badge').text(count);
                });
            }

            // Task dropdown actions
            $(document).on('click', '.kanban-card .dropdown-item', function(e) {
                e.stopPropagation();
                const action = $(this).text().trim();
                const taskTitle = $(this).closest('.kanban-card').find('.task-title').text();

                if (action.includes('Edit')) {
                    showToast(`Editing task: ${taskTitle}`, 'warning');
                } else if (action.includes('Delete')) {
                    if (confirm(`Delete task "${taskTitle}"?`)) {
                        $(this).closest('.kanban-card').fadeOut(300, function() {
                            $(this).remove();
                            updateColumnCounts();
                        });
                        showToast(`Task "${taskTitle}" deleted`, 'danger');
                    }
                }
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

            // Initialize column counts
            updateColumnCounts();
        });
    </script>

<?= $this->include('layouts/user/footer') ?>