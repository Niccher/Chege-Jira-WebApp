<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | Chege JIRA</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Bootstrap 3 & Font Awesome 4 (Ace bundled) -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />

    <!-- Font Awesome 5 for any fa5 icons used in views -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/fonts.googleapis.com.css') ?>" />

    <!-- Ace Core Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace-skins.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/modern-ace.css') ?>" />

    <!-- Ace settings (must be in <head>) -->
    <script src="<?= base_url('assets/ace/js/ace-extra.min.js') ?>"></script>

    <!-- Page-specific head content -->
    <?= $this->renderSection('head') ?>

    <style>
        /* Ensure content area starts after sidebar properly */
        .main-content { min-height: calc(100vh - 45px); }
        /* Fix table responsiveness */
        .table-responsive { overflow-x: auto; }
        /* Stat value styles for dashboard cards */
        .stat-value { font-size: 2rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: 0.85rem; color: #777; margin-top: 4px; }
        /* Fix Bootstrap 3 row gutter for our content */
        .page-content > .row { margin-left: -10px; margin-right: -10px; }
        .page-content > .row > [class*="col-"] { padding-left: 10px; padding-right: 10px; }
    </style>
</head>

<body class="no-skin">
    <!-- #section:basics/navbar -->
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <!-- Sidebar toggle button -->
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Brand -->
            <div class="navbar-header pull-left">
                <a href="<?= site_url('/') ?>" class="navbar-brand">
                    <small>
                        <i class="fa fa-cubes"></i>
                        <?= esc(setting('App.siteName') ?? 'Chege Jira') ?>
                    </small>
                </a>
            </div>

            <!-- Nav right: user dropdown -->
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue dropdown">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <i class="fa fa-user"></i>
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?= session('first_name') ?? session('username') ?? 'User' ?>
                            </span>
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li class="<?= url_is('settings*') ? 'active' : '' ?>">
                    <a href="<?= site_url('settings') ?>">
                                    <i class="fa fa-cog"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="<?= url_is('auth/logout*') ? 'active' : '' ?>">
                    <a href="<?= site_url('auth/logout') ?>">
                                    <i class="fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <!-- #section:basics/sidebar -->
        <script type="text/javascript">
            try {
                ace.settings.check('main-container', 'fixed');
            } catch(e) {}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.check('sidebar', 'fixed');
                } catch(e) {}
            </script>

            <ul class="nav nav-list">
                <li class="<?= url_is('home') ? 'active' : '' ?>">
                    <a href="<?= site_url('home') ?>">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <li class="separator"></li>

                <li class="<?= url_is('projects*') ? 'active' : '' ?>">
                    <a href="<?= site_url('projects') ?>">
                        <i class="menu-icon fa fa-folder-open"></i>
                        <span class="menu-text">Projects</span>
                    </a>
                </li>

                <li class="<?= url_is('kanban*') ? 'active' : '' ?>">
                    <a href="<?= site_url('kanban') ?>">
                        <i class="menu-icon fa fa-columns"></i>
                        <span class="menu-text">Kanban Board</span>
                    </a>
                </li>

                <li class="<?= url_is('my-tasks*') ? 'active' : '' ?>">
                    <a href="<?= site_url('my-tasks') ?>">
                        <i class="menu-icon fa fa-tasks"></i>
                        <span class="menu-text">My Tasks</span>
                    </a>
                </li>

                <li class="<?= url_is('calendar*') ? 'active' : '' ?>">
                    <a href="<?= site_url('calendar') ?>">
                        <i class="menu-icon fa fa-calendar"></i>
                        <span class="menu-text">Calendar</span>
                    </a>
                </li>

                <li class="<?= url_is('notes*') ? 'active' : '' ?>">
                    <a href="<?= site_url('notes') ?>">
                        <i class="menu-icon fa fa-sticky-note"></i>
                        <span class="menu-text">Notes</span>
                    </a>
                </li>

                <li class="<?= url_is('time*') ? 'active' : '' ?>">
                    <a href="<?= site_url('time') ?>">
                        <i class="menu-icon fa fa-clock-o"></i>
                        <span class="menu-text">Time Logs</span>
                    </a>
                </li>

                <li class="<?= url_is('analytics*') ? 'active' : '' ?>">
                    <a href="<?= site_url('analytics') ?>">
                        <i class="menu-icon fa fa-bar-chart"></i>
                        <span class="menu-text">Analytics</span>
                    </a>
                </li>

                <li class="separator"></li>

                <li class="<?= url_is('settings*') ? 'active' : '' ?>">
                    <a href="<?= site_url('settings') ?>">
                        <i class="menu-icon fa fa-cog"></i>
                        <span class="menu-text">Settings</span>
                    </a>
                </li>
            </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
                   data-icon1="ace-icon fa fa-angle-double-left"
                   data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content-inner">
                <!-- Breadcrumbs -->
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="<?= site_url('home') ?>">Home</a>
                        </li>
                        <?= $this->renderSection('breadcrumb') ?>
                    </ul>
                </div><!-- /.breadcrumbs -->

                <div class="page-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <?= esc(setting('App.siteName') ?? 'Chege Jira') ?>
                        &copy; <?= date('Y') ?>
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/ace/js/jquery-2.1.4.min.js') ?>"></script>
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement)
            document.write("<script src='<?= base_url('assets/ace/js/jquery.mobile.custom.min.js') ?>'>" + "<" + "/script>");
    </script>

    <!-- Bootstrap 3 JS -->
    <script src="<?= base_url('assets/ace/js/bootstrap.min.js') ?>"></script>

    <!-- Ace Scripts -->
    <script src="<?= base_url('assets/ace/js/ace-elements.min.js') ?>"></script>
    <script src="<?= base_url('assets/ace/js/ace.min.js') ?>"></script>

    <!-- Page-specific scripts -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>
