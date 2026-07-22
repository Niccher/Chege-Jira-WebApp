<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Chege JIRA — Project & Productivity Tracker') ?></title>
    <meta name="description" content="<?= esc($metaDescription ?? 'Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.') ?>">
    <meta name="keywords" content="<?= esc($metaKeywords ?? 'project management, kanban, time tracking, productivity, self-hosted, docker') ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Chege JIRA">

    <!-- Open Graph -->
    <meta property="og:title" content="Chege JIRA — Project & Productivity Tracker">
    <meta property="og:description" content="Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image" content="<?= base_url('favicon.png') ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Chege JIRA">
    <meta name="twitter:description" content="Self-hosted project management platform.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('favicon.png') ?>">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ef4444;
            --primary-dark: #dc2626;
            --bg: #0a0a0a;
            --bg-card: #121212;
            --bg-elevated: #1a1a1a;
            --text: #f3f4f6;
            --text-muted: #9ca3af;
            --border: #262626;
            --success: #059669;
            --warning: #d97706;
            --info: #3b82f6;
        }
        * { font-family: 'Space Grotesk', sans-serif; border-radius: 0 !important; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        ::selection { background: var(--primary); color: #000; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); }
        ::-webkit-scrollbar-thumb:hover { background: #444; }

        .container { max-width: 1140px; }

        /* Navigation */
        .navbar-landing {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: rgba(10, 10, 10, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 0;
        }
        .navbar-landing .brand {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-landing .brand i { color: var(--primary); }
        .navbar-landing .nav-link-custom {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.4rem 0.75rem;
            transition: color 0.2s ease;
        }
        .navbar-landing .nav-link-custom:hover,
        .navbar-landing .nav-link-custom.active { color: var(--text); }
        .btn-landing-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: var(--primary);
            color: #000;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            text-decoration: none;
            border: 2px solid var(--primary);
            transition: all 0.2s ease;
        }
        .btn-landing-primary:hover {
            background: transparent;
            color: var(--primary);
            box-shadow: 4px 4px 0 var(--primary);
            transform: translate(-2px, -2px);
        }
        .btn-landing-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.25rem;
            background: transparent;
            color: var(--text);
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            text-decoration: none;
            border: 2px solid var(--border);
            transition: all 0.2s ease;
        }
        .btn-landing-secondary:hover {
            border-color: var(--text);
            box-shadow: 4px 4px 0 var(--border);
            transform: translate(-2px, -2px);
        }

        /* Section shared */
        section { padding: 5rem 1.5rem; }
        .section-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }
        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }
        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 600px;
            margin: 0 auto 3rem;
            line-height: 1.7;
        }
        .page-header {
            padding-top: 7rem;
            text-align: center;
            background-image: linear-gradient(var(--border) 1px, transparent 1px),
                              linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: center center;
        }

        /* Hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 6rem 1.5rem 4rem;
            background-image: linear-gradient(var(--border) 1px, transparent 1px),
                              linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: center center;
            position: relative;
        }
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 50%, rgba(239, 68, 68, 0.08) 0%, transparent 60%);
            pointer-events: none;
        }
        .hero-content { position: relative; z-index: 1; max-width: 800px; }
        .hero-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border: 1px solid var(--border);
            background: var(--bg-card);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }
        .hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            letter-spacing: -2px;
        }
        .hero h1 span { color: var(--primary); }
        .hero p {
            font-size: 1.15rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto 2rem;
            line-height: 1.7;
        }
        .hero-actions { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

        /* Features */
        .features-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; }
        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 2rem;
            transition: all 0.2s ease;
        }
        .feature-card:hover {
            border-color: var(--primary);
            transform: translateY(-4px);
            box-shadow: 8px 8px 0 rgba(239, 68, 68, 0.1);
        }
        .feature-icon {
            width: 48px; height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(239, 68, 68, 0.1);
            color: var(--primary);
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
        }
        .feature-card h3 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .feature-card p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Steps */
        .steps { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1.5rem; counter-reset: step; }
        .step-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            padding: 2rem;
            position: relative;
            text-align: center;
        }
        .step-card::before {
            counter-increment: step;
            content: '0' counter(step);
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 2.5rem;
            font-weight: 700;
            color: rgba(239, 68, 68, 0.15);
            line-height: 1;
        }
        .step-icon { font-size: 2rem; color: var(--primary); margin-bottom: 1rem; }
        .step-card h3 { font-size: 1.05rem; font-weight: 600; margin-bottom: 0.5rem; }
        .step-card p {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.5;
            margin: 0;
        }

        /* Setup */
        .setup-section {
            background: var(--bg-card);
            border: 1px solid var(--border);
        }
        .setup-section pre {
            background: #000;
            border: 1px solid var(--border);
            padding: 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            color: #e5e7eb;
            overflow-x: auto;
            margin: 0;
        }
        .setup-section code { font-family: 'JetBrains Mono', monospace; }
        .requirement-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(239, 68, 68, 0.05);
            border: 1px solid var(--border);
            margin-bottom: 0.5rem;
        }
        .requirement-item i { color: var(--primary); width: 16px; }

        /* FAQs */
        .faq-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            margin-bottom: 0.75rem;
        }
        .faq-question {
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            user-select: none;
            transition: background 0.2s ease;
        }
        .faq-question:hover { background: rgba(255,255,255,0.02); }
        .faq-question i { color: var(--text-muted); transition: transform 0.2s ease; font-size: 0.85rem; }
        .faq-question.open i { transform: rotate(180deg); }
        .faq-answer {
            padding: 0 1.5rem 1.25rem;
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.7;
            display: none;
        }
        .faq-answer.open { display: block; }
        .faq-answer code {
            background: rgba(255,255,255,0.05);
            padding: 0.15rem 0.4rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
        }
        .faq-answer a { color: var(--primary); }

        /* Responsive */
        @media (max-width: 768px) {
            .hero { padding: 5rem 1rem 3rem; }
            section { padding: 3rem 1rem; }
            .features-grid { grid-template-columns: 1fr; }
            .steps { grid-template-columns: 1fr; }
            .hero-actions { flex-direction: column; align-items: center; }
            .navbar-landing .nav-links { gap: 0.5rem; }
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar-landing">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/" class="brand">
            <i class="fas fa-cubes"></i>
            <span>Chege JIRA</span>
            <span class="badge bg-dark text-muted" style="font-size: 0.6rem; font-family: 'JetBrains Mono', monospace;">v1</span>
        </a>
        <div class="nav-links d-flex align-items-center gap-1">
            <a href="/features" class="nav-link-custom">Features</a>
            <a href="/setup" class="nav-link-custom">Setup</a>
            <a href="/faqs" class="nav-link-custom">FAQs</a>
            <a href="<?= site_url('auth/login') ?>" class="btn-landing-secondary" style="padding: 0.4rem 1rem; font-size: 0.75rem;">Sign In</a>
            <a href="<?= site_url('auth/register') ?>" class="btn-landing-primary" style="padding: 0.4rem 1rem; font-size: 0.75rem;">Get Started</a>
        </div>
    </div>
</nav>

<main style="flex: 1;">
