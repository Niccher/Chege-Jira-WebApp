<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Register • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-card">
        <div class="auth-header">
            <h3>Create Account</h3>
            <div class="sub">Get started with your free account</div>
        </div>

        <?php if(session()->has('errors')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul>
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/register') ?>" method="POST" id="registerForm">
            <?= csrf_field() ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="John" required>
                </div>
                <div class="col-md-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                <div class="form-text">We'll never share your email.</div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="johndoe" required>
                <div class="form-text">Used for your profile URL.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group-wrap">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a strong password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">At least 8 characters with letters and numbers.</div>
                <div id="passwordStrength" class="mt-1"></div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class="input-group-wrap">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback" id="passwordMismatch" style="display: none;">
                    Passwords do not match
                </div>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#" style="color: var(--primary);">Terms of Service</a> and <a href="#" style="color: var(--primary);">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn-auth">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <div class="auth-switch">
            Already have an account? <a href="<?= site_url('auth/login') ?>">Sign in</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            $('#password').on('input', function() {
                const password = $(this).val();
                let strength = 0;

                if (password.length >= 8) strength++;
                if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
                if (/\d/.test(password)) strength++;
                if (/[^a-zA-Z0-9]/.test(password)) strength++;

                const strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'][strength];
                const strengthColor = ['#ef4444', '#f59e0b', '#f59e0b', '#10b981', '#10b981'][strength];
                const width = strength * 25;

                $('#passwordStrength').html(`
                    <div class="d-flex justify-content-between small">
                        <span style="color: ${strengthColor}">${strengthText}</span>
                        <span style="color: var(--text-muted);">${password.length}/8+</span>
                    </div>
                    <div style="height: 3px; background: var(--border); margin-top: 4px; border-radius: 2px; overflow: hidden;">
                        <div style="width: ${width}%; height: 100%; background: ${strengthColor}; transition: width 0.3s ease;"></div>
                    </div>
                `);
            });
        });
    </script>
<?= $this->endSection() ?>
