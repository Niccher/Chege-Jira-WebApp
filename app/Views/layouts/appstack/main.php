<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->renderSection('title') ?> | Chege JIRA</title>

    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- AppStack Base Styles -->
    <link class="js-stylesheet" href="<?= base_url('assets/appstack/css/light.css') ?>" rel="stylesheet">
    
    <!-- Custom Page Styles -->
    <?= $this->renderSection('head') ?>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="<?= site_url('/') ?>">
                    <i class="align-middle me-2 fas fa-cubes"></i>
                    <span class="align-middle">Chege JIRA</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main</li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/projects') ?>">
                            <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Projects</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/kanban') ?>">
                            <i class="align-middle" data-feather="trello"></i> <span class="align-middle">Kanban</span>
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/analytics') ?>">
                            <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Analytics</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/calendar') ?>">
                            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/notes') ?>">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Notes</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/time') ?>">
                            <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Time Logs</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Account</li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= site_url('user/settings') ?>">
                            <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Panel -->
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark">User</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="<?= site_url('user/settings') ?>"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                &copy; <?= date('Y') ?> - <a href="<?= site_url('/') ?>" class="text-muted">Chege JIRA</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= base_url('assets/appstack/js/app.js') ?>"></script>
    
    <!-- Custom Page Scripts -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>
