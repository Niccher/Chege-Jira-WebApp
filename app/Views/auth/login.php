<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Login • ChegeOS<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-brand">
        <div class="logo">
            <i class="fas fa-cubes"></i>
        </div>
        <h1>ChegeOS</h1>
        <p>Personal Side-Project Dashboard</p>
    </div>

    <div class="auth-card">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Sign in to continue to your dashboard</p>
        </div>

        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> <?= session('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i> <?= session('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login') ?>" method="POST" id="loginForm">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required autofocus>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <label for="password" class="form-label">Password</label>
                    <a href="<?= site_url('auth/forgot-password') ?>" class="small" style="color: var(--primary-color);">Forgot password?</a>
                </div>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me for 30 days</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </button>

            <div class="divider">
                <span>Or continue with</span>
            </div>

            <div class="social-login">
                <button type="button" class="btn btn-outline-secondary">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="fab fa-github"></i> GitHub
                </button>
            </div>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="<?= site_url('auth/register') ?>">Create account</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            // Demo login for testing
            $('#demoLogin').click(function(e) {
                e.preventDefault();
                $('#email').val('demo@chegeos.com');
                $('#password').val('demopassword');
                $('#loginForm').submit();
            });
        });
    </script>
<?= $this->endSection() ?>