<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= esc($pageTitle ?? 'Chege OS — Project & Productivity Tracker') ?></title>

    <meta name="description" content="<?= esc($metaDescription ?? 'Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.') ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Bootstrap 3 & Font Awesome 4 (Ace bundled) -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />
    <!-- Font Awesome 5 for newer icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/fonts.googleapis.com.css') ?>" />

    <!-- Ace Core Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?= base_url('assets/ace/css/ace-skins.min.css') ?>" />

    <style>
        body { background-color: #f5f7fa; padding-top: 50px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; }
        .public-navbar { background-color: #438eb9; border: none; border-radius: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .public-navbar .navbar-brand { color: #fff !important; font-size: 24px; font-weight: bold; padding-top: 15px; }
        .public-navbar .nav > li > a { color: #fff; font-size: 15px; padding-top: 15px; padding-bottom: 15px; }
        .public-navbar .nav > li > a:hover, .public-navbar .nav > li > a:focus { background-color: rgba(255,255,255,0.1); color: #fff; }
        .jumbotron-ace { background-color: #fff; border-bottom: 1px solid #e5e5e5; padding: 80px 0; text-align: center; margin-bottom: 0; }
        .jumbotron-ace h1 { font-size: 48px; font-weight: 300; margin-bottom: 20px; color: #2679b5; }
        .jumbotron-ace p { font-size: 18px; color: #555; margin-bottom: 30px; max-width: 800px; margin-left: auto; margin-right: auto; line-height: 1.6; }
        .feature-box { background: #fff; padding: 30px; border: 1px solid #e5e5e5; border-radius: 4px; text-align: center; margin-bottom: 30px; transition: transform 0.3s; min-height: 250px; }
        .feature-box:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); border-color: #d5e4f1; }
        .feature-box .icon { font-size: 40px; color: #438eb9; margin-bottom: 20px; }
        .feature-box h3 { font-size: 20px; margin-bottom: 15px; color: #478fca; font-weight: normal; }
        .feature-box p { color: #666; font-size: 14px; line-height: 1.6; }
        .public-footer { background: #333; color: #999; padding: 40px 0; margin-top: 0; text-align: center; border-top: 3px solid #438eb9; }
        .public-footer a { color: #fff; text-decoration: none; }
        .public-footer a:hover { color: #438eb9; text-decoration: underline; }
        .section-header { text-align: center; margin: 50px 0 40px; }
        .section-header h2 { color: #2679b5; font-weight: 300; }
        .section-header p { color: #777; font-size: 16px; }
    </style>
</head>
<body class="no-skin">

<!-- Navbar -->
<nav class="navbar navbar-default navbar-fixed-top public-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" style="border-color: transparent;">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" style="background-color: #fff;"></span>
                <span class="icon-bar" style="background-color: #fff;"></span>
                <span class="icon-bar" style="background-color: #fff;"></span>
            </button>
            <a class="navbar-brand" href="/">
                <i class="fa fa-leaf"></i> Chege OS
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/features"><i class="fa fa-list"></i> Features</a></li>
                <li><a href="/setup"><i class="fa fa-cogs"></i> Setup Guide</a></li>
                <li><a href="/faqs"><i class="fa fa-question-circle"></i> FAQs</a></li>
                <?php if(auth()->loggedIn()): ?>
                    <li><a href="/home" class="btn btn-warning btn-sm" style="margin-top: 10px; color: #fff !important; border: none;"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                <?php else: ?>
                    <li><a href="/auth/login"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="/auth/register" class="btn btn-primary btn-sm" style="margin-top: 10px; color: #fff !important; border-color: rgba(255,255,255,0.3);"><i class="fa fa-user-plus"></i> Register Free</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
