<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Reset Password • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-card">
        <div class="text-center mb-4">
            <h3>Reset Password</h3>
            <div class="sub">Create a new password for your account</div>
        </div>

        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> <?= session('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->has('token_error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Invalid or expired token.</strong>
                <p class="mb-0">Please request a new password reset link.</p>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/reset-password') ?>" method="POST" id="resetPasswordForm">
            <?= csrf_field() ?>
            <input type="hidden" name="token" value="<?= $token ?? '' ?>">

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? '' ?>" required readonly>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group-wrap">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required autofocus>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">Must be at least 8 characters with letters and numbers.</div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                <div class="input-group-wrap">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm new password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback" id="passwordMismatch" style="display: none;">
                    Passwords do not match
                </div>
            </div>

            <button type="submit" class="btn-auth mb-3">
                <i class="fas fa-key"></i> Reset Password
            </button>

            <div class="alert alert-warning">
                <i class="fas fa-shield-alt me-2"></i>
                <small>For security, make sure your new password is different from previous ones.</small>
            </div>
        </form>

        <div class="auth-switch">
            Remember your password? <a href="<?= site_url('auth/login') ?>">Back to login</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            // Auto-focus password field
            $('#password').focus();

            // Password strength indicator
            $('#password').on('input', function() {
                const password = $(this).val();
                let strength = 0;

                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                if (/\d/.test(password)) strength++;
                if (/[^a-zA-Z0-9]/.test(password)) strength++;

                const strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'][strength];
                const strengthColor = ['#ef4444', '#f59e0b', '#f59e0b', '#10b981', '#10b981'][strength];

                // Update strength indicator
                $('#passwordStrength').remove();
                $(this).parent().after(`
            <div id="passwordStrength" class="mt-1">
                <div class="d-flex justify-content-between small">
                    <span>Password strength: <strong style="color: ${strengthColor}">${strengthText}</strong></span>
                    <span>${password.length}/8+</span>
                </div>
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar" style="width: ${strength * 25}%; background-color: ${strengthColor};"></div>
                </div>
            </div>
        `);
            });
        });
    </script>
<?= $this->endSection() ?>