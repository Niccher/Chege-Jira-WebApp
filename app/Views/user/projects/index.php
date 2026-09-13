<?= $this->extend('layouts/ace/main') ?>

<?= $this->section('title') ?>Projects<?= $this->endSection() ?>

<?= $this->section('breadcrumb') ?>
    <li class="active">Projects</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php $initials = strtoupper(substr($user->first_name ?? $user->username, 0, 1) . substr($user->last_name ?? '', 0, 1)); ?>

<!-- Page header -->
<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">
            <i class="ace-icon fa fa-folder-open"></i>
            Projects
            <a href="<?= site_url('projects/create') ?>" class="btn btn-sm btn-primary pull-right" id="newProjectBtn">
                <i class="ace-icon fa fa-plus"></i>
                New Project
            </a>
        </h3>
        <div class="hr hr-8 dotted"></div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row">
    <div class="col-xs-6 col-sm-3">
        <div class="infobox infobox-blue">
            <div class="infobox-icon"><i class="ace-icon fa fa-folder"></i></div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $stats['total'] ?></span>
                <div class="infobox-content">Total</div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="infobox infobox-green">
            <div class="infobox-icon"><i class="ace-icon fa fa-play-circle"></i></div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $stats['active'] ?></span>
                <div class="infobox-content">Active</div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="infobox infobox-orange">
            <div class="infobox-icon"><i class="ace-icon fa fa-clock-o"></i></div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $stats['pending'] ?></span>
                <div class="infobox-content">Pending</div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3">
        <div class="infobox infobox-red">
            <div class="infobox-icon"><i class="ace-icon fa fa-archive"></i></div>
            <div class="infobox-data">
                <span class="infobox-data-number"><?= $stats['archived'] ?></span>
                <div class="infobox-content">Archived</div>
            </div>
        </div>
    </div>
</div>

        <!-- Projects Tabs Section -->
        <div class="widget-box">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs space-4" id="projectsTab" role="tablist">
                <li class="">
                    <button class="active" id="all-tab" data-toggle="tab" data-target="#all" type="button" role="tab">
                        <i class="fas fa-list pr-1"></i> All Projects <span class="badge badge-default ms-1"><?= $stats['total'] ?></span>
                    </button>
                </li>
                <li class="">
                    <button class="" id="active-tab" data-toggle="tab" data-target="#active" type="button" role="tab">
                        <i class="fas fa-play-circle pr-1"></i> Active <span class="badge badge-success ms-1"><?= $stats['active'] ?></span>
                    </button>
                </li>
                <li class="">
                    <button class="" id="pending-tab" data-toggle="tab" data-target="#pending" type="button" role="tab">
                        <i class="fas fa-hourglass-half pr-1"></i> Pending <span class="badge badge-warning ms-1"><?= $stats['pending'] ?></span>
                    </button>
                </li>
                <li class="">
                    <button class="" id="completed-tab" data-toggle="tab" data-target="#completed" type="button" role="tab">
                        <i class="fas fa-check-circle pr-1"></i> Completed <span class="badge badge-info ms-1"><?= $stats['completed'] ?></span>
                    </button>
                </li>
                <li class="">
                    <button class="" id="archived-tab" data-toggle="tab" data-target="#archived" type="button" role="tab">
                        <i class="fas fa-archive pr-1"></i> Archived <span class="badge badge-default ms-1"><?= $stats['archived'] ?></span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="projectsTabContent">
                <!-- All Projects Tab -->
                <div class="tab-pane active" id="all" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="projectsTable">
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
                            <?php if (empty($all_projects)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">No projects found. Create your first project to get started!</div>
                                    <a href="<?= site_url('projects/create') ?>" class="btn btn-primary btn-sm ">
                                        <i class="fas fa-plus pr-1"></i> Create Project
                                    </a>
                                </td>
                            </tr>
                            <?php else: ?>
                            <?php foreach ($all_projects as $project): ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input project-checkbox" type="checkbox" value="<?= $project['id'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class=" ">
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
                                    <div class=" " style="min-width: 120px;">
                                        <div class="progress flex-grow-1 pr-2" style="height: 6px;">
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
                                    <div class="btn-group">
                                        <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="btn btn btn-xs btn-info" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn btn-xs btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn btn-xs btn-danger archive-btn" data-id="<?= $project['id'] ?>" title="Archive">
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
                    <div class="">
                        <?= $pager->links('all', 'bootstrap_full') ?>
                    </div>
                </div>

                <!-- Active Projects Tab -->
                <div class="tab-pane" id="active" role="tabpanel">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle pr-2"></i> Showing <strong><?= $stats['active'] ?> active projects</strong>. Active projects are those currently being worked on.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Progress</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($active_projects)): ?>
                                    <tr><td colspan="4" class="text-center py-4 text-muted">No active projects.</td></tr>
                                <?php else: ?>
                                    <?php foreach($active_projects as $p): ?>
                                    <tr>
                                        <td><strong><?= esc($p['name']) ?></strong></td>
                                        <td>
                                            <div class=" ">
                                                <div class="progress flex-grow-1 pr-2" style="height: 6px;">
                                                    <div class="progress-bar bg-success" style="width: <?= $p['progress'] ?>%"></div>
                                                </div>
                                                <span class="small"><?= $p['progress'] ?>%</span>
                                            </div>
                                        </td>
                                        <td><span class="badge <?= $priority_classes[$p['priority']] ?? 'bg-secondary' ?>"><?= ucfirst($p['priority']) ?></span></td>
                                        <td>
                                            <a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?= $pager->links('active', 'bootstrap_full') ?>
                    </div>
                </div>

                <!-- Pending Projects Tab -->
                <div class="tab-pane" id="pending" role="tabpanel">
                    <div class="alert alert-warning">
                        <i class="fas fa-clock pr-2"></i> Showing <strong><?= $stats['pending'] ?> pending projects</strong>. These projects are on hold or in planning.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                                <?php if (empty($pending_projects)): ?>
                                    <tr><td colspan="3" class="text-center py-4 text-muted">No pending projects.</td></tr>
                                <?php else: ?>
                                    <?php foreach($pending_projects as $p): ?>
                                    <tr>
                                        <td><strong><?= esc($p['name']) ?></strong></td>
                                        <td><span class="badge badge-warning"><?= ucfirst($p['status']) ?></span></td>
                                        <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn btn-xs btn-info"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?= $pager->links('pending', 'bootstrap_full') ?>
                    </div>
                </div>

                <!-- Completed Projects Tab -->
                <div class="tab-pane" id="completed" role="tabpanel">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle pr-2"></i> Showing <strong><?= $stats['completed'] ?> completed projects</strong>.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                                <?php if (empty($completed_projects)): ?>
                                    <tr><td colspan="3" class="text-center py-4 text-muted">No completed projects yet.</td></tr>
                                <?php else: ?>
                                    <?php foreach($completed_projects as $p): ?>
                                    <tr>
                                        <td><strong><?= esc($p['name']) ?></strong></td>
                                        <td class="text-success"><i class="fas fa-check-circle pr-1"></i> Completed</td>
                                        <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn btn-xs btn-info"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?= $pager->links('completed', 'bootstrap_full') ?>
                    </div>
                </div>

                <!-- Archived Projects Tab -->
                <div class="tab-pane" id="archived" role="tabpanel">
                    <div class="alert alert-secondary">
                        <i class="fas fa-archive pr-2"></i> Showing <strong><?= $stats['archived'] ?> archived projects</strong>.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                                <?php if (empty($archived_projects)): ?>
                                    <tr><td colspan="3" class="text-center py-4 text-muted">No archived projects.</td></tr>
                                <?php else: ?>
                                    <?php foreach($archived_projects as $p): ?>
                                    <tr>
                                        <td><strong><?= esc($p['name']) ?></strong></td>
                                        <td><span class="badge badge-default">Archived</span></td>
                                        <td><a href="<?= site_url('projects/view/' . $p['id']) ?>" class="btn btn-sm btn btn-xs btn-info"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?= $pager->links('archived', 'bootstrap_full') ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Tags Section -->
        <div class="row ">
            <div class="col-lg-12">
                <div class="widget-box">
                    <h5 class="space-3"><i class="fas fa-tags pr-2"></i>Project Categories & Tags</h5>
                    <div class="  ">
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

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3"></div>

    <!-- Projects Page JavaScript -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();

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
                    $('#bulkActionsBtn').html(`<i class="fas fa-ellipsis-v pr-1"></i> ${checkedCount} selected`);
                    $('#bulkActionsBtn').removeClass('btn btn-white btn-default').addClass('btn-primary');
                } else {
                    $('#bulkActionsBtn').html('<i class="fas fa-ellipsis-v"></i>');
                    $('#bulkActionsBtn').removeClass('btn-primary').addClass('btn btn-white btn-default');
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
            $(document).on('click', '.btn btn-xs btn-info', function() {
                const projectId = $(this).closest('tr').find('.project-checkbox').val();
                window.location.href = '<?= site_url('projects/view/') ?>' + projectId;
            });

            // Edit project button
            $(document).on('click', '.btn btn-xs btn-warning', function() {
                const projectId = $(this).closest('tr').find('.project-checkbox').val();
                window.location.href = '<?= site_url('projects/edit/') ?>' + projectId;
            });

            // Archive/Activate project button
            $(document).on('click', '.btn btn-xs btn-danger, .btn btn-xs btn-success', function() {
                const projectName = $(this).closest('tr').find('strong').text();
                const action = $(this).hasClass('btn btn-xs btn-danger') ? 'archived' : 'activated';
                showToast(`Project "${projectName}" ${action}`, 'success');
                // In a real app, this would make an AJAX call
            });

            // Tab switching - update counts (simulated)
            $('button[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const target = $(e.target).attr('data-bs-target');
                console.log(`Switched to tab: ${target}`);
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
        });
    </script>

<?= $this->endSection() ?>
