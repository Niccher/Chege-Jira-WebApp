<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Activate Account • ChegeOS<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="auth-brand">
        <div class="logo">
            <i class="fas fa-cubes"></i>
        </div>
        <h1>ChegeOS</h1>
        <p>Activate your account</p>
    </div>

    <div class="auth-card">
        <?php if($status === 'success'): ?>
            <div class="auth-header text-center">
                <div class="success-icon mb-3">
                    <div style="width: 80px; height: 80px; background-color: #10b981; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check fa-2x text-white"></i>
                    </div>
                </div>
                <h2 class="text-success">Account Activated!</h2>
                <p>Your account has been successfully activated.</p>
            </div>

            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Welcome to ChegeOS!</strong> Your account is now ready to use.
            </div>

            <div class="mb-4">
                <h6 class="mb-3">What's next?</h6>
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background-color: #6366f1; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Complete your profile</div>
                                <div class="small text-muted">Add your bio, avatar, and preferences</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background-color: #10b981; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Create your first project</div>
                                <div class="small text-muted">Start tracking your side projects</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <div class="me-3" style="width: 32px; height: 32px; background-color: #f59e0b; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-play text-white"></i>
                            </div>
                            <div>
                                <div class="small fw-bold">Take a quick tour</div>
                                <div class="small text-muted">Learn how to use ChegeOS features</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="<?= site_url('dashboard') ?>" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-rocket me-2"></i> Go to Dashboard
            </a>

        <?php elseif($status === 'already_activated'): ?>
            <div class="auth-header text-center">
                <div class="success-icon mb-3">
                    <div style="width: 80px; height: 80px; background-color: #f59e0b; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-info-circle fa-2x text-white"></i>
                    </div>
                </div>
                <h2>Already Activated</h2>
                <p>Your account has already been activated.</p>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Your account is already active. You can sign in with your credentials.
            </div>

            <a href="<?= site_url('auth/login') ?>" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </a>

        <?php elseif($status === 'invalid_token'): ?>
            <div class="auth-header text-center">
                <div class="error-icon mb-3">
                    <div style="width: 80px; height: 80px; background-color: #ef4444; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-exclamation-triangle fa-2x text-white"></i>
                    </div>
                </div>
                <h2 class="text-danger">Invalid Token</h2>
                <p>The activation link is invalid or has expired.</p>
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
                    <button type="submit" class="btn btn-outline-primary w-100">
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
            <div class="auth-header text-center">
                <div class="error-icon mb-3">
                    <div style="width: 80px; height: 80px; background-color: #ef4444; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                </div>
                <h2 class="text-danger">Expired Token</h2>
                <p>The activation link has expired.</p>
            </div>

            <div class="alert alert-warning">
                <i class="fas fa-clock me-2"></i>
                Activation links are valid for 24 hours only. Please request a new one.
            </div>

            <div class="mb-3">
                <form action="<?= site_url('auth/resend-activation') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="email" value="<?= $email ?? '' ?>">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-paper-plane me-2"></i> Resend Activation Email
                    </button>
                </form>
                <a href="<?= site_url('auth/register') ?>" class="btn btn-outline-secondary w-100">
                    <i class="fas fa-user-plus me-2"></i> Create New Account
                </a>
            </div>

        <?php else: ?>
            <div class="auth-header text-center">
                <div class="error-icon mb-3">
                    <div style="width: 80px; height: 80px; background-color: #64748b; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fas fa-question-circle fa-2x text-white"></i>
                    </div>
                </div>
                <h2>Activation Error</h2>
                <p>Something went wrong with the activation process.</p>
            </div>

            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                An unexpected error occurred. Please try again later.
            </div>

            <a href="<?= site_url('auth/register') ?>" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i> Register Again
            </a>

        <?php endif; ?>

        <div class="auth-footer">
            Need help? <a href="#" class="text-primary">Contact Support</a>
        </div>
    </div>
<?= $this->endSection() ?>