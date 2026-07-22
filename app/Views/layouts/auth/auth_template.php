<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Chege JIRA • Authentication') ?></title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('favicon.png') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #ef4444;
            --primary-glow: rgba(239,68,68,0.12);
            --bg: #0a0a0a;
            --bg-card: #111;
            --bg-elevated: #181818;
            --text: #f3f4f6;
            --text-muted: #6b7280;
            --border: #1f1f1f;
            --success: #059669;
            --warning: #d97706;
            --danger: #dc2626;
            --radius: 10px;
        }
        * { font-family: 'Space Grotesk', sans-serif; box-sizing: border-box; }
        body {
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        ::selection { background: var(--primary); color: #fff; }

        /* Grid overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(var(--border) 1px, transparent 1px),
                linear-gradient(90deg, var(--border) 1px, transparent 1px);
            background-size: 48px 48px;
            background-position: center center;
            pointer-events: none;
            z-index: 0;
        }

        /* Nav */
        .auth-nav {
            padding: 0 0;
            border-bottom: 1px solid var(--border);
            background: rgba(10,10,10,0.88);
            backdrop-filter: blur(14px);
            position: sticky;
            top: 0;
            z-index: 100;
            height: 60px;
        }
        .auth-nav .inner {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .auth-nav .brand {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--text);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .auth-nav .brand i { color: var(--primary); font-size: 1.2rem; }
        .auth-nav .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        .auth-nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.4rem 0.85rem;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }
        .auth-nav-link:hover {
            color: var(--text);
            border-color: var(--border);
        }
        .theme-btn {
            background: none;
            border: 1px solid var(--border);
            color: var(--text-muted);
            width: 34px; height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 0.5rem;
            font-size: 0.8rem;
        }
        .theme-btn:hover { color: var(--text); border-color: var(--text-muted); }

        /* Main */
        .auth-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            position: relative;
            z-index: 1;
        }

        /* Split container */
        .auth-split {
            display: flex;
            width: 100%;
            max-width: 1040px;
            min-height: 580px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            position: relative;
        }
        .auth-split::before {
            content: '';
            position: absolute;
            inset: -1px;
            background: linear-gradient(135deg, rgba(239,68,68,0.15), transparent 40%, transparent 60%, rgba(239,68,68,0.05));
            pointer-events: none;
            z-index: -1;
        }

        /* Brand panel (left) */
        .auth-brand-panel {
            flex: 0 0 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(ellipse at 30% 40%, rgba(239,68,68,0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 70% 80%, rgba(239,68,68,0.04) 0%, transparent 40%);
        }
        .auth-brand-panel::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 280px; height: 280px;
            border: 1px solid rgba(239,68,68,0.06);
            transform: rotate(45deg);
        }
        .auth-brand-panel .brand-icon {
            width: 60px; height: 60px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }
        .auth-brand-panel .brand-icon i {
            font-size: 1.8rem;
            color: #fff;
        }
        .auth-brand-panel h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.5px;
        }
        .auth-brand-panel .tagline {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
            font-family: 'JetBrains Mono', monospace;
        }
        .auth-brand-panel .features {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        .auth-brand-panel .features .feat {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }
        .auth-brand-panel .features .feat i {
            color: var(--primary);
            font-size: 0.7rem;
            opacity: 0.7;
        }
        .auth-brand-panel .dots {
            position: absolute;
            bottom: 2rem; left: 2rem;
            display: grid;
            grid-template-columns: repeat(4, 6px);
            gap: 8px;
            opacity: 0.15;
        }
        .auth-brand-panel .dots span {
            width: 6px; height: 6px;
            background: var(--text-muted);
        }
        .auth-brand-panel .glow {
            position: absolute;
            bottom: -120px; left: -80px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(239,68,68,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Form panel (right) */
        .auth-form-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 3rem;
            background: var(--bg-elevated);
            border-left: 1px solid var(--border);
        }
        .auth-form-inner {
            width: 100%;
            max-width: 480px;
        }

        /* Auth card inside form panel */
        .auth-card {
            width: 100%;
        }
        .auth-card .auth-header {
            margin-bottom: 2rem;
        }
        .auth-card .auth-header h3 {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff;
            margin: 0 0 0.35rem 0;
        }
        .auth-card .auth-header .sub {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-family: 'JetBrains Mono', monospace;
        }

        /* Form elements */
        .form-label {
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.4rem;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }
        .form-control {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            color: #fff;
            padding: 0.8rem 1rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            border-radius: var(--radius);
        }
        .form-control:focus {
            background: rgba(255,255,255,0.06);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 0 0 3px var(--primary-glow);
        }
        .form-control::placeholder { color: #3a3a3a; }
        .form-text {
            color: var(--text-muted);
            font-size: 0.72rem;
            margin-top: 0.35rem;
        }

        .input-group-wrap {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            z-index: 5;
            padding: 0.25rem;
            font-size: 0.9rem;
        }
        .password-toggle:hover { color: #fff; }

        .btn-auth {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.85rem;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: var(--radius);
        }
        .btn-auth:hover {
            background: #f87171;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(239,68,68,0.3);
        }
        .btn-auth:active {
            transform: translateY(0);
        }
        .btn-auth-outline {
            background: transparent;
            color: var(--text);
            border: 1px solid var(--border);
        }
        .btn-auth-outline:hover {
            background: rgba(255,255,255,0.03);
            border-color: var(--text-muted);
            color: var(--text);
            box-shadow: none;
            transform: none;
        }
        .btn-auth:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        .auth-switch {
            text-align: center;
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .auth-switch a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            text-transform: uppercase;
            transition: opacity 0.2s;
        }
        .auth-switch a:hover { opacity: 0.8; }

        .forgot-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.78rem;
            font-family: 'JetBrains Mono', monospace;
            transition: color 0.2s ease;
        }
        .forgot-link:hover { color: var(--primary); }

        .form-check-input {
            background: transparent;
            border: 1px solid var(--border);
            cursor: pointer;
            border-radius: 3px;
        }
        .form-check-input:checked {
            background: var(--primary);
            border-color: var(--primary);
        }
        .form-check-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            cursor: pointer;
        }

        /* Alerts */
        .alert {
            border: 1px solid;
            padding: 0.85rem 1rem;
            margin-bottom: 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            border-radius: var(--radius);
        }
        .alert-danger {
            background: rgba(239,68,68,0.08);
            border-color: rgba(239,68,68,0.2);
            color: #fca5a5;
        }
        .alert-success {
            background: rgba(5,150,105,0.08);
            border-color: rgba(5,150,105,0.2);
            color: #6ee7b7;
        }
        .alert-warning {
            background: rgba(217,119,6,0.08);
            border-color: rgba(217,119,6,0.2);
            color: #fcd34d;
        }
        .alert-info {
            background: rgba(255,255,255,0.03);
            border-color: var(--border);
            color: var(--text-muted);
        }
        .alert ul { list-style: none; padding: 0; margin: 0; }

        /* Footer */
        .auth-footer-bar {
            border-top: 1px solid var(--border);
            padding: 1.25rem 0;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.78rem;
            background: rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }
        .auth-footer-bar .inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .auth-footer-bar a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s ease;
            font-size: 0.78rem;
        }
        .auth-footer-bar a:hover { color: var(--primary); }
        .auth-footer-bar .sep { color: var(--border); }
        .auth-footer-bar .copy { opacity: 0.5; }

        /* Responsive */
        @media (max-width: 860px) {
            .auth-brand-panel { display: none; }
            .auth-form-panel {
                border-left: none;
                padding: 2rem 1.5rem;
            }
            .auth-split { min-height: auto; }
        }
        @media (max-width: 576px) {
            .auth-main { padding: 1rem; }
            .auth-form-panel { padding: 1.5rem 1rem; }
            .auth-nav .inner { padding: 0 1rem; }
            .auth-footer-bar .inner { padding: 0 1rem; }
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>

<!-- Navigation -->
<nav class="auth-nav">
    <div class="inner">
        <a href="/" class="brand">
            <i class="fas fa-cubes"></i>
            <span>Chege JIRA</span>
        </a>
        <div class="nav-links">
            <a href="/features" class="auth-nav-link">Features</a>
            <a href="/setup" class="auth-nav-link">Setup</a>
            <a href="/faqs" class="auth-nav-link">FAQs</a>
            <button class="theme-btn" id="themeToggle" title="Toggle theme">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="auth-main">
    <div class="auth-split">
        <div class="auth-brand-panel">
            <div class="brand-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <h1>Chege JIRA</h1>
            <div class="tagline">Project management, reimagined.</div>
            <div class="features">
                <div class="feat">
                    <i class="fas fa-check"></i>
                    <span>Track issues, sprints, and epics</span>
                </div>
                <div class="feat">
                    <i class="fas fa-check"></i>
                    <span>Built for agile teams</span>
                </div>
                <div class="feat">
                    <i class="fas fa-check"></i>
                    <span>Real-time collaboration</span>
                </div>
            </div>
            <div class="glow"></div>
            <div class="dots">
                <span></span><span></span><span></span><span></span>
                <span></span><span></span><span></span><span></span>
            </div>
        </div>
        <div class="auth-form-panel">
            <div class="auth-form-inner">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="auth-footer-bar">
    <div class="inner">
        <a href="/">Home</a>
        <span class="sep">/</span>
        <a href="/features">Features</a>
        <span class="sep">/</span>
        <a href="/setup">Setup</a>
        <span class="sep">/</span>
        <a href="/faqs">FAQs</a>
        <span class="copy">&copy; <?= date('Y') ?> Chege JIRA</span>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Theme toggle
        $('#themeToggle').click(function() {
            const html = $('html');
            const current = html.attr('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            html.attr('data-bs-theme', next);
            const icon = $(this).find('i');
            icon.removeClass('fa-moon fa-sun').addClass(next === 'dark' ? 'fa-moon' : 'fa-sun');
            localStorage.setItem('theme', next);
        });

        const saved = localStorage.getItem('theme');
        if (saved) {
            $('html').attr('data-bs-theme', saved);
            const icon = $('#themeToggle i');
            icon.removeClass('fa-moon fa-sun').addClass(saved === 'dark' ? 'fa-moon' : 'fa-sun');
        }

        // Password toggle
        $('.password-toggle').click(function() {
            const input = $(this).parent().find('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            const icon = $(this).find('i');
            icon.toggleClass('fa-eye fa-eye-slash');
        });

        // Form validation
        $('form').on('submit', function(e) {
            let valid = true;
            $(this).find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    valid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            const pw = $('#password');
            const confirm = $('#confirmPassword');
            if (pw.length && confirm.length && pw.val() !== confirm.val()) {
                valid = false;
                confirm.addClass('is-invalid');
                $('#passwordMismatch').show();
            }
            if (!valid) {
                e.preventDefault();
            }
        });
        $('input').on('input', function() { $(this).removeClass('is-invalid'); });

        // Toast
        window.showToast = function(msg, type) {
            type = type || 'info';
            if (!$('.toast-container').length) {
                $('body').append('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
            }
            const id = 't-' + Date.now();
            $('.toast-container').append(
                `<div id="${id}" class="toast align-items-center text-bg-${type} border-0"><div class="d-flex"><div class="toast-body">${msg}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div></div>`
            );
            const t = new bootstrap.Toast(document.getElementById(id));
            t.show();
            $(`#${id}`).on('hidden.bs.toast', function() { $(this).remove(); });
        };

        const params = new URLSearchParams(window.location.search);
        const msg = params.get('message');
        if (msg) showToast(decodeURIComponent(msg), params.get('type') || 'info');
    });
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>
