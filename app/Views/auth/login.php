<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Login • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-card">
        <div class="auth-header">
            <h3>Welcome Back</h3>
            <div class="sub">Sign in to continue to your dashboard</div>
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
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="password" class="form-label mb-0">Password</label>
                    <a href="<?= site_url('auth/forgot-password') ?>" class="forgot-link">Forgot?</a>
                </div>
                <div class="input-group-wrap">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn-auth">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <div class="auth-switch">
            Don't have an account? <a href="<?= site_url('auth/register') ?>">Create account</a>
        </div>
    </div>
<?= $this->endSection() ?>
