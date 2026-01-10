<?= $this->include('layouts/user/header', ['title' => 'Projects • ChegeOS']) ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Projects</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="input-group input-group-sm me-3" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search projects..." id="projectsSearch">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <button class="btn btn-primary btn-sm me-2" id="newProjectBtn">
                    <i class="fas fa-plus me-1"></i> New Project
                </button>

                <button class="btn btn-outline-secondary btn-sm me-2" id="bulkActionsBtn" data-bs-toggle="dropdown">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i> Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-filter me-2"></i> Bulk Archive</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-tags me-2"></i> Bulk Tag</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-trash me-2"></i> Bulk Delete</a></li>
                </ul>

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

        <!-- Quick Stats Bar -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="stat-card">
                    <div class="row text-center">
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="stat-value text-primary">8</div>
                            <div class="stat-label">Total</div>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="stat-value text-success">5</div>
                            <div class="stat-label">Active</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-value text-warning">2</div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-value text-danger">1</div>
                            <div class="stat-label">Archived</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Tabs Section -->
        <div class="stat-card">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="projectsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab">
                        <i class="fas fa-list me-1"></i> All Projects <span class="badge bg-secondary ms-1">8</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                        <i class="fas fa-play-circle me-1"></i> Active <span class="badge bg-success ms-1">5</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                        <i class="fas fa-hourglass-half me-1"></i> Pending <span class="badge bg-warning ms-1">2</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                        <i class="fas fa-check-circle me-1"></i> Completed <span class="badge bg-info ms-1">1</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab">
                        <i class="fas fa-archive me-1"></i> Archived <span class="badge bg-secondary ms-1">0</span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="projectsTabContent">
                <!-- All Projects Tab -->
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover table-dark" id="projectsTable">
                            <thead>
                            <tr>
                                <th width="40">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllProjects">
                                    </div>
                                </th>
                                <th>Project Name</th>
                                <th>Status</th>
                                <th>Health</th>
                                <th>Progress</th>
                                <th>Priority</th>
                                <th>Last Activity</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="1">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #6366f1;">
                                                <i class="fas fa-project-diagram"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <strong>ChegeOS Dashboard</strong>
                                            <div class="small text-muted">Personal project management system</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <span class="project-health health-good"></span>
                                    <span class="small">Good</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                        <span class="small">75%</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">High</span></td>
                                <td>
                                    <div class="small">2 hours ago</div>
                                    <div class="small text-muted">Updated UI</div>
                                </td>
                                <td class="small">Jan 15, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Archive">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="2">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #10b981;">
                                                <i class="fas fa-server"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <strong>API Integration</strong>
                                            <div class="small text-muted">Connect to GitHub & GitLab APIs</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <span class="project-health health-warning"></span>
                                    <span class="small">Warning</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-warning" style="width: 40%"></div>
                                        </div>
                                        <span class="small">40%</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Medium</span></td>
                                <td>
                                    <div class="small">3 days ago</div>
                                    <div class="small text-muted">Added endpoints</div>
                                </td>
                                <td class="small">Feb 10, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Activate">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="3">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #f59e0b;">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <strong>Mobile App</strong>
                                            <div class="small text-muted">React Native mobile application</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>
                                    <span class="project-health health-danger"></span>
                                    <span class="small">Danger</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                        </div>
                                        <span class="small">20%</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-secondary">Low</span></td>
                                <td>
                                    <div class="small">1 week ago</div>
                                    <div class="small text-muted">Initial setup</div>
                                </td>
                                <td class="small">Mar 5, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-success" title="Activate">
                                            <i class="fas fa-play"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="4">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #0ea5e9;">
                                                <i class="fas fa-globe"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <strong>Portfolio Website</strong>
                                            <div class="small text-muted">Personal portfolio redesign</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <span class="project-health health-good"></span>
                                    <span class="small">Good</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-info" style="width: 90%"></div>
                                        </div>
                                        <span class="small">90%</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">High</span></td>
                                <td>
                                    <div class="small">2 days ago</div>
                                    <div class="small text-muted">Added projects section</div>
                                </td>
                                <td class="small">Jan 20, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Archive">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="5">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: #8b5cf6;">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <strong>E-commerce Backend</strong>
                                            <div class="small text-muted">Node.js REST API with auth</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <span class="project-health health-good"></span>
                                    <span class="small">Good</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                        <span class="small">60%</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">Medium</span></td>
                                <td>
                                    <div class="small">1 week ago</div>
                                    <div class="small text-muted">Implemented auth system</div>
                                </td>
                                <td class="small">Feb 15, 2024</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger" title="Archive">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Projects pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Active Projects Tab -->
                <div class="tab-pane fade" id="active" role="tabpanel">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Showing <strong>5 active projects</strong>. Active projects are those currently being worked on.
                    </div>
                    <!-- Table would be populated with active projects only -->
                    <div class="text-center py-5">
                        <i class="fas fa-play-circle fa-3x text-success mb-3"></i>
                        <h5>Active Projects Tab</h5>
                        <p class="text-muted">This would show only active projects in a table format.</p>
                    </div>
                </div>

                <!-- Pending Projects Tab -->
                <div class="tab-pane fade" id="pending" role="tabpanel">
                    <div class="alert alert-warning">
                        <i class="fas fa-clock me-2"></i> Showing <strong>2 pending projects</strong>. These projects are on hold or waiting for resources.
                    </div>
                    <!-- Table would be populated with pending projects only -->
                    <div class="text-center py-5">
                        <i class="fas fa-hourglass-half fa-3x text-warning mb-3"></i>
                        <h5>Pending Projects Tab</h5>
                        <p class="text-muted">This would show only pending projects in a table format.</p>
                    </div>
                </div>

                <!-- Completed Projects Tab -->
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i> Showing <strong>1 completed project</strong>. These projects have been finished successfully.
                    </div>
                    <!-- Table would be populated with completed projects only -->
                    <div class="text-center py-5">
                        <i class="fas fa-check-circle fa-3x text-info mb-3"></i>
                        <h5>Completed Projects Tab</h5>
                        <p class="text-muted">This would show only completed projects in a table format.</p>
                    </div>
                </div>

                <!-- Archived Projects Tab -->
                <div class="tab-pane fade" id="archived" role="tabpanel">
                    <div class="alert alert-secondary">
                        <i class="fas fa-archive me-2"></i> Showing <strong>0 archived projects</strong>. Archived projects are stored but not active.
                    </div>
                    <!-- Table would be populated with archived projects only -->
                    <div class="text-center py-5">
                        <i class="fas fa-archive fa-3x text-secondary mb-3"></i>
                        <h5>Archived Projects Tab</h5>
                        <p class="text-muted">This would show only archived projects in a table format.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Tags Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-tags me-2"></i>Project Tags</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-primary p-2">Web <span class="badge bg-light text-dark ms-1">3</span></span>
                        <span class="badge bg-info p-2">Mobile <span class="badge bg-light text-dark ms-1">1</span></span>
                        <span class="badge bg-success p-2">API <span class="badge bg-light text-dark ms-1">2</span></span>
                        <span class="badge bg-warning p-2">Learning <span class="badge bg-light text-dark ms-1">1</span></span>
                        <span class="badge bg-dark p-2">Backend <span class="badge bg-light text-dark ms-1">2</span></span>
                        <span class="badge bg-secondary p-2">Design <span class="badge bg-light text-dark ms-1">1</span></span>
                        <span class="badge bg-danger p-2">Urgent <span class="badge bg-light text-dark ms-1">2</span></span>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-plus"></i> Add Tag
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Project Modal (Reused from dashboard) -->
    <div class="modal fade" id="newProjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus-circle me-2"></i>New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="newProjectForm">
                        <div class="mb-3">
                            <label for="projectName" class="form-label">Project Name *</label>
                            <input type="text" class="form-control" id="projectName" placeholder="Enter project name" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="projectDescription" rows="3" placeholder="What's this project about?"></textarea>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="projectStatus" class="form-label">Status</label>
                                <select class="form-select" id="projectStatus">
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="projectPriority" class="form-label">Priority</label>
                                <select class="form-select" id="projectPriority">
                                    <option value="high">High</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="projectDeadline" class="form-label">Deadline (Optional)</label>
                            <input type="date" class="form-control" id="projectDeadline">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createProjectBtn">Create Project</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Projects Page JavaScript -->
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

            // New Project button
            $('#newProjectBtn').click(function() {
                $('#newProjectModal').modal('show');
            });

            // Create project
            $('#createProjectBtn').click(function() {
                const projectName = $('#projectName').val();
                const description = $('#projectDescription').val();
                const status = $('#projectStatus').val();
                const priority = $('#projectPriority').val();

                if (!projectName) {
                    showToast('Please enter a project name', 'danger');
                    return;
                }

                // In a real app, this would make an AJAX call to create project
                showToast(`Project "${projectName}" created successfully!`, 'success');

                // Reset form and close modal
                $('#newProjectForm')[0].reset();
                $('#newProjectModal').modal('hide');

                // Refresh page after 1 second (simulating real behavior)
                setTimeout(() => {
                    // In a real app, you would update the table via AJAX
                    console.log('Project created, refreshing data...');
                }, 1000);
            });

            // Select all projects checkbox
            $('#selectAllProjects').change(function() {
                const isChecked = $(this).prop('checked');
                $('.project-checkbox').prop('checked', isChecked);
                updateBulkActions();
            });

            // Individual project checkbox
            $('.project-checkbox').change(function() {
                updateBulkActions();
            });

            function updateBulkActions() {
                const checkedCount = $('.project-checkbox:checked').length;
                if (checkedCount > 0) {
                    $('#bulkActionsBtn').html(`<i class="fas fa-ellipsis-v me-1"></i> ${checkedCount} selected`);
                    $('#bulkActionsBtn').removeClass('btn-outline-secondary').addClass('btn-primary');
                } else {
                    $('#bulkActionsBtn').html('<i class="fas fa-ellipsis-v"></i>');
                    $('#bulkActionsBtn').removeClass('btn-primary').addClass('btn-outline-secondary');
                }
            }

            // Project search
            $('#projectsSearch').on('keyup', function() {
                const searchTerm = $(this).val().toLowerCase();

                $('#projectsTable tbody tr').each(function() {
                    const rowText = $(this).text().toLowerCase();
                    if (rowText.includes(searchTerm) || searchTerm === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // View project button
            $(document).on('click', '.btn-outline-info', function() {
                const projectName = $(this).closest('tr').find('strong').text();
                showToast(`Viewing project: ${projectName}`, 'info');
                // In a real app, this would navigate to project detail page
            });

            // Edit project button
            $(document).on('click', '.btn-outline-warning', function() {
                const projectName = $(this).closest('tr').find('strong').text();
                showToast(`Editing project: ${projectName}`, 'warning');
                // In a real app, this would open an edit modal
            });

            // Archive/Activate project button
            $(document).on('click', '.btn-outline-danger, .btn-outline-success', function() {
                const projectName = $(this).closest('tr').find('strong').text();
                const action = $(this).hasClass('btn-outline-danger') ? 'archived' : 'activated';
                showToast(`Project "${projectName}" ${action}`, 'success');
                // In a real app, this would make an AJAX call
            });

            // Tab switching - update counts (simulated)
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const target = $(e.target).attr('data-bs-target');
                console.log(`Switched to tab: ${target}`);
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