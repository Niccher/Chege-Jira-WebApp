<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= site_url('home') ?>">
            <span class="align-middle"><i class="fas fa-cubes me-2"></i> Chege Jira</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                My Workspace
            </li>
            
            <li class="sidebar-item <?= (uri_string() == '' || uri_string() == 'home') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('home') ?>">
                    <i class="align-middle fas fa-tachometer-alt"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item <?= (strpos(uri_string(), 'projects') === 0 && strpos(uri_string(), 'projects/kanban') !== 0) ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('projects') ?>">
                    <i class="align-middle fas fa-project-diagram"></i> <span class="align-middle">Projects</span>
                </a>
            </li>

            <li class="sidebar-item <?= (strpos(uri_string(), 'kanban') !== false) ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('kanban') ?>">
                    <i class="align-middle fas fa-th"></i> <span class="align-middle">Kanban</span>
                </a>
            </li>

            <li class="sidebar-item <?= (uri_string() == 'calendar') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('calendar') ?>">
                    <i class="align-middle fas fa-calendar-alt"></i> <span class="align-middle">Calendar</span>
                </a>
            </li>

            <li class="sidebar-item <?= (uri_string() == 'time') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('time') ?>">
                    <i class="align-middle fas fa-clock"></i> <span class="align-middle">Time Tracking</span>
                </a>
            </li>

            <li class="sidebar-item <?= (uri_string() == 'notes') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('notes') ?>">
                    <i class="align-middle fas fa-sticky-note"></i> <span class="align-middle">Notes</span>
                </a>
            </li>

            <li class="sidebar-item <?= (uri_string() == 'analytics') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('analytics') ?>">
                    <i class="align-middle fas fa-chart-line"></i> <span class="align-middle">Analytics</span>
                </a>
            </li>

            <?php if (auth()->user()->inGroup('admin', 'manager')): ?>
                <li class="sidebar-header">
                    Management
                </li>
                
                <?php if (auth()->user()->inGroup('manager', 'admin')): ?>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'manage/team') === 0) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('manage/team') ?>">
                            <i class="align-middle fas fa-users"></i> <span class="align-middle">Team Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'manage/approvals') === 0) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('manage/approvals') ?>">
                            <i class="align-middle fas fa-check-circle"></i> <span class="align-middle">Approvals</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'manage/tasks/assign') === 0) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('manage/tasks/assign') ?>">
                            <i class="align-middle fas fa-tasks"></i> <span class="align-middle">Assign Tasks</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'manage/reports') === 0) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('manage/reports') ?>">
                            <i class="align-middle fas fa-file-invoice"></i> <span class="align-middle">Reports</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (auth()->user()->inGroup('admin')): ?>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'admin/telemetry') === 0) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('admin/telemetry') ?>">
                            <i class="align-middle fas fa-server"></i> <span class="align-middle">System Telemetry</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?= (strpos(uri_string(), 'admin') === 0 && strpos(uri_string(), 'admin/settings') === false && strpos(uri_string(), 'admin/telemetry') === false) ? 'active' : '' ?>">
                        <a class="sidebar-link" href="<?= site_url('admin') ?>">
                            <i class="align-middle fas fa-users-cog"></i> <span class="align-middle">Users & Roles</span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <li class="sidebar-header">
                System
            </li>

            <li class="sidebar-item <?= (uri_string() == 'settings') ? 'active' : '' ?>">
                <a class="sidebar-link" href="<?= site_url('settings') ?>">
                    <i class="align-middle fas fa-cog"></i> <span class="align-middle">Settings</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-danger" href="<?= site_url('logout') ?>">
                    <i class="align-middle fas fa-sign-out-alt"></i> <span class="align-middle">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Begin AppStack Main Wrapper -->
<div class="main">
    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
            <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                <li class="nav-item">
                    <button class="btn btn-sm btn-outline-secondary rounded-circle" id="themeToggle" style="width: 32px; height: 32px; padding: 0;">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <span class="text-dark">Hello, <?= esc(auth()->user()->username ?? 'User') ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?= site_url('settings') ?>"><i class="align-middle me-1 fas fa-cog"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= site_url('logout') ?>">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <main class="content">
        <div class="container-fluid p-0">
