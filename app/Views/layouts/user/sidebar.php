<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="brand">
        <i class="fas fa-cubes brand-icon"></i>
        <span>ChegeOS</span>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'home') ? 'active' : '' ?>" href="<?= site_url('home') ?>">
            <i class="fas fa-tachometer-alt nav-icon"></i>
            Dashboard
        </a>
        <a class="nav-link <?= (strpos(uri_string(), 'projects') === 0) ? 'active' : '' ?>" href="<?= site_url('projects') ?>">
            <i class="fas fa-project-diagram nav-icon"></i>
            Projects
        </a>
        <a class="nav-link <?= (uri_string() == 'kanban') ? 'active' : '' ?>" href="<?= site_url('kanban') ?>">
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
    </nav>
    <hr>
    <br>
    <hr>
    <div class="mt-auto">
        <div class="nav flex-column">
            <a class="nav-link <?= (uri_string() == 'settings') ? 'active' : '' ?>" href="<?= site_url('settings') ?>">
                <i class="fas fa-cog nav-icon"></i>
                Settings
            </a>
            <a class="nav-link" href="<?= site_url('logout') ?>">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                Logout
            </a>
        </div>
    </div>
</div>