<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?= esc($pageTitle ?? (setting('App.siteName') . ' — Project & Productivity Tracker')) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= esc($metaDescription ?? 'Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.') ?>" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/hyper/images/favicon.ico') ?>">

    <!-- App css -->
    <link href="<?= base_url('assets/hyper/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/hyper/css/app.min.css') ?>" rel="stylesheet" type="text/css" id="light-style" />
    
    <style>
        .landing-navbar {
            padding: 15px 0;
            background-color: #313a46;
        }
        .landing-navbar .nav-link { color: rgba(255,255,255,.75); font-weight: 500; }
        .landing-navbar .nav-link:hover { color: #fff; }
        .landing-navbar .navbar-brand { color: #fff; font-weight: 700; font-size: 24px; }
        .hero-section {
            padding: 100px 0 60px 0;
            background-color: #f7f9fc;
        }
    </style>
</head>
<body class="loading" data-layout-config='{"darkMode":false}'>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg landing-navbar sticky-top">
        <div class="container">
            <!-- logo -->
            <a href="<?= site_url() ?>" class="navbar-brand me-4">
                <i class="mdi mdi-leaf"></i> <?= esc(setting('App.siteName')) ?>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('features') ?>">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('compare') ?>">Compare</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('community') ?>">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('setup') ?>">Setup Guide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('faqs') ?>">FAQs</a>
                    </li>
                    <?php if (auth()->loggedIn()): ?>
                        <li class="nav-item ms-3">
                            <a href="<?= site_url('user/dashboard') ?>" class="btn btn-primary btn-sm">Go to Dashboard</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-3">
                            <a href="<?= site_url('auth/login') ?>" class="nav-link">Log In</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="<?= site_url('auth/register') ?>" class="btn btn-success btn-sm">Sign Up</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->
