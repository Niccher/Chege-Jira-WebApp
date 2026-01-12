<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Verify Email • ChegeOS<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-brand">
        <div class="logo">
            <i class="fas fa-cubes"></i>
        </div>
        <h1>ChegeOS</h1>
        <p>Verify your email address</p>
    </div>

    <div class="auth-card">
        <div class="auth-header text-center">
            <div class="verification-icon mb-3">
                <div style="width: 80px; height: 80px; background-color: #6366f1; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-envelope fa-2x text-white"></i>
                </div>
            </div>
            <h2>Check Your Email</h2>
            <p>We've sent a verification link to:</p>
            <p class="fw-bold" style="color: var(--primary-color);"><?= $email ?? 'your email address' ?></p>
        </div>

        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Important:</strong> Click the verification link in the email to activate your account.
        </div>

        <div class="mb-4">
            <h6 class="mb-3">Didn't receive the email?</h6>
            <div class="mb-3">
                <form action="<?= site_url('auth/resend-verification') ?>" method="POST" id="resendForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="email" value="<?= $email ?? '' ?>">
                    <button type="submit" class="btn btn-outline-primary w-100" id="resendBtn">
                        <i class="fas fa-paper-plane me-2"></i> Resend Verification Email
                    </button>
                </form>
            </div>

            <div class="small text-muted">
                <i class="fas fa-lightbulb me-1"></i>
                Check your spam folder if you don't see the email within a few minutes.
            </div>
        </div>

        <div class="mb-4">
            <h6 class="mb-3">Need to update your email?</h6>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-outline-secondary w-100">
                <i class="fas fa-edit me-2"></i> Register with Different Email
            </a>
        </div>

        <div class="auth-footer">
            Already verified? <a href="<?= site_url('auth/login') ?>">Sign in to your account</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            let canResend = true;
            let countdown = 60;

            // Resend email with cooldown
            $('#resendForm').submit(function(e) {
                if (!canResend) {
                    e.preventDefault();
                    return;
                }

                canResend = false;
                $('#resendBtn').prop('disabled', true);

                // Start countdown
                const timer = setInterval(() => {
                    countdown--;
                    $('#resendBtn').html(`<i class="fas fa-clock me-2"></i> Resend in ${countdown}s`);

                    if (countdown <= 0) {
                        clearInterval(timer);
                        canResend = true;
                        countdown = 60;
                        $('#resendBtn').prop('disabled', false);
                        $('#resendBtn').html('<i class="fas fa-paper-plane me-2"></i> Resend Verification Email');
                    }
                }, 1000);

                // Show success message
                setTimeout(() => {
                    showToast('Verification email resent successfully!', 'success');
                }, 1000);
            });
        });
    </script>
<?= $this->endSection() ?>