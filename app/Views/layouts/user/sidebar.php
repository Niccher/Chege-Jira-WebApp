<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="brand">
        <i class="fas fa-cubes brand-icon"></i>
        <span>Chege Jira</span>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'home') ? 'active' : '' ?>" href="<?= site_url('home') ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            Dashboard
        </a>
        <a class="nav-link <?= (strpos(uri_string(), 'projects') === 0 && strpos(uri_string(), 'projects/kanban') !== 0) ? 'active' : '' ?>" href="<?= site_url('projects') ?>">
            <i class="fas fa-project-diagram nav-icon"></i>
            Projects
        </a>
        <a class="nav-link <?= (strpos(uri_string(), 'kanban') !== false) ? 'active' : '' ?>" href="<?= site_url('kanban') ?>">
            <i class="fas fa-th nav-icon"></i>
            Kanban
        </a>
        <a class="nav-link <?= (uri_string() == 'calendar') ? 'active' : '' ?>" href="<?= site_url('calendar') ?>">
            <i class="fas fa-calendar-alt nav-icon"></i>
            Calendar
        </a>
        <a class="nav-link <?= (uri_string() == 'time') ? 'active' : '' ?>" href="<?= site_url('time') ?>">
            <i class="fas fa-clock nav-icon"></i>
            Time Tracking
        </a>
        <a class="nav-link <?= (uri_string() == 'notes') ? 'active' : '' ?>" href="<?= site_url('notes') ?>">
            <i class="fas fa-sticky-note nav-icon"></i>
            Notes
        </a>
        <a class="nav-link <?= (uri_string() == 'analytics') ? 'active' : '' ?>" href="<?= site_url('analytics') ?>">
            <i class="fas fa-chart-line nav-icon"></i>
            Analytics
        </a>
        
        <?php if (auth()->user()->inGroup('admin', 'manager')): ?>
        <hr class="my-2 border-secondary">
        <div class="px-3 pb-2 pt-1 text-uppercase small text-muted fw-bold">Management</div>
        <?php if (auth()->user()->inGroup('manager', 'admin')): ?>
            <a class="nav-link <?= (strpos(uri_string(), 'manage/team') === 0) ? 'active' : '' ?>" href="<?= site_url('manage/team') ?>">
                <i class="fas fa-users nav-icon"></i>
                Team Dashboard
            </a>
            <a class="nav-link <?= (strpos(uri_string(), 'manage/approvals') === 0) ? 'active' : '' ?>" href="<?= site_url('manage/approvals') ?>">
                <i class="fas fa-check-circle nav-icon"></i>
                Approvals
            </a>
            <a class="nav-link <?= (strpos(uri_string(), 'manage/tasks/assign') === 0) ? 'active' : '' ?>" href="<?= site_url('manage/tasks/assign') ?>">
                <i class="fas fa-tasks nav-icon"></i>
                Assign Tasks
            </a>
        <?php endif; ?>
        <?php if (auth()->user()->inGroup('admin')): ?>
            <a class="nav-link <?= (strpos(uri_string(), 'admin/telemetry') === 0) ? 'active' : '' ?>" href="<?= site_url('admin/telemetry') ?>">
                <i class="fas fa-server nav-icon"></i>
                System Telemetry
            </a>
            <a class="nav-link <?= (strpos(uri_string(), 'admin') === 0 && strpos(uri_string(), 'admin/settings') === false && strpos(uri_string(), 'admin/telemetry') === false) ? 'active' : '' ?>" href="<?= site_url('admin') ?>">
                <i class="fas fa-users-cog nav-icon"></i>
                Users & Roles
            </a>
        <?php endif; ?>
        <?php endif; ?>
    </nav>
    <div class="mt-auto pt-3 border-top border-secondary">
        <div class="nav flex-column">
            <!-- Notifications (Phase 5 placeholder) -->
            <a class="nav-link d-flex justify-content-between align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                <div><i class="fas fa-bell nav-icon"></i> Notifications</div>
                <span class="badge bg-danger rounded-pill">3</span>
            </a>
            <a class="nav-link <?= (uri_string() == 'settings') ? 'active' : '' ?>" href="<?= site_url('settings') ?>">
                <i class="fas fa-cog nav-icon"></i>
                Settings
            </a>
            <a class="nav-link text-danger" href="<?= site_url('logout') ?>">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                Logout
            </a>
        </div>
    </div>
</div>
