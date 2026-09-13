<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Chege JIRA • Side-Project Dashboard') ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('favicon.png') ?>">

    <!-- Theme Switcher Logic (Must be in head to prevent flash) -->
    <script>
        const theme = localStorage.getItem('theme') || 'dark';
        const stylesheet = document.createElement('link');
        stylesheet.rel = 'stylesheet';
        stylesheet.id = 'theme-stylesheet';
        stylesheet.href = `<?= base_url('assets/css') ?>/${theme}.css`;
        document.head.appendChild(stylesheet);
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">