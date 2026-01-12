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
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: var(--primary-color);">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-value" id="totalProjects"><?= $stats['total'] ?></div>
                    <div class="stat-label">Total Projects</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: var(--success-color);">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <div class="stat-value" id="activeProjects"><?= $stats['active'] ?></div>
                    <div class="stat-label">Active Projects</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: var(--warning-color);">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-value" id="stalledProjects"><?= $stats['pending'] ?></div>
                    <div class="stat-label">Pending/Hold</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(107, 114, 128, 0.2); color: #6b7280;">
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="stat-value" id="archivedProjects"><?= $stats['archived'] ?></div>
                    <div class="stat-label">Archived</div>
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
                                            <a href="<?= site_url('projects/view/' . $project['id']) ?>" class="text-decoration-none">
                                                <div class="project-card focus-project h-100">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="text-truncate me-2">
                                                            <span class="project-health health-good"></span>
                                                            <strong class="text-dark"><?= esc($project['name']) ?></strong>
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
                                        <div>
                                            <span class="project-health health-good"></span>
                                            <strong class="text-dark"><?= esc($project['name']) ?></strong>
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
                <!-- Activity Heatmap -->
                <div class="stat-card mb-4">
                    <h5 class="mb-3"><i class="fas fa-fire me-2"></i>Activity Heatmap</h5>
                    <div class="text-center mb-3">
                        <div id="heatmap">
                            <!-- Heatmap will be generated here -->
                        </div>
                        <div class="small text-muted mt-2">Last 30 days of activity</div>
                    </div>
                </div>

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
                                <div id="recentActivity">
                                    <?php if (!empty($recentActivity)): ?>
                                        <?php foreach ($recentActivity as $act): ?>
                                        <div class="d-flex mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="user-avatar" style="width: 32px; height: 32px; background-color: <?= $act['color'] ?>; font-size: 14px;">
                                                    <i class="fas <?= $act['icon'] ?>"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="small text-dark"><strong><?= esc($act['title']) ?></strong></div>
                                                <div class="small text-muted"><?= esc($act['description']) ?></div>
                                                <div class="extra-small text-muted text-end mt-1"><?= date('M d, H:i', strtotime($act['time'])) ?></div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-center text-muted small py-3">No recent activity found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?= $this->include('layouts/user/footer') ?>