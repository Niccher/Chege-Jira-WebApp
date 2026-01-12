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

                <a href="<?= site_url('projects/create') ?>" class="btn btn-primary btn-sm me-2" id="newProjectBtn">
                    <i class="fas fa-plus me-1"></i> New Project
                </a>

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
                            <div class="stat-value text-primary"><?= $stats['total'] ?></div>
                            <div class="stat-label">Total</div>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="stat-value text-success"><?= $stats['active'] ?></div>
                            <div class="stat-label">Active</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-value text-warning"><?= $stats['pending'] ?></div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-value text-danger"><?= $stats['archived'] ?></div>
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
                        <i class="fas fa-list me-1"></i> All Projects <span class="badge bg-secondary ms-1"><?= $stats['total'] ?></span>
                    </button>
                </li>
                <?php 
                $status_counts = [
                    'active'    => ['icon' => 'fa-play-circle', 'class' => 'bg-success', 'label' => 'Active'],
                    'pending'   => ['icon' => 'fa-hourglass-half', 'class' => 'bg-warning', 'label' => 'Pending'],
                    'testing'   => ['icon' => 'fa-flask', 'class' => 'bg-info', 'label' => 'Testing'],
                    'completed' => ['icon' => 'fa-check-circle', 'class' => 'bg-success', 'label' => 'Completed']
                ];
                
                // Count specifically for tabs
                $active_count = 0; $pending_count = 0; $completed_count = 0;
                foreach($projects as $p) {
                    if($p['status'] == 'in_progress') $active_count++;
                    if(in_array($p['status'], ['planning', 'on_hold'])) $pending_count++;
                    if($p['status'] == 'completed') $completed_count++;
                }
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button" role="tab">
                        <i class="fas fa-play-circle me-1"></i> Active <span class="badge bg-success ms-1"><?= $active_count ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                        <i class="fas fa-hourglass-half me-1"></i> Pending <span class="badge bg-warning ms-1"><?= $pending_count ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                        <i class="fas fa-check-circle me-1"></i> Completed <span class="badge bg-info ms-1"><?= $completed_count ?></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived" type="button" role="tab">
                        <i class="fas fa-archive me-1"></i> Archived <span class="badge bg-secondary ms-1"><?= $stats['archived'] ?></span>
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
                                <th>Progress</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (empty($projects)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">No projects found. Create your first project to get started!</div>
                                    <a href="<?= site_url('projects/create') ?>" class="btn btn-primary btn-sm mt-3">
                                        <i class="fas fa-plus me-1"></i> Create Project
                                    </a>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($projects as $project): ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="<?= $project['id'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="user-avatar" style="width: 32px; height: 32px; background-color: <?= $project['color'] ?? '#6366f1' ?>;">
                                                <i class="fas <?= $project['icon'] ?? 'fa-project-diagram' ?>"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="text-white text-decoration-none">
                                                <strong><?= esc($project['name']) ?></strong>
                                            </a>
                                            <div class="small text-muted text-truncate" style="max-width: 250px;"><?= esc($project['description']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $status_classes = [
                                        'planning'    => 'bg-info',
                                        'in_progress' => 'bg-success',
                                        'testing'     => 'bg-purple',
                                        'completed'   => 'bg-primary',
                                        'on_hold'     => 'bg-warning',
                                        'abandoned'   => 'bg-danger'
                                    ];
                                    $status_label = str_replace('_', ' ', ucfirst($project['status']));
                                    ?>
                                    <span class="badge <?= $status_classes[$project['status']] ?? 'bg-secondary' ?>"><?= $status_label ?></span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center" style="min-width: 120px;">
                                        <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                            <?php 
                                            $prog_class = 'bg-primary';
                                            if($project['progress'] >= 100) $prog_class = 'bg-success';
                                            if($project['status'] == 'on_hold') $prog_class = 'bg-warning';
                                            ?>
                                            <div class="progress-bar <?= $prog_class ?>" style="width: <?= $project['progress'] ?>%"></div>
                                        </div>
                                        <span class="small"><?= $project['progress'] ?>%</span>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $priority_classes = [
                                        'low'      => 'bg-secondary',
                                        'medium'   => 'bg-info',
                                        'high'     => 'bg-warning',
                                        'critical' => 'bg-danger'
                                    ];
                                    ?>
                                    <span class="badge <?= $priority_classes[$project['priority']] ?? 'bg-secondary' ?>"><?= ucfirst($project['priority']) ?></span>
                                </td>
                                <td class="small">
                                    <?= $project['due_date'] ? date('M d, Y', strtotime($project['due_date'])) : '<span class="text-muted">No deadline</span>' ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn-outline-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-outline-danger archive-btn" data-id="<?= $project['id'] ?>" title="Archive">
                                            <i class="fas fa-archive"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Active Projects Tab -->
                <div class="tab-pane fade" id="active" role="tabpanel">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Showing <strong><?= $active_count ?> active projects</strong>. Active projects are those currently being worked on.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Progress</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $has_active = false; foreach($projects as $p): if($p['status'] == 'in_progress'): $has_active = true; ?>
                                <tr>
                                    <td><strong><?= esc($p['name']) ?></strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-success" style="width: <?= $p['progress'] ?>%"></div>
                                            </div>
                                            <span class="small"><?= $p['progress'] ?>%</span>
                                        </div>
                                    </td>
                                    <td><span class="badge <?= $priority_classes[$p['priority']] ?? 'bg-secondary' ?>"><?= ucfirst($p['priority']) ?></span></td>
                                    <td>
                                        <a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <?php endif; endforeach; if(!$has_active): ?>
                                <tr><td colspan="4" class="text-center py-4 text-muted">No active projects.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pending Projects Tab -->
                <div class="tab-pane fade" id="pending" role="tabpanel">
                    <div class="alert alert-warning">
                        <i class="fas fa-clock me-2"></i> Showing <strong><?= $pending_count ?> pending projects</strong>. These projects are on hold or in planning.
                    </div>
                    <!-- Simplified list for other tabs -->
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <tbody>
                                <?php $has_pending = false; foreach($projects as $p): if(in_array($p['status'], ['planning', 'on_hold'])): $has_pending = true; ?>
                                <tr>
                                    <td><strong><?= esc($p['name']) ?></strong></td>
                                    <td><span class="badge bg-warning"><?= ucfirst($p['status']) ?></span></td>
                                    <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                </tr>
                                <?php endif; endforeach; if(!$has_pending): ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted">No pending projects.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Completed Projects Tab -->
                <div class="tab-pane fade" id="completed" role="tabpanel">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i> Showing <strong><?= $completed_count ?> completed projects</strong>.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <tbody>
                                <?php $has_comp = false; foreach($projects as $p): if($p['status'] == 'completed'): $has_comp = true; ?>
                                <tr>
                                    <td><strong><?= esc($p['name']) ?></strong></td>
                                    <td class="text-success"><i class="fas fa-check-circle me-1"></i> Completed</td>
                                    <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                </tr>
                                <?php endif; endforeach; if(!$has_comp): ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted">No completed projects yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Archived Projects Tab -->
                <div class="tab-pane fade" id="archived" role="tabpanel">
                    <div class="alert alert-secondary">
                        <i class="fas fa-archive me-2"></i> Showing <strong><?= $stats['archived'] ?> archived projects</strong>.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-dark">
                            <tbody>
                                <?php $has_arch = false; foreach($projects as $p): if($p['is_archived'] == 1): $has_arch = true; ?>
                                <tr>
                                    <td><strong><?= esc($p['name']) ?></strong></td>
                                    <td><span class="badge bg-secondary">Archived</span></td>
                                    <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a></td>
                                </tr>
                                <?php endif; endforeach; if(!$has_arch): ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted">No archived projects.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Tags Section -->
        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-tags me-2"></i>Project Categories & Tags</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <?php if (empty($tagStats)): ?>
                            <span class="text-muted small">No tags found yet. Add categories when creating projects.</span>
                        <?php else: ?>
                            <?php 
                            $tag_colors = [
                                'web_app'   => 'bg-primary',
                                'api'       => 'bg-success',
                                'mobile'    => 'bg-info',
                                'learning'  => 'bg-warning',
                                'portfolio' => 'bg-purple',
                                'freelance' => 'bg-danger'
                            ];
                            foreach ($tagStats as $tag => $count): 
                                $color = $tag_colors[$tag] ?? 'bg-secondary';
                                $label = str_replace('_', ' ', ucfirst($tag));
                            ?>
                                <span class="badge <?= $color ?> p-2">
                                    <?= $label ?> <span class="badge bg-light text-dark ms-1"><?= $count ?></span>
                                </span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
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
                const projectId = $(this).closest('tr').find('.project-checkbox').val();
                window.location.href = '<?= site_url('projects/view/') ?>' + projectId;
            });

            // Edit project button
            $(document).on('click', '.btn-outline-warning', function() {
                const projectId = $(this).closest('tr').find('.project-checkbox').val();
                window.location.href = '<?= site_url('projects/edit/') ?>' + projectId;
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