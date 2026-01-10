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

                <button class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-plus me-1"></i> New Project
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

        <!-- Quick Stats -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(99, 102, 241, 0.2); color: var(--primary-color);">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stat-value" id="totalProjects">8</div>
                    <div class="stat-label">Total Projects</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.2); color: var(--success-color);">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <div class="stat-value" id="activeProjects">5</div>
                    <div class="stat-label">Active Projects</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(245, 158, 11, 0.2); color: var(--warning-color);">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-value" id="stalledProjects">2</div>
                    <div class="stat-label">Stalled</div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(239, 68, 68, 0.2); color: var(--danger-color);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-value" id="timeThisWeek">18.5</div>
                    <div class="stat-label">Hours This Week</div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="row">
            <!-- Left Column: Projects & Focus -->
            <div class="col-lg-8">
                <!-- Weekly Focus -->
                <div class="stat-card mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0"><i class="fas fa-bullseye me-2"></i>Weekly Focus (Top 3)</h5>
                        <button class="btn btn-sm btn-outline-secondary">Edit Focus</button>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="project-card focus-project">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="project-health health-good"></span>
                                        <strong>ChegeOS Dashboard</strong>
                                    </div>
                                    <span class="badge bg-primary">High</span>
                                </div>
                                <p class="small text-muted mt-2 mb-2">Finish MVP dashboard with stats</p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span>75% complete</span>
                                    <span>3 days left</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="project-card focus-project">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="project-health health-warning"></span>
                                        <strong>API Integration</strong>
                                    </div>
                                    <span class="badge bg-warning">Medium</span>
                                </div>
                                <p class="small text-muted mt-2 mb-2">Connect to GitHub API</p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" style="width: 40%"></div>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span>40% complete</span>
                                    <span>7 days left</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="project-card focus-project">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="project-health health-danger"></span>
                                        <strong>Mobile App</strong>
                                    </div>
                                    <span class="badge bg-secondary">Low</span>
                                </div>
                                <p class="small text-muted mt-2 mb-2">Design React Native prototype</p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 20%"></div>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span>20% complete</span>
                                    <span>14 days left</span>
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
                            <button class="btn btn-sm btn-primary">+ New</button>
                        </div>
                    </div>

                    <div id="projectsList">
                        <!-- Project cards will be dynamically loaded here -->
                        <div class="project-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="project-health health-good"></span>
                                    <strong>Portfolio Website</strong>
                                </div>
                                <div>
                                    <span class="badge bg-info me-1">Web</span>
                                    <span class="badge bg-secondary">Design</span>
                                </div>
                            </div>
                            <p class="small text-muted mt-2 mb-2">Redesign and deploy personal portfolio</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress flex-grow-1 me-3">
                                    <div class="progress-bar bg-info" style="width: 90%"></div>
                                </div>
                                <div class="small">
                                    <i class="fas fa-calendar me-1"></i>Updated 2 days ago
                                </div>
                            </div>
                        </div>

                        <div class="project-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="project-health health-good"></span>
                                    <strong>E-commerce Backend</strong>
                                </div>
                                <div>
                                    <span class="badge bg-dark me-1">Node.js</span>
                                    <span class="badge bg-success">API</span>
                                </div>
                            </div>
                            <p class="small text-muted mt-2 mb-2">Build REST API with authentication</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="progress flex-grow-1 me-3">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                                <div class="small">
                                    <i class="fas fa-calendar me-1"></i>Updated 1 week ago
                                </div>
                            </div>
                        </div>
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

                <!-- Recent Activity -->
                <div class="stat-card">
                    <h5 class="mb-3"><i class="fas fa-history me-2"></i>Recent Activity</h5>
                    <div id="recentActivity">
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="user-avatar" style="width: 36px; height: 36px; background-color: var(--primary-color);">
                                    <i class="fas fa-code"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small"><strong>Updated ChegeOS Dashboard</strong></div>
                                <div class="small text-muted">Added progress tracking to project cards</div>
                                <div class="small text-muted">2 hours ago</div>
                            </div>
                        </div>

                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="user-avatar" style="width: 36px; height: 36px; background-color: var(--success-color);">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small"><strong>Completed milestone</strong></div>
                                <div class="small text-muted">"Design system" in Portfolio Website</div>
                                <div class="small text-muted">1 day ago</div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="user-avatar" style="width: 36px; height: 36px; background-color: var(--warning-color);">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="small"><strong>Logged 3.5 hours</strong></div>
                                <div class="small text-muted">On E-commerce Backend API</div>
                                <div class="small text-muted">2 days ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?= $this->include('layouts/user/footer') ?>