<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Register • ChegeOS<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-brand">
        <div class="logo">
            <i class="fas fa-cubes"></i>
        </div>
        <h1>ChegeOS</h1>
        <p>Start tracking your side projects today</p>
    </div>

    <div class="auth-card">
        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Get started with your free account</p>
        </div>

        <?php if(session()->has('errors')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
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
                <div class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="johndoe" required>
                <div class="form-text">This will be used for your profile URL.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a strong password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">Must be at least 8 characters with letters and numbers.</div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback" id="passwordMismatch" style="display: none;">
                    Passwords do not match
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                </label>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" checked>
                <label class="form-check-label" for="newsletter">
                    Send me product updates, tips, and offers via email
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i> Create Account
            </button>

            <div class="divider">
                <span>Or sign up with</span>
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
            Already have an account? <a href="<?= site_url('auth/login') ?>">Sign in</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            // Real-time password strength indicator
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