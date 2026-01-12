<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'ChegeOS • Authentication') ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-brand .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            border-radius: 16px;
            margin-bottom: 1rem;
        }

        .auth-brand .logo i {
            font-size: 1.8rem;
            color: white;
        }

        .auth-brand h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: white;
        }

        .auth-brand p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .auth-card {
            background-color: #1e293b;
            border-radius: var(--border-radius);
            border: 1px solid #334155;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header h2 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #e2e8f0;
        }

        .auth-header p {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #334155;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .form-label {
            font-weight: 500;
            color: #e2e8f0;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #0f172a;
            border: 1px solid #334155;
            color: #e2e8f0;
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .form-control:focus {
            background-color: #0f172a;
            border-color: var(--primary-color);
            color: #e2e8f0;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-outline-secondary {
            border-color: #334155;
            color: #94a3b8;
        }

        .btn-outline-secondary:hover {
            background-color: #334155;
            border-color: #475569;
            color: #e2e8f0;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #64748b;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #334155;
        }

        .divider span {
            padding: 0 1rem;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-login .btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
        }

        .input-group {
            position: relative;
        }

        .alert {
            border-radius: 8px;
            border: 1px solid;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
            color: #a7f3d0;
        }

        .alert-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #fde68a;
        }

        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #fca5a5;
        }

        .alert-info {
            background-color: rgba(99, 102, 241, 0.1);
            border-color: #6366f1;
            color: #c7d2fe;
        }

        /* Dark/Light theme toggle for auth pages */
        .theme-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1000;
        }

        @media (max-width: 576px) {
            body {
                padding: 1rem;
            }

            .auth-card {
                padding: 1.5rem;
            }

            .social-login {
                flex-direction: column;
            }
        }
    </style>

    <?= $this->renderSection('head') ?>
</head>
<body>
<!-- Theme Toggle -->
<div class="theme-toggle">
    <button class="btn btn-sm btn-outline-secondary" id="themeToggle">
        <i class="fas fa-moon"></i>
    </button>
</div>

<div class="auth-container">
    <?= $this->renderSection('content') ?>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Theme toggle
        $('#themeToggle').click(function() {
            const html = $('html');
            const currentTheme = html.attr('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.attr('data-bs-theme', newTheme);

            // Change icon
            const icon = $(this).find('i');
            if (newTheme === 'dark') {
                icon.removeClass('fa-sun').addClass('fa-moon');
            } else {
                icon.removeClass('fa-moon').addClass('fa-sun');
            }

            localStorage.setItem('theme', newTheme);
        });

        // Check saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            $('html').attr('data-bs-theme', savedTheme);
            const icon = $('#themeToggle i');
            if (savedTheme === 'dark') {
                icon.removeClass('fa-sun').addClass('fa-moon');
            } else {
                icon.removeClass('fa-moon').addClass('fa-sun');
            }
        }

        // Password toggle visibility
        $('.password-toggle').click(function() {
            const input = $(this).parent().find('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);

            // Change icon
            const icon = $(this).find('i');
            if (type === 'password') {
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });

        // Form validation
        $('form').on('submit', function(e) {
            let isValid = true;

            $(this).find('[required]').each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Check password match for registration
            if ($('#confirmPassword').length) {
                const password = $('#password').val();
                const confirm = $('#confirmPassword').val();

                if (password !== confirm) {
                    isValid = false;
                    $('#confirmPassword').addClass('is-invalid');
                    $('#passwordMismatch').show();
                } else {
                    $('#confirmPassword').removeClass('is-invalid');
                    $('#passwordMismatch').hide();
                }
            }

            if (!isValid) {
                e.preventDefault();
                showToast('Please fill all required fields correctly', 'danger');
            }
        });

        // Remove invalid class on input
        $('input').on('input', function() {
            $(this).removeClass('is-invalid');
        });

        // Toast notification function
        window.showToast = function(message, type = 'info') {
            // Create toast container if it doesn't exist
            if ($('.toast-container').length === 0) {
                $('body').append('<div class="toast-container position-fixed bottom-0 end-0 p-3"></div>');
            }

            const toastId = 'toast-' + Date.now();
            const toastHtml = `
                    <div id="${toastId}" class="toast align-items-center text-bg-${type} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                `;

            $('.toast-container').append(toastHtml);
            const toast = new bootstrap.Toast(document.getElementById(toastId));
            toast.show();

            $(`#${toastId}`).on('hidden.bs.toast', function() {
                $(this).remove();
            });
        }

        // Check for URL parameters (for error/success messages)
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const type = urlParams.get('type');

        if (message) {
            showToast(decodeURIComponent(message), type || 'info');
        }
    });
</script>

<?= $this->renderSection('scripts') ?>
</body>
</html>