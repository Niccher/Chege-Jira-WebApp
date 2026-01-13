<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ChegeOS • Side-Project Dashboard') ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --sidebar-width: 250px;
            --primary-color: #6366f1;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --border-radius: 12px;
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #0f172a;
            color: #e2e8f0;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #1e293b;
            border-right: 1px solid #334155;
            padding: 1.5rem 1rem;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-collapsed {
            transform: translateX(-100%);
        }

        .brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            color: var(--primary-color);
        }

        .nav-link {
            color: #cbd5e1;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #334155;
            color: white;
        }

        .nav-icon {
            width: 24px;
            text-align: center;
            margin-right: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .full-width {
            margin-left: 0;
        }

        /* Header */
        .top-bar {
            background-color: #1e293b;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        /* Cards */
        .stat-card {
            background-color: #1e293b;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid #334155;
            transition: transform 0.2s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: #475569;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Project Cards */
        .project-card {
            background-color: #1e293b;
            border-radius: var(--border-radius);
            border: 1px solid #334155;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.2s;
        }

        .project-card:hover {
            border-color: #475569;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .project-health {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .health-good {
            background-color: var(--success-color);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.3);
        }

        .health-warning {
            background-color: var(--warning-color);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.3);
        }

        .health-danger {
            background-color: var(--danger-color);
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
        }

        /* Progress Bar */
        .progress {
            height: 8px;
            background-color: #334155;
            border-radius: 4px;
            margin: 1rem 0;
        }

        .progress-bar {
            border-radius: 4px;
        }

        /* Focus Projects */
        .focus-project {
            background-color: rgba(99, 102, 241, 0.1);
            border-left: 4px solid var(--primary-color);
        }

        /* Pagination Styling */
        .pagination .page-link {
            background-color: #1e293b;
            border-color: #334155;
            color: #cbd5e1;
            transition: all 0.2s;
            margin: 0 2px;
            border-radius: 6px !important;
        }

        .pagination .page-link:hover {
            background-color: #334155;
            color: white;
            border-color: #475569;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            background-color: #0f172a;
            border-color: #1e293b;
            color: #475569;
        }

        /* Sticky Footer & Layout Improvements */
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            transition: all 0.3s;
            min-height: 100vh;
        }

        .full-width {
            margin-left: 0;
        }

        .content-wrap {
            flex: 1;
        }

        footer {
            margin-top: auto;
            padding: 1.5rem 0;
            border-top: 1px solid #334155;
            background-color: #0f172a;
            position: relative;
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar-mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">