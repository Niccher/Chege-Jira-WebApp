<?php
    $currentUser = auth()->user();
    $rawName = $currentUser->username ?? $currentUser->email ?? 'Guest';
    $initials = strtoupper(substr(trim($rawName), 0, 2));
    $isAdmin = $currentUser && $currentUser->inGroup('admin');
    $isManager = $currentUser && ($currentUser->inGroup('manager') || $isAdmin);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc(setting('App.siteName')) ?> - Agile Project Management" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/app_logo.jpg') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/img/app_logo.jpg') ?>">

    <!-- Primary Meta Tags & SEO -->
    <meta name="title" content="<?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?>">
    <meta name="description" content="<?= esc(setting('App.siteDesc') ?? 'Agile Project Management & Team Velocity Platform') ?>">
    <meta name="keywords" content="agile, kanban board, sprint planning, project management, issue tracker, time tracking, jira alternative, team collaboration">
    <meta name="author" content="<?= esc(setting('App.siteName')) ?> Team">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#727cf5">

    <!-- Open Graph / Facebook / LinkedIn -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?>">
    <meta property="og:description" content="<?= esc(setting('App.siteDesc') ?? 'Agile Project Management & Team Velocity Platform') ?>">
    <meta property="og:image" content="<?= base_url('assets/img/app_hero.jpg') ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?= current_url() ?>">
    <meta name="twitter:title" content="<?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?>">
    <meta name="twitter:description" content="<?= esc(setting('App.siteDesc') ?? 'Agile Project Management & Team Velocity Platform') ?>">
    <meta name="twitter:image" content="<?= base_url('assets/img/app_hero.jpg') ?>">

    <!-- third party css -->
    <?= $this->renderSection('css') ?>
    
    <!-- App css -->
    <link href="<?= base_url('assets/hyper/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/hyper/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?= base_url('assets/hyper/css/app-dark.min.css') ?>" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled" />
    
    <script>
        (function() {
            var theme = localStorage.getItem('hyper_theme');
            if (theme === 'dark') {
                document.getElementById('light-style')?.setAttribute('disabled', 'disabled');
                document.getElementById('dark-style')?.removeAttribute('disabled');
            }
        })();
    </script>
    
    <style>
        .side-nav .side-nav-link i {
            font-size: 1.1rem;
            margin-right: 10px;
            vertical-align: middle;
        }
        .avatar-initials {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .side-nav-title {
            letter-spacing: 0.05em;
            pointer-events: none;
            cursor: default;
            font-size: 11px;
            text-transform: uppercase;
            color: #8391a2;
            font-weight: 700;
            padding: 12px 20px 6px;
        }
        #theme-toggle-btn {
            cursor: pointer;
            padding: 0 12px;
            display: flex;
            align-items: center;
            height: 70px;
        }
        /* Robust Sidebar Active Highlighting */
        .side-nav .side-nav-item.menuitem-active > .side-nav-link,
        .side-nav .side-nav-item > .side-nav-link.active {
            color: #727cf5 !important;
            font-weight: 600 !important;
            background-color: rgba(114, 124, 245, 0.12) !important;
            border-left: 3px solid #727cf5 !important;
        }
        .side-nav .side-nav-item.menuitem-active > .side-nav-link i,
        .side-nav .side-nav-item > .side-nav-link.active i {
            color: #727cf5 !important;
        }
    </style>

    <?= $this->renderSection('head') ?>
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <a href="<?= site_url('dashboard') ?>" class="logo text-center logo-light py-3 d-flex align-items-center justify-content-center">
                <img src="<?= base_url('assets/img/app_logo.jpg') ?>" alt="Logo" class="rounded-circle me-2 shadow-sm" style="width: 32px; height: 32px; object-fit: cover;">
                <span class="logo-lg text-white font-18 fw-bold">
                    <?= esc(setting('App.siteName')) ?>
                </span>
                <span class="logo-sm text-white font-18 fw-bold">
                    <?= strtoupper(substr(setting('App.siteName') ?? 'C', 0, 1)) ?>
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <?php 
                    $uri = uri_string();
                    $isDash = in_array($uri, ['dashboard', 'home', 'user/dashboard', 'user/home', '']);
                    $isKanban = str_contains($uri, 'kanban');
                    $isProjects = (str_starts_with($uri, 'projects') && !$isKanban);
                    $isTime = str_starts_with($uri, 'time');
                    $isCal = str_starts_with($uri, 'calendar');
                    $isNotes = str_starts_with($uri, 'notes');
                    $isAnalytics = str_starts_with($uri, 'analytics');
                    $isTeam = str_contains($uri, 'team');
                    $isApprovals = str_contains($uri, 'approvals');
                    $isReports = str_contains($uri, 'reports');
                    $isAdminSettings = str_contains($uri, 'admin/settings');
                    $isAdminTelemetry = str_contains($uri, 'admin/telemetry');
                    $isProfile = ($uri === 'settings' || $uri === 'user/settings');
                ?>
                <!--- Sidemenu -->
                <ul class="side-nav">
                    <li class="side-nav-title side-nav-item">Core Workspace</li>
                    
                    <li class="side-nav-item <?= $isDash ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('dashboard') ?>" class="side-nav-link <?= $isDash ? 'active' : '' ?>">
                            <i class="uil-home-alt text-primary"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isProjects ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('projects') ?>" class="side-nav-link <?= $isProjects ? 'active' : '' ?>">
                            <i class="uil-briefcase text-success"></i>
                            <span> Projects </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isKanban ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('kanban') ?>" class="side-nav-link <?= $isKanban ? 'active' : '' ?>">
                            <i class="uil-clipboard-alt text-info"></i>
                            <span> Kanban Board </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isTime ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('time') ?>" class="side-nav-link <?= $isTime ? 'active' : '' ?>">
                            <i class="uil-clock text-warning"></i>
                            <span> Time Tracker </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isCal ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('calendar') ?>" class="side-nav-link <?= $isCal ? 'active' : '' ?>">
                            <i class="uil-calender text-danger"></i>
                            <span> Calendar </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isNotes ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('notes') ?>" class="side-nav-link <?= $isNotes ? 'active' : '' ?>">
                            <i class="uil-notes text-secondary"></i>
                            <span> Scratch Notes </span>
                        </a>
                    </li>
                    <li class="side-nav-item <?= $isAnalytics ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('analytics') ?>" class="side-nav-link <?= $isAnalytics ? 'active' : '' ?>">
                            <i class="uil-chart-line text-purple"></i>
                            <span> Analytics </span>
                        </a>
                    </li>

                    <?php if ($isManager): ?>
                        <li class="side-nav-title side-nav-item mt-2">Team Management</li>
                        <li class="side-nav-item <?= $isTeam ? 'menuitem-active' : '' ?>">
                            <a href="<?= site_url('manager/team') ?>" class="side-nav-link <?= $isTeam ? 'active' : '' ?>">
                                <i class="uil-users-alt text-success"></i>
                                <span> Team Workload </span>
                            </a>
                        </li>
                        <li class="side-nav-item <?= $isApprovals ? 'menuitem-active' : '' ?>">
                            <a href="<?= site_url('manager/approvals') ?>" class="side-nav-link <?= $isApprovals ? 'active' : '' ?>">
                                <i class="uil-check-circle text-info"></i>
                                <span> Work Approvals </span>
                            </a>
                        </li>
                        <li class="side-nav-item <?= $isReports ? 'menuitem-active' : '' ?>">
                            <a href="<?= site_url('manager/reports') ?>" class="side-nav-link <?= $isReports ? 'active' : '' ?>">
                                <i class="uil-file-alt text-warning"></i>
                                <span> Sprint Reports </span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($isAdmin): ?>
                        <li class="side-nav-title side-nav-item mt-2">Administration</li>
                        <li class="side-nav-item <?= $isAdminSettings ? 'menuitem-active' : '' ?>">
                            <a href="<?= site_url('admin/settings') ?>" class="side-nav-link <?= $isAdminSettings ? 'active' : '' ?>">
                                <i class="uil-sliders-v-alt text-danger"></i>
                                <span> System Settings </span>
                            </a>
                        </li>
                        <li class="side-nav-item <?= $isAdminTelemetry ? 'menuitem-active' : '' ?>">
                            <a href="<?= site_url('admin/telemetry') ?>" class="side-nav-link <?= $isAdminTelemetry ? 'active' : '' ?>">
                                <i class="uil-server text-light"></i>
                                <span> Telemetry & Logs </span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="side-nav-title side-nav-item mt-2">User Settings</li>
                    <li class="side-nav-item <?= $isProfile ? 'menuitem-active' : '' ?>">
                        <a href="<?= site_url('settings') ?>" class="side-nav-link <?= $isProfile ? 'active' : '' ?>">
                            <i class="uil-cog text-info"></i>
                            <span> Profile & Security </span>
                        </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                <div class="navbar-custom">
                    <ul class="list-unstyled topbar-menu float-end mb-0 d-flex align-items-center">
                        <li class="notification-list me-1">
                            <a class="nav-link end-bar-toggle" href="javascript:void(0);" id="theme-toggle-btn" title="Toggle Light / Dark Theme" role="button">
                                <i class="uil-moon font-22" id="theme-toggle-icon"></i>
                            </a>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar me-2"> 
                                    <span class="avatar-initials bg-primary text-white rounded-circle shadow-sm">
                                        <?= esc($initials) ?>
                                    </span>
                                </span>
                                <span>
                                    <span class="account-user-name fw-bold"><?= esc($rawName) ?></span>
                                    <span class="account-position text-muted font-12">
                                        <?= $isAdmin ? 'Administrator' : ($isManager ? 'Manager' : 'Developer') ?>
                                    </span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Signed in as <strong><?= esc($rawName) ?></strong></h6>
                                </div>
                                <a href="<?= site_url('settings') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>
                                <a href="<?= site_url('auth/logout') ?>" class="dropdown-item notify-item text-danger">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu font-20"></i>
                    </button>
                </div>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid py-3">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- container -->
            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer py-3 border-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center font-14">
                            <span class="text-muted"><i class="mdi mdi-calendar-today text-primary me-1"></i> <?= date('l, F j, Y') ?></span>
                            <span class="mx-2 text-muted">•</span>
                            <span><?= date('Y') ?> © <strong><?= esc(setting('App.siteName')) ?></strong></span>
                            <span class="mx-2 text-muted">•</span>
                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#appVersionModal" class="badge bg-primary-lighten text-primary text-decoration-none px-2 py-1 font-12" title="View Version & Changelog">
                                <i class="mdi mdi-tag-outline me-1"></i>v1.0.0
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- App Version & Changelog Modal -->
    <div class="modal fade" id="appVersionModal" tabindex="-1" aria-labelledby="appVersionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="appVersionModalLabel">
                        <i class="mdi mdi-information-outline me-1"></i> <?= esc(setting('App.siteName')) ?> v1.0.0
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-success-lighten text-success font-13 px-3 py-1">Latest Release</span>
                        <span class="text-muted font-13 ms-auto"><i class="mdi mdi-calendar-outline me-1"></i> September 2026</span>
                    </div>
                    
                    <h5 class="fw-bold mb-2 text-dark">Release Highlights:</h5>
                    <ul class="font-14 text-muted ps-3 mb-3">
                        <li class="mb-1"><strong>Hyper SaaS Theme:</strong> Upgraded to Bootstrap 5 with responsive dark/light layouts.</li>
                        <li class="mb-1"><strong>Interactive Drag & Drop Kanban:</strong> Real-time ticket management with visual priority badges.</li>
                        <li class="mb-1"><strong>Automated Database Seeding:</strong> 1-click startup with default accounts & demo projects.</li>
                        <li class="mb-1"><strong>Dynamic Colored Avatars:</strong> Initials-based profile avatars for all team members.</li>
                        <li class="mb-1"><strong>Time Tracker & PDF Reports:</strong> Integrated effort tracking and printable sprint reports.</li>
                    </ul>
                    
                    <div class="alert alert-light border font-13 text-muted mb-0">
                        <i class="mdi mdi-shield-check text-success me-1"></i> Production Build running on Railway / Docker.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bundle -->
    <script src="<?= base_url('assets/hyper/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('assets/hyper/js/app.min.js') ?>"></script>
    
    <script>
        (function() {
            var toggleBtn = document.getElementById('theme-toggle-btn');
            var toggleIcon = document.getElementById('theme-toggle-icon');
            var lightStyle = document.getElementById('light-style');
            var darkStyle = document.getElementById('dark-style');

            function applyTheme(theme) {
                if (theme === 'dark') {
                    if (lightStyle) lightStyle.setAttribute('disabled', 'disabled');
                    if (darkStyle) darkStyle.removeAttribute('disabled');
                    if (toggleIcon) {
                        toggleIcon.className = 'uil-sun font-22 text-warning';
                    }
                    document.body.setAttribute('data-layout-config', JSON.stringify({
                        "leftSideBarTheme": "dark",
                        "layoutBoxed": false,
                        "leftSidebarCondensed": false,
                        "leftSidebarScrollable": false,
                        "darkMode": true,
                        "showRightSidebarOnStart": true
                    }));
                } else {
                    if (darkStyle) darkStyle.setAttribute('disabled', 'disabled');
                    if (lightStyle) lightStyle.removeAttribute('disabled');
                    if (toggleIcon) {
                        toggleIcon.className = 'uil-moon font-22';
                    }
                    document.body.setAttribute('data-layout-config', JSON.stringify({
                        "leftSideBarTheme": "dark",
                        "layoutBoxed": false,
                        "leftSidebarCondensed": false,
                        "leftSidebarScrollable": false,
                        "darkMode": false,
                        "showRightSidebarOnStart": true
                    }));
                }
            }

            var currentTheme = localStorage.getItem('hyper_theme') || 'light';
            applyTheme(currentTheme);

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var newTheme = (localStorage.getItem('hyper_theme') === 'dark') ? 'light' : 'dark';
                    localStorage.setItem('hyper_theme', newTheme);
                    applyTheme(newTheme);
                });
            }
        })();
    </script>
    
    <?= $this->renderSection('js') ?>
</body>
</html>
