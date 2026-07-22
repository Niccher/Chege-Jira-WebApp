<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'Chege Jira WebApp') ?></title>
    <meta name="description" content="<?= esc($metaDescription ?? 'Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.') ?>">
    <meta name="keywords" content="<?= esc($metaKeywords ?? 'project management, kanban, time tracking, productivity, self-hosted, docker') ?>">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Chege Jira">

    <!-- Open Graph -->
    <meta property="og:title" content="Chege Jira WebApp — Project & Productivity Tracker">
    <meta property="og:description" content="Self-hosted project management platform with Kanban boards, time tracking, notes, calendar, and analytics.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image" content="<?= base_url('favicon.png') ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Chege Jira WebApp">
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
        }
        ::selection { background: var(--primary); color: #000; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border); }
        ::-webkit-scrollbar-thumb:hover { background: #444; }

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
        .btn-landing-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.85rem 2rem;
            background: var(--primary);
            color: #000;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
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
            padding: 0.85rem 2rem;
            background: transparent;
            color: var(--text);
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85rem;
            text-decoration: none;
            border: 2px solid var(--border);
            transition: all 0.2s ease;
        }
        .btn-landing-secondary:hover {
            border-color: var(--text);
            box-shadow: 4px 4px 0 var(--border);
            transform: translate(-2px, -2px);
        }

        /* Sections */
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

        /* How It Works */
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
        .step-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        .step-card h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .step-card p {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.5;
            margin: 0;
        }

        /* Docker Setup */
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

        /* Footer */
        .landing-footer {
            border-top: 1px solid var(--border);
            padding: 2.5rem 1.5rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .landing-footer a {
            color: var(--text);
            text-decoration: none;
        }
        .landing-footer a:hover { color: var(--primary); }
        .landing-footer .brand { font-weight: 700; font-size: 1rem; }

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
            <span>Chege Jira</span>
            <span class="badge bg-dark text-muted" style="font-size: 0.6rem; font-family: 'JetBrains Mono', monospace;">v1</span>
        </a>
        <div class="nav-links d-flex gap-2">
            <a href="<?= site_url('auth/login') ?>" class="btn-landing-secondary" style="padding: 0.5rem 1.25rem; font-size: 0.8rem;">Sign In</a>
            <a href="<?= site_url('auth/register') ?>" class="btn-landing-primary" style="padding: 0.5rem 1.25rem; font-size: 0.8rem;">Get Started</a>
        </div>
    </div>
</nav>

<!-- Hero -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge"><i class="fas fa-cubes me-1"></i> v1.0 — Open Source</div>
        <h1>Own Your<br><span>Project Workflow</span></h1>
        <p>
            Chege Jira WebApp is a self-hosted project management platform that puts you in control.
            Track projects, log time, organize tasks on a Kanban board, take notes, and analyze your
            productivity — all without leaving your infrastructure.
        </p>
        <div class="hero-actions">
            <a href="<?= site_url('auth/register') ?>" class="btn-landing-primary">
                <i class="fas fa-rocket"></i> Get Started Free
            </a>
            <a href="#features" class="btn-landing-secondary">
                <i class="fas fa-chevron-down"></i> Explore Features
            </a>
        </div>
    </div>
</section>

<!-- Features -->
<section id="features">
    <div class="container">
        <div class="text-center">
            <div class="section-label">Features</div>
            <h2 class="section-title">Everything you need to ship</h2>
            <p class="section-subtitle">A complete project management toolkit designed for developers, teams, and power users who want full control over their data.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-project-diagram"></i></div>
                <h3>Project Management</h3>
                <p>Create, track, and manage projects with statuses, priorities, tech stacks, milestones, progress bars, and budget tracking.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-th"></i></div>
                <h3>Kanban Board</h3>
                <p>Drag-and-drop task management with customizable columns. Switch between projects, edit tasks inline, and move cards across stages.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-clock"></i></div>
                <h3>Time Tracking</h3>
                <p>Start/stop timers or log hours manually. View daily, weekly, and monthly breakdowns with per-project distribution charts.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Calendar View</h3>
                <p>Visualize due dates, milestones, time logs, and events on an interactive FullCalendar. Create custom events with color labels.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-sticky-note"></i></div>
                <h3>Notes & Documentation</h3>
                <p>Write per-project notes with markdown-style content, tags, starring, and completion tracking. Soft-delete for safety.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Analytics & Insights</h3>
                <p>Real-time analytics dashboard with monthly trends, project health distribution, time breakdowns, activity heatmaps, and smart productivity insights.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-palette"></i></div>
                <h3>Full Customization</h3>
                <p>Dark/light theme toggle, accent color picker, sidebar collapse, density controls, and notification preferences — all persisted to your account.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-database"></i></div>
                <h3>Data Export & Import</h3>
                <p>Export your projects, time logs, and notes to CSV or JSON. Re-import data through the settings panel. You own your data.</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section style="background: var(--bg-card);">
    <div class="container">
        <div class="text-center">
            <div class="section-label">How It Works</div>
            <h2 class="section-title">Get started in minutes</h2>
            <p class="section-subtitle">From zero to productive — no cloud registration, no vendor lock-in.</p>
        </div>
        <div class="steps">
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-download"></i></div>
                <h3>Deploy with Docker</h3>
                <p>Clone the repo, run <code style="background: rgba(255,255,255,0.05); padding: 0.15rem 0.4rem; font-family: 'JetBrains Mono', monospace;">docker compose up -d</code>, and the app boots with MySQL + phpMyAdmin.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-user-plus"></i></div>
                <h3>Create Your Account</h3>
                <p>Sign up with your name, email, and password. No third-party auth, no data leaving your server.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-folder-open"></i></div>
                <h3>Create Projects</h3>
                <p>Set up your first project with a name, description, tech stack, milestones, and priority level.</p>
            </div>
            <div class="step-card">
                <div class="step-icon"><i class="fas fa-tasks"></i></div>
                <h3>Build Your Workflow</h3>
                <p>Add tasks to your Kanban board, log time, write notes, and watch your productivity take shape.</p>
            </div>
        </div>
    </div>
</section>

<!-- Docker Setup -->
<section id="setup">
    <div class="container">
        <div class="text-center">
            <div class="section-label">Deployment</div>
            <h2 class="section-title">Docker Setup</h2>
            <p class="section-subtitle">One command to launch the entire stack — application, database, and database manager.</p>
        </div>

        <div class="setup-section p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-list-check me-2 text-primary"></i>Prerequisites</h5>
            <div class="row g-2 mb-4">
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fab fa-docker"></i> Docker & Docker Compose</div>
                </div>
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fab fa-git-alt"></i> Git</div>
                </div>
                <div class="col-md-4">
                    <div class="requirement-item"><i class="fas fa-globe"></i> Port 9001 (app) + 9000 (phpMyAdmin) free</div>
                </div>
            </div>

            <h5 class="fw-bold mb-3"><i class="fas fa-terminal me-2 text-primary"></i>Quick Start</h5>
            <pre>git clone https://github.com/yourusername/chege-jira-webapp.git
cd "Chege Jira WebApp"
cp .env.example .env
docker compose up --build -d</pre>

            <div class="row mt-4 g-3">
                <div class="col-md-6">
                    <h6 class="fw-bold mb-2"><i class="fas fa-cube me-1 text-muted"></i>Services</h6>
                    <table class="table table-sm table-borderless text-muted" style="font-size: 0.85rem;">
                        <tr><td><span class="badge bg-dark me-2">app</span></td><td>PHP 8.3 + Apache on <code>:9001</code></td></tr>
                        <tr><td><span class="badge bg-dark me-2">mysql</span></td><td>MySQL 8.4 on <code>:9306</code>, volume-mounted for persistence</td></tr>
                        <tr><td><span class="badge bg-dark me-2">phpmyadmin</span></td><td>phpMyAdmin on <code>:9000</code></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold mb-2"><i class="fas fa-database me-1 text-muted"></i>Default Database Credentials</h6>
                    <table class="table table-sm table-borderless text-muted" style="font-size: 0.85rem;">
                        <tr><td>Host</td><td><code>mysql</code></td></tr>
                        <tr><td>Database</td><td><code>db_chege_jira</code></td></tr>
                        <tr><td>Username</td><td><code>root</code></td></tr>
                        <tr><td>Password</td><td><code>root_password</code></td></tr>
                    </table>
                </div>
            </div>

            <h5 class="fw-bold mt-4 mb-3"><i class="fas fa-book me-2 text-primary"></i>Useful Commands</h5>
            <pre>docker compose logs -f chege-jira   # View live application logs
docker compose restart chege-jira     # Restart the app container
docker compose down                   # Stop all containers</pre>
        </div>
    </div>
</section>

<!-- FAQs -->
<section id="faqs" style="background: var(--bg-card);">
    <div class="container">
        <div class="text-center">
            <div class="section-label">FAQs</div>
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Common questions about deploying, using, and contributing to Chege Jira WebApp.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>What is Chege Jira WebApp?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Chege Jira WebApp is a self-hosted, open-source project management platform built on CodeIgniter 4.
                        It includes project tracking, Kanban boards, time logging, notes, calendar events, and analytics — all running on your own infrastructure.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Do I need an internet connection to use it?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Only for the initial setup (cloning the repo, pulling Docker images, loading CDN assets).
                        Once deployed, the app runs entirely on your local network or server with no external dependencies.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I persist my data across container restarts?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        The <code>docker-compose.yml</code> uses named volumes for MySQL data and bind-mounts for uploaded
                        files. Your database records, uploaded avatars, and session data survive container rebuilds and restarts automatically.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Can I run it without Docker?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes. You need PHP 8.3+, Composer, and a MySQL 8 server. Run <code>composer install</code>,
                        configure your <code>.env</code> file, execute <code>php spark migrate --all</code>,
                        and serve with <code>php spark serve</code>.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I reset my password?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Visit the <a href="<?= site_url('auth/login') ?>">login page</a> and click "Forgot Password."
                        Enter your email address, and a reset link will be sent to your inbox.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Is there multi-user or team support?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Currently the app supports individual accounts with full authentication (register, login, email verification, password reset).
                        Projects and data are scoped per user. Multi-user project collaboration is on the roadmap.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>How do I contribute or report a bug?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Contributions are welcome! Fork the repository, create a feature branch, and open a pull request.
                        For bugs or feature requests, please open an issue on the GitHub repository.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>What license is this project under?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Chege Jira WebApp is distributed under the <strong>MIT License</strong>. You are free to use, modify, and distribute it for personal or commercial use.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="landing-footer">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <div class="brand"><i class="fas fa-cubes me-1" style="color: var(--primary);"></i> Chege Jira WebApp <span class="text-muted" style="font-weight: 400;">v1</span></div>
            <div class="d-flex gap-3">
                <a href="<?= site_url('auth/login') ?>">Sign In</a>
                <a href="<?= site_url('auth/register') ?>">Register</a>
                <a href="#faqs">FAQs</a>
                <a href="#setup">Setup</a>
            </div>
            <div class="text-muted">&copy; <?= date('Y') ?> Chege Jira. MIT License.</div>
        </div>
    </div>
</footer>

<!-- Bootstrap + jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    function toggleFaq(el) {
        el.classList.toggle('open');
        const answer = el.nextElementSibling;
        answer.classList.toggle('open');
    }

    $(document).ready(function() {
        const html = $('html');
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) html.attr('data-bs-theme', savedTheme);
    });
</script>

</body>
</html>
