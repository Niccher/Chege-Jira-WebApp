<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Forgot Password • ChegeOS<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-brand">
        <div class="logo">
            <i class="fas fa-cubes"></i>
        </div>
        <h1>ChegeOS</h1>
        <p>Reset your password</p>
    </div>

    <div class="auth-card">
        <div class="auth-header">
            <h2>Forgot Password?</h2>
            <p>Enter your email address and we'll send you a link to reset your password.</p>
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

        <form action="<?= site_url('auth/forgot-password') ?>" method="POST" id="forgotPasswordForm">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required autofocus>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-paper-plane me-2"></i> Send Reset Link
            </button>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <small>
                    You will receive an email with instructions on how to reset your password.
                    The link will expire in 1 hour.
                </small>
            </div>
        </form>

        <div class="auth-footer">
            Remember your password? <a href="<?= site_url('auth/login') ?>">Back to login</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            // Auto-focus email field
            $('#email').focus();
        });
    </script>
<?= $this->endSection() ?>