<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Activate Account • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-card">
        <?php if($status === 'success'): ?>
            <div class="text-center mb-4">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; background: rgba(16,185,129,0.15); display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check fa-2x" style="color: #10b981;"></i>
                    </div>
                </div>
                <h3>Account Activated!</h3>
                <div class="sub">Your account has been successfully activated.</div>
            </div>

            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Welcome to Chege JIRA!</strong> Your account is now ready to use.
            </div>

            <div class="mb-4">
                <h6 class="mb-3">What's next?</h6>
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background: rgba(99,102,241,0.15); border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user" style="color: #6366f1;"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Complete your profile</div>
                                <div class="small text-muted">Add your bio, avatar, and preferences</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background: rgba(16,185,129,0.15); border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-plus" style="color: #10b981;"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Create your first project</div>
                                <div class="small text-muted">Start tracking your side projects</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background: rgba(245,158,11,0.15); border-radius: var(--radius); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-play" style="color: #f59e0b;"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Take a quick tour</div>
                                <div class="small text-muted">Learn how to use Chege JIRA features</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="<?= site_url('dashboard') ?>" class="btn-auth">
                <i class="fas fa-rocket me-2"></i> Go to Dashboard
            </a>

        <?php elseif($status === 'already_activated'): ?>
            <div class="text-center mb-4">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; background: rgba(245,158,11,0.15); display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-info-circle fa-2x" style="color: #f59e0b;"></i>
                    </div>
                </div>
                <h3>Already Activated</h3>
                <div class="sub">Your account has already been activated.</div>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Your account is already active. You can sign in with your credentials.
            </div>

            <a href="<?= site_url('auth/login') ?>" class="btn-auth">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </a>

        <?php elseif($status === 'invalid_token'): ?>
            <div class="text-center mb-4">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; background: rgba(239,68,68,0.15); display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exclamation-triangle fa-2x" style="color: #ef4444;"></i>
                    </div>
                </div>
                <h3>Invalid Token</h3>
                <div class="sub">The activation link is invalid or has expired.</div>
            </div>

            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Activation failed.</strong> The link may have expired or was already used.
            </div>

            <div class="mb-3">
                <p class="text-center mb-3">You can request a new activation link:</p>
                <form action="<?= site_url('auth/resend-activation') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="email" value="<?= $email ?? '' ?>">
                    <button type="submit" class="btn-auth btn-auth-outline">
                        <i class="fas fa-paper-plane me-2"></i> Resend Activation Email
                    </button>
                </form>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-question-circle me-2"></i>
                <small>
                    If you continue to have issues, please contact our support team.
                </small>
            </div>

        <?php elseif($status === 'expired_token'): ?>
            <div class="text-center mb-4">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; background: rgba(239,68,68,0.15); display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock fa-2x" style="color: #ef4444;"></i>
                    </div>
                </div>
                <h3>Expired Token</h3>
                <div class="sub">The activation link has expired.</div>
            </div>

            <div class="alert alert-warning">
                <i class="fas fa-clock me-2"></i>
                Activation links are valid for 24 hours only. Please request a new one.
            </div>

            <div class="mb-3">
                <form action="<?= site_url('auth/resend-activation') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="email" value="<?= $email ?? '' ?>">
                    <button type="submit" class="btn-auth mb-2">
                        <i class="fas fa-paper-plane me-2"></i> Resend Activation Email
                    </button>
                </form>
                <a href="<?= site_url('auth/register') ?>" class="btn-auth btn-auth-outline">
                    <i class="fas fa-user-plus me-2"></i> Create New Account
                </a>
            </div>

        <?php else: ?>
            <div class="text-center mb-4">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; background: rgba(100,116,139,0.15); display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-question-circle fa-2x" style="color: #64748b;"></i>
                    </div>
                </div>
                <h3>Activation Error</h3>
                <div class="sub">Something went wrong with the activation process.</div>
            </div>

            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                An unexpected error occurred. Please try again later.
            </div>

            <a href="<?= site_url('auth/register') ?>" class="btn-auth">
                <i class="fas fa-user-plus me-2"></i> Register Again
            </a>

        <?php endif; ?>

        <div class="auth-switch">
            Need help? <a href="#">Contact Support</a>
        </div>
    </div>
<?= $this->endSection() ?>