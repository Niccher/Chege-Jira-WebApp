<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') ?> | <?= esc(setting('App.siteName')) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc(setting('App.siteName')) ?> - Agile Project Management & Team Collaboration" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/hyper/images/favicon.ico') ?>">

    <!-- App css -->
    <link href="<?= base_url('assets/hyper/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/hyper/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style" />
    <link href="<?= base_url('assets/hyper/css/app-dark.min.css') ?>" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled" />

    <style>
        .auth-fluid {
            position: relative;
            display: flex;
            align-items: stretch;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .auth-fluid .auth-fluid-form-box {
            max-width: 520px;
            border-radius: 0;
            z-index: 2;
            padding: 3rem 2.5rem;
            background-color: var(--bs-body-bg, #ffffff);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .auth-fluid .auth-fluid-right {
            flex: 1;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4rem;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .auth-fluid-right::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .auth-fluid-right::after {
            content: '';
            position: absolute;
            bottom: -15%;
            left: -10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.2) 0%, rgba(0,0,0,0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .feature-card-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1.25rem;
            transition: transform 0.2s ease;
        }
        .feature-card-glass:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.08);
        }
    </style>
</head>

<body class="loading">
    <div class="auth-fluid">
        <!-- Auth Form Pane -->
        <div class="auth-fluid-form-box">
            <!-- Header Logo -->
            <div class="mb-4">
                <a href="<?= site_url() ?>" class="d-inline-flex align-items-center text-decoration-none">
                    <img src="<?= base_url('assets/img/app_logo.jpg') ?>" alt="Logo" class="rounded-circle me-2 shadow-sm" style="width: 36px; height: 36px; object-fit: cover;">
                    <span class="font-20 fw-bold text-body">
                        <?= esc(setting('App.siteName')) ?>
                    </span>
                </a>
            </div>

            <!-- Main Auth Content Area -->
            <div class="my-auto py-2">
                <?= $this->renderSection('content') ?>
            </div>

            <!-- Footer -->
            <div class="mt-4 pt-3 border-top text-muted font-12 d-flex justify-content-between align-items-center">
                <span><?= date('Y') ?> © <?= esc(setting('App.siteName')) ?></span>
                <span class="badge bg-light text-secondary font-11">v1.0.0</span>
            </div>
        </div>

        <!-- Auth Showcase / Brand Pane -->
        <div class="auth-fluid-right d-none d-lg-flex">
            <div>
                <span class="badge bg-primary-lighten text-info px-3 py-1 font-12 rounded-pill mb-3">
                    <i class="mdi mdi-rocket-launch me-1"></i> Agile Project Management
                </span>
                <h1 class="display-6 fw-bold text-white mb-2">
                    Supercharge Team Velocity & Visibility
                </h1>
                <p class="text-white-50 font-16 mb-4" style="max-width: 600px;">
                    Track sprints, coordinate tasks with interactive Kanban boards, log effort, and ship software reliably.
                </p>
            </div>

            <!-- Feature Showcase Cards -->
            <div class="row g-3 my-auto" style="max-width: 700px;">
                <div class="col-md-6">
                    <div class="feature-card-glass h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-xs bg-primary text-white rounded d-flex align-items-center justify-content-center me-2">
                                <i class="mdi mdi-view-column"></i>
                            </div>
                            <h6 class="text-white mb-0 fw-bold">Interactive Kanban</h6>
                        </div>
                        <p class="text-white-50 font-13 mb-0">
                            Smooth drag-and-drop workflow with customizable statuses, priority flags, and real-time updates.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-card-glass h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-xs bg-success text-white rounded d-flex align-items-center justify-content-center me-2">
                                <i class="mdi mdi-timer-outline"></i>
                            </div>
                            <h6 class="text-white mb-0 fw-bold">Worklogs & Time Tracking</h6>
                        </div>
                        <p class="text-white-50 font-13 mb-0">
                            Live stopwatch timers, automated daily pacing metrics, and instant PDF sprint reporting.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-card-glass h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-xs bg-warning text-white rounded d-flex align-items-center justify-content-center me-2">
                                <i class="mdi mdi-shield-check-outline"></i>
                            </div>
                            <h6 class="text-white mb-0 fw-bold">Enterprise Security</h6>
                        </div>
                        <p class="text-white-50 font-13 mb-0">
                            Role-based access controls for Developers, Managers, and Admins with full audit trails.
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="feature-card-glass h-100">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar-xs bg-info text-white rounded d-flex align-items-center justify-content-center me-2">
                                <i class="mdi mdi-chart-bell-curve"></i>
                            </div>
                            <h6 class="text-white mb-0 fw-bold">Live Telemetry</h6>
                        </div>
                        <p class="text-white-50 font-13 mb-0">
                            Real-time MySQL container diagnostics, container memory telemetry, and workload health.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Testimonial Quote -->
            <div class="pt-4 border-top border-secondary border-opacity-25 d-flex align-items-center justify-content-between">
                <div>
                    <div class="text-warning mb-1">
                        <i class="mdi mdi-star"></i>
                        <i class="mdi mdi-star"></i>
                        <i class="mdi mdi-star"></i>
                        <i class="mdi mdi-star"></i>
                        <i class="mdi mdi-star"></i>
                    </div>
                    <p class="text-white-50 font-13 mb-0 fst-italic">
                        "The simplest and fastest agile platform we've used for coordinating engineering tasks."
                    </p>
                </div>
                <div class="text-end">
                    <span class="badge bg-success-lighten text-success font-12">Production Ready</span>
                </div>
            </div>
        </div>
    </div>

    <!-- bundle -->
    <script src="<?= base_url('assets/hyper/js/vendor.min.js') ?>"></script>
    <script src="<?= base_url('assets/hyper/js/app.min.js') ?>"></script>
</body>
</html>
