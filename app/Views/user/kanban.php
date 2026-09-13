<?= $this->extend('layouts/ace/main') ?>
<?= $this->section('content') ?>

<?php $user = auth()->user(); $initials = strtoupper(substr($user->first_name ?? $user->username, 0, 1) . substr($user->last_name ?? '', 0, 1)); ?>

    
        
        <div class="row space-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>Kanban Board</strong></h3>
            </div>
            <div class="col-auto pull-right text-end mt-n1">
                
            </div>
        </div>
        <!-- Quick Stats -->
        <div class="row space-4 g-3">
            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Total Tasks</div>
                    <div class="stat-value" id="totalTasks">24</div>
                    <div class="stat-change text-secondary  font-mono border-top pt-2">
                        <i class="fas fa-tasks"></i> All Active
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">In Progress</div>
                    <div class="stat-value text-warning" id="inProgress">8</div>
                    <div class="stat-change text-warning  font-mono border-top border-warning border-opacity-25 pt-2">
                        <i class="fas fa-spinner"></i> Being worked on
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Blocked</div>
                    <div class="stat-value text-danger" id="blockedTasks">3</div>
                    <div class="stat-change text-danger  font-mono border-top border-danger border-opacity-25 pt-2">
                        <i class="fas fa-exclamation-triangle"></i> Needs attention
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="widget-box card-body h-100 p-4 border-dark">
                    <div class="stat-label space-2">Completed</div>
                    <div class="stat-value text-success" id="completedTasks">13</div>
                    <div class="stat-change text-success  font-mono border-top border-success border-opacity-25 pt-2">
                        <i class="fas fa-check-circle"></i> Done
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanban Board -->
        <div class="kanban-board" id="kanbanBoard">
            <div class="row">
                <!-- Planning Column -->
                <div class="col-lg-3 space-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-primary">
                            <h6 class="space-0"><i class="fas fa-clipboard-list pr-2"></i>Planning</h6>
                            <span class="badge bg-light text-dark">5</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="1" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Design Dashboard Layout</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> <?= esc(setting('App.siteName')) ?> Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Create wireframes and design system for dashboard</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-warning">Medium</span>
                                            <span class="badge badge-info">Design</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Mar 20
                                        </div>
                                    </div>
                                </div>
                                <div class="kanban-card-footer">
                                    <div class="  ">
                                        <div class="task-assignee">
                                            <div class="user-avatar" style="width: 24px; height: 24px; font-size: 0.7rem;"><?= $initials ?></div>
                                        </div>
                                        <div class="task-comments">
                                            <i class="fas fa-comment"></i> 3
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="2" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Setup Database Schema</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> E-commerce Backend
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Design and implement database tables</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-primary">High</span>
                                            <span class="badge bg-dark">Backend</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Mar 22
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="3" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Research API Integrations</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> API Integration
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Research GitHub, GitLab, and Jira APIs</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-default">Low</span>
                                            <span class="badge badge-success">Research</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center ">
                                <button class="btn btn-sm btn btn-white btn-default w-100">
                                    <i class="fas fa-plus pr-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- In Progress Column -->
                <div class="col-lg-3 space-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-warning">
                            <h6 class="space-0"><i class="fas fa-spinner pr-2"></i>In Progress</h6>
                            <span class="badge bg-light text-dark">8</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="4" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Implement Authentication</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> E-commerce Backend
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">JWT authentication and user management</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-primary">High</span>
                                            <span class="badge badge-danger">Security</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Today
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
                                    <div class="  align-items-start">
                                        <div class="task-title">Mobile App UI Design</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> Mobile App
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Create React Native UI components</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-warning">Medium</span>
                                            <span class="badge badge-info">Mobile</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Mar 25
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card blocked-task" data-task-id="6" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">API Rate Limiting</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> API Integration
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Waiting for API documentation from team</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-primary">High</span>
                                            <span class="badge badge-danger">Blocked</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Mar 18
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center ">
                                <button class="btn btn-sm btn btn-white btn-default w-100">
                                    <i class="fas fa-plus pr-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testing Column -->
                <div class="col-lg-3 space-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-info">
                            <h6 class="space-0"><i class="fas fa-vial pr-2"></i>Testing</h6>
                            <span class="badge bg-light text-dark">4</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="7" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Dashboard Unit Tests</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> <?= esc(setting('App.siteName')) ?> Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Write unit tests for dashboard components</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-warning">Medium</span>
                                            <span class="badge badge-success">Testing</span>
                                        </div>
                                        <div class="task-date small text-muted">
                                            <i class="fas fa-calendar pr-1"></i> Mar 19
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="8" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Mobile App QA</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> Mobile App
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Quality assurance testing on iOS and Android</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-primary">High</span>
                                            <span class="badge badge-info">QA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center ">
                                <button class="btn btn-sm btn btn-white btn-default w-100">
                                    <i class="fas fa-plus pr-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Finished Column -->
                <div class="col-lg-3 space-4">
                    <div class="kanban-column">
                        <div class="kanban-column-header bg-success">
                            <h6 class="space-0"><i class="fas fa-check-circle pr-2"></i>Finished</h6>
                            <span class="badge bg-light text-dark">13</span>
                        </div>
                        <div class="kanban-column-body">
                            <div class="kanban-card" data-task-id="9" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Project Setup</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> <?= esc(setting('App.siteName')) ?> Dashboard
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Initial project setup and configuration</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-default">Low</span>
                                            <span class="badge bg-dark">Setup</span>
                                        </div>
                                        <div class="task-date small text-success">
                                            <i class="fas fa-check pr-1"></i> Mar 15
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="kanban-card" data-task-id="10" draggable="true">
                                <div class="kanban-card-header">
                                    <div class="  align-items-start">
                                        <div class="task-title">Design System</div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-edit pr-2"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="fas fa-trash pr-2"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="task-project small text-muted">
                                        <i class="fas fa-project-diagram pr-1"></i> Portfolio Website
                                    </div>
                                </div>
                                <div class="kanban-card-body">
                                    <p class="small">Created color palette and typography system</p>
                                    <div class="  ">
                                        <div class="task-meta">
                                            <span class="badge badge-warning">Medium</span>
                                            <span class="badge badge-info">Design</span>
                                        </div>
                                        <div class="task-date small text-success">
                                            <i class="fas fa-check pr-1"></i> Mar 10
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center ">
                                <button class="btn btn-sm btn btn-white btn-default w-100">
                                    <i class="fas fa-plus pr-1"></i> Add Task
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- New Task Modal -->
    <div class="modal fade" id="newTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle pr-2"></i>New Task</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newTaskForm">
                        <div class="space-3">
                            <label for="taskTitle" class="form-label">Task Title *</label>
                            <input type="text" class="form-control" id="taskTitle" placeholder="Enter task title" required>
                        </div>
                        <div class="space-3">
                            <label for="taskDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="taskDescription" rows="3" placeholder="Describe the task..."></textarea>
                        </div>
                        <div class="row space-3">
                            <div class="col-md-6">
                                <label for="taskProject" class="form-label">Project</label>
                                <select class="form-control" id="taskProject">
                                    <option value="chegeos"><?= esc(setting('App.siteName')) ?> Dashboard</option>
                                    <option value="api">API Integration</option>
                                    <option value="mobile">Mobile App</option>
                                    <option value="portfolio">Portfolio Website</option>
                                    <option value="ecommerce">E-commerce Backend</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="taskColumn" class="form-label">Column</label>
                                <select class="form-control" id="taskColumn">
                                    <option value="planning">Planning</option>
                                    <option value="progress">In Progress</option>
                                    <option value="testing">Testing</option>
                                    <option value="finished">Finished</option>
                                </select>
                            </div>
                        </div>
                        <div class="row space-3">
                            <div class="col-md-6">
                                <label for="taskPriority" class="form-label">Priority</label>
                                <select class="form-control" id="taskPriority">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
            <div id="${toastId}" class="toast  text-bg-${type} border-0" role="alert">
                <div class="">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white pr-2 m-auto" data-dismiss="toast"></button>
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

<?= $this->endSection() ?>
