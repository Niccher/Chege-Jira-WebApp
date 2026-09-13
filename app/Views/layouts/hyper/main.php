<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc(setting('App.siteName')) ?> - Project Tracking" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/hyper/images/favicon.ico') ?>">

    <!-- third party css -->
    <?= $this->renderSection('css') ?>
    
    <!-- App css -->
    <link href="<?= base_url('assets/hyper/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/hyper/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?= base_url('assets/hyper/css/app-dark.min.css') ?>" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled" />
    
    <?= $this->renderSection('head') ?>
</head>

<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <!-- ========== Left Sidebar Start ========== -->
        <div class="leftside-menu">
            <a href="<?= site_url() ?>" class="logo text-center logo-light">
                <span class="logo-lg text-white font-20 fw-bold">
                    <i class="mdi mdi-leaf"></i> <?= esc(setting('App.siteName')) ?>
                </span>
                <span class="logo-sm text-white font-20 fw-bold">
                    <i class="mdi mdi-leaf"></i>
                </span>
            </a>

            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!--- Sidemenu -->
                <ul class="side-nav">
                    <li class="side-nav-title side-nav-item">Navigation</li>
                    <li class="side-nav-item">
                        <a href="<?= site_url('user/dashboard') ?>" class="side-nav-link">
                            <i class="uil-home-alt"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= site_url('user/projects') ?>" class="side-nav-link">
                            <i class="uil-briefcase"></i>
                            <span> Projects </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= site_url('user/kanban') ?>" class="side-nav-link">
                            <i class="uil-clipboard-alt"></i>
                            <span> Kanban Board </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?= site_url('user/time') ?>" class="side-nav-link">
                            <i class="uil-clock"></i>
                            <span> Time Tracking </span>
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
                    <ul class="list-unstyled topbar-menu float-end mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar"> 
                                    <i class="mdi mdi-account-circle font-32"></i>
                                </span>
                                <span>
                                    <span class="account-user-name"><?= auth()->user()->username ?? 'Guest' ?></span>
                                    <span class="account-position"><?= auth()->user() && auth()->user()->inGroup('admin') ? 'Admin' : 'User' ?></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                                <a href="<?= site_url('user/settings') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-account-circle me-1"></i>
                                    <span>My Account</span>
                                </a>
                                <a href="<?= site_url('auth/logout') ?>" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="button-menu-mobile open-left">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </div>
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- container -->
            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <?= date('Y') ?> © <?= esc(setting('App.siteName')) ?>
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

    <!-- bundle -->
    <script src="<?= base_url('assets/hyper/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('assets/hyper/js/app.min.js') ?>"></script>
    
    <?= $this->renderSection('js') ?>
</body>
</html>
