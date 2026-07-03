<?= $this->include('layouts/user/header') ?>
<?= $this->include('layouts/user/sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="h4 mb-0">Dashboard</h1>
            </div>

            <div class="d-flex align-items-center">
                <div class="input-group input-group-sm me-3" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search projects...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <a href="<?= site_url('projects/create') ?>" class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-plus me-1"></i> New Project
                </a>

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
        <div class="row mb-4 g-3">
            <div class="col-md-4 mb-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label mb-2">Total Projects</div>
                            <div class="stat-value" id="totalProjects"><?= $stats['total'] ?></div>
                        </div>
                        <i class="fas fa-project-diagram fs-3 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="stat-card h-100 p-4 border-dark">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="stat-label mb-2">Active Projects</div>
                            <div class="stat-value text-success" id="activeProjects"><?= $stats['active'] ?></div>
                        </div>
                        <i class="fas fa-play-circle fs-3 text-success"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="row g-3 h-100">
                    <div class="col-12 h-50">
                        <div class="stat-card p-3 border-dark d-flex justify-content-between align-items-center">
                            <div class="stat-label">Pending</div>
                            <div class="stat-value fs-4 text-warning" id="stalledProjects"><?= $stats['pending'] ?></div>
                        </div>
                    </div>
                    <div class="col-12 h-50">
                        <div class="stat-card p-3 border-dark d-flex justify-content-between align-items-center">
                            <div class="stat-label">Archived</div>
                            <div class="stat-value fs-4 text-muted" id="archivedProjects"><?= $stats['archived'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="row">
            <!-- Left Column: Projects & Focus -->
            <div class="col-lg-8">
                <!-- Weekly Focus Accordion -->
                <div class="accordion mb-4" id="focusAccordion">
                    <div class="accordion-item stat-card p-0" style="border: none;">
                        <h2 class="accordion-header p-3 d-flex justify-content-between align-items-center">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#focusCollapse" style="background: none; box-shadow: none; padding: 0; color: inherit; width: auto;">
                                <h5 class="mb-0"><i class="fas fa-bullseye me-2 text-primary"></i>Weekly Focus (Top 3)</h5>
                            </button>
                            <a href="<?= site_url('projects') ?>" class="btn btn-sm btn-outline-secondary">View All</a>
                        </h2>
                        <div id="focusCollapse" class="accordion-collapse collapse show" data-bs-parent="#focusAccordion">
                            <div class="accordion-body pt-0">
                                <div class="row">
                                    <?php if (!empty($weeklyFocus)): ?>
                                        <?php foreach ($weeklyFocus as $project): ?>
                                        <div class="col-md-4 mb-3">
                                            <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="text-decoration-none text-white">
                                                <div class="project-card focus-project h-100">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="text-truncate me-2">
                                                            <span class="project-health health-good"></span>
                                                            <strong class="text-white"><?= esc($project['name']) ?></strong>
                                                        </div>
                                                        <span class="badge bg-<?= $project['priority'] === 'critical' ? 'danger' : ($project['priority'] === 'high' ? 'warning' : 'primary') ?> small">
                                                            <?= ucfirst($project['priority']) ?>
                                                        </span>
                                                    </div>
                                                    <p class="small text-muted mt-2 mb-2 text-truncate-2"><?= esc($project['description']) ?></p>
                                                    <div class="progress mb-1" style="height: 6px;">
                                                        <div class="progress-bar bg-success" style="width: <?= $project['progress'] ?>%"></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between small text-muted">
                                                        <span><?= $project['progress'] ?>% complete</span>
                                                        <span>In Progress</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12 text-center py-3">
                                            <p class="text-muted small">No active projects to focus on. <a href="<?= site_url('projects/create') ?>">Create one?</a></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- All Projects -->
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-list-alt me-2"></i>All Projects</h5>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2">Filter</button>
                            <a href="<?= site_url('projects/create') ?>" class="btn btn-sm btn-primary">+ New</a>
                        </div>
                    </div>

                    <div id="projectsList">
                        <?php if (!empty($projects)): ?>
                            <?php foreach ($projects as $project): ?>
                            <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="text-decoration-none">
                                <div class="project-card mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="d-flex align-items-center">
                                            <div class="stat-icon m-0 me-3 bg-dark border-0" style="width: 32px; height: 32px; font-size: 14px;">
                                                <i class="fas <?= esc($project['icon'] ?? 'fa-project-diagram') ?>"></i>
                                            </div>
                                            <div>
                                                <strong class="text-white font-mono"><?= esc($project['name']) ?></strong>
                                            </div>
                                        </div>
                                        <div>
                                            <?php 
                                            $techs = json_decode($project['tech_stack'], true) ?? [];
                                            foreach (array_slice($techs, 0, 2) as $tech): 
                                            ?>
                                            <span class="badge bg-dark me-1"><?= esc($tech) ?></span>
                                            <?php endforeach; ?>
                                            <span class="badge bg-<?= $project['status'] === 'in_progress' ? 'success' : 'secondary' ?>"><?= ucfirst($project['status']) ?></span>
                                        </div>
                                    </div>
                                    <p class="small text-muted mt-2 mb-2 text-truncate"><?= esc($project['description']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="progress flex-grow-1 me-3" style="height: 6px;">
                                            <div class="progress-bar bg-info" style="width: <?= $project['progress'] ?>%"></div>
                                        </div>
                                        <div class="small text-muted">
                                            <i class="fas fa-calendar me-1"></i><?= date('M d', strtotime($project['updated_at'])) ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-4">
                                <p class="text-muted small">No projects found. Use the "New Project" button to get started!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: Activity & Heatmap -->
            <div class="col-lg-4">

                <!-- Recent Activity Accordion -->
                <div class="accordion" id="activityAccordion">
                    <div class="accordion-item stat-card p-0" style="border: none;">
                        <h2 class="accordion-header p-3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#activityCollapse" style="background: none; box-shadow: none; padding: 0; color: inherit; width: auto;">
                                <h5 class="mb-0"><i class="fas fa-history me-2 text-warning"></i>Recent Activity</h5>
                            </button>
                        </h2>
                        <div id="activityCollapse" class="accordion-collapse collapse show" data-bs-parent="#activityAccordion">
                            <div class="accordion-body pt-0">
                                <!-- Activity Legend -->
                                <div class="activity-legend mb-4 p-2 rounded" style="background-color: rgba(30, 41, 59, 0.5); border: 1px solid #334155;">
                                    <div class="d-flex flex-wrap gap-2 small">
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-plus-circle text-success me-1"></i>New</div>
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-check-double text-primary me-1"></i>Done</div>
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-archive text-muted me-1"></i>Arc</div>
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-play-circle text-info me-1"></i>Start</div>
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-flag-checkered text-success me-1"></i>Goal</div>
                                        <div class="d-flex align-items-center me-2"><i class="fas fa-sticky-note text-warning me-1"></i>Note</div>
                                        <div class="d-flex align-items-center"><i class="fas fa-check-circle text-success me-1"></i>Task</div>
                                    </div>
                                </div>

                                <div id="recentActivity">
                                    <?php if (!empty($recentActivity)): ?>
                                        <div class="activity-timeline">
                                            <?php foreach ($recentActivity as $act): ?>
                                            <div class="activity-item d-flex position-relative mb-4">
                                                <div class="activity-icon-wrapper flex-shrink-0" style="z-index: 2;">
                                                    <div class="stat-icon m-0" style="width: 40px; height: 40px; background-color: <?= $act['bg'] ?>; color: <?= $act['color'] ?>; font-size: 16px; border-radius: 50%; border: 2px solid #1e293b;">
                                                        <i class="fas <?= $act['icon'] ?>"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="small fw-bold text-white"><?= esc($act['title']) ?></div>
                                                        <span class="extra-small text-muted" style="font-size: 0.7rem;"><?= date('M d', strtotime($act['time'])) ?></span>
                                                    </div>
                                                    <div class="small text-muted mt-1" style="font-size: 0.8rem; line-height: 1.2;"><?= esc($act['description']) ?></div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-center text-muted small py-3">No recent activity detected.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?= $this->include('layouts/user/footer') ?>

<style>
    .activity-timeline::before {
        content: "";
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 1px;
        background: var(--border-color);
        z-index: 1;
    }
    .activity-item:last-child {
        margin-bottom: 0 !important;
    }
    .activity-legend i {
        width: 14px;
        text-align: center;
    }
</style>