<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Account Locked • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="mb-3">
                <div style="width: 72px; height: 72px; background: rgba(239,68,68,0.15); display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-lock fa-2x" style="color: #ef4444;"></i>
                </div>
            </div>
            <h3>Account Locked</h3>
            <div class="sub">Too many failed login attempts</div>
        </div>

        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Security Alert:</strong> Your account has been temporarily locked for security reasons.
        </div>

        <div class="mb-4">
            <h6 class="mb-3">What happened?</h6>
            <ul class="small text-muted">
                <li>Multiple failed login attempts were detected</li>
                <li>This is a security measure to protect your account</li>
                <li>The lock will be automatically lifted in: <strong id="lockTimer">15:00</strong></li>
            </ul>
        </div>

        <div class="mb-4">
            <h6 class="mb-3">What can you do?</h6>
            <button class="btn-auth mb-2" id="unlockNowBtn">
                <i class="fas fa-unlock me-2"></i> Unlock via Email
            </button>
            <a href="<?= site_url('auth/forgot-password') ?>" class="btn-auth btn-auth-outline">
                <i class="fas fa-key me-2"></i> Reset Password
            </a>
        </div>

        <div class="alert alert-info">
            <i class="fas fa-shield-alt me-2"></i>
            <small>
                For security reasons, account unlocks via email may take a few minutes to process.
            </small>
        </div>

        <div class="auth-switch">
            Think this is a mistake? <a href="#">Contact Support</a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        $(document).ready(function() {
            // Countdown timer for lock
            let minutes = 15;
            let seconds = 0;

            function updateTimer() {
                const timerElement = $('#lockTimer');
                timerElement.text(`${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);

                if (seconds === 0) {
                    if (minutes === 0) {
                        // Timer ended
                        clearInterval(timerInterval);
                        window.location.href = '<?= site_url("auth/login") ?>';
                        return;
                    }
                    minutes--;
                    seconds = 59;
                } else {
                    seconds--;
                }
            }

            // Start timer
            const timerInterval = setInterval(updateTimer, 1000);
            updateTimer(); // Initial call

            // Unlock via email
            $('#unlockNowBtn').click(function() {
                $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Sending unlock email...');

                // Simulate API call
                setTimeout(() => {
                    showToast('Unlock email sent! Check your inbox.', 'success');
                    setTimeout(() => {
                        $('#unlockNowBtn').prop('disabled', false).html('<i class="fas fa-unlock me-2"></i> Unlock via Email');
                    }, 3000);
                }, 1500);
            });
        });
    </script>
<?= $this->endSection() ?>