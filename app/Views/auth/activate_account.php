<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Account Activation • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php if($status === 'success'): ?>
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-lg bg-success-lighten text-success rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm">
                    <i class="mdi mdi-check-decagram-outline font-36"></i>
                </div>
            </div>
            <h3 class="fw-bold text-body mb-1">Account Activated!</h3>
            <p class="text-muted font-14">Your workspace account has been verified and activated successfully.</p>
        </div>

        <div class="card border border-success-subtle bg-success-subtle bg-opacity-10 mb-4">
            <div class="card-body p-3">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-shield-check font-24 text-success me-2"></i>
                    <div>
                        <div class="fw-semibold text-success font-14">Welcome to <?= esc(setting('App.siteName')) ?>!</div>
                        <div class="text-muted font-12">Your workspace is ready. You can now access your projects and agile boards.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 mb-3">
            <a href="<?= site_url('home') ?>" class="btn btn-primary btn-lg rounded-pill fw-semibold">
                <i class="mdi mdi-view-dashboard-outline me-1"></i> Go to Dashboard
            </a>
            <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-secondary rounded-pill font-13">
                <i class="mdi mdi-login me-1"></i> Sign In Directly
            </a>
        </div>

    <?php elseif($status === 'already_activated'): ?>
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-lg bg-info-lighten text-info rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm">
                    <i class="mdi mdi-information-outline font-36"></i>
                </div>
            </div>
            <h3 class="fw-bold text-body mb-1">Already Activated</h3>
            <p class="text-muted font-14">This account is already active and ready to use.</p>
        </div>

        <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
            <i class="mdi mdi-information-outline font-20 me-2 text-info"></i>
            <div class="font-13">
                Your account is in good standing. You can sign in immediately with your credentials.
            </div>
        </div>

        <div class="d-grid mb-3">
            <a href="<?= site_url('auth/login') ?>" class="btn btn-primary btn-lg rounded-pill fw-semibold">
                <i class="mdi mdi-login me-1"></i> Sign In to Workspace
            </a>
        </div>

    <?php elseif($status === 'invalid_token'): ?>
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-lg bg-danger-lighten text-danger rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm">
                    <i class="mdi mdi-alert-circle-outline font-36"></i>
                </div>
            </div>
            <h3 class="fw-bold text-body mb-1">Invalid Activation Link</h3>
            <p class="text-muted font-14">The verification link is invalid or may have already been used.</p>
        </div>

        <div class="alert alert-danger mb-4" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <strong>Activation failed:</strong> Please request a new activation link below or contact support.
        </div>

        <div class="mb-3">
            <form action="<?= site_url('auth/resend-verification') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="email" value="<?= esc($email ?? '') ?>">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100 fw-semibold mb-2">
                    <i class="mdi mdi-email-sync-outline me-1"></i> Resend Activation Link
                </button>
            </form>
            <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-secondary rounded-pill w-100 font-13">
                <i class="mdi mdi-login me-1"></i> Return to Sign In
            </a>
        </div>

    <?php elseif($status === 'expired_token'): ?>
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-lg bg-warning-lighten text-warning rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm">
                    <i class="mdi mdi-timer-sand-empty font-36"></i>
                </div>
            </div>
            <h3 class="fw-bold text-body mb-1">Activation Link Expired</h3>
            <p class="text-muted font-14">For security reasons, activation links expire after 24 hours.</p>
        </div>

        <div class="alert alert-warning mb-4" role="alert">
            <i class="mdi mdi-clock-alert-outline me-2"></i>
            Please request a fresh activation link below to complete your registration.
        </div>

        <div class="mb-3">
            <form action="<?= site_url('auth/resend-verification') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="email" value="<?= esc($email ?? '') ?>">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill w-100 fw-semibold mb-2">
                    <i class="mdi mdi-email-sync-outline me-1"></i> Resend Activation Link
                </button>
            </form>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-outline-secondary rounded-pill w-100 font-13">
                <i class="mdi mdi-account-plus-outline me-1"></i> Register New Account
            </a>
        </div>

    <?php else: ?>
        <div class="text-center mb-4">
            <div class="mb-3">
                <div class="avatar-lg bg-danger-lighten text-danger rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm">
                    <i class="mdi mdi-alert-circle-outline font-36"></i>
                </div>
            </div>
            <h3 class="fw-bold text-body mb-1">Activation Error</h3>
            <p class="text-muted font-14">An unexpected issue occurred while processing your activation.</p>
        </div>

        <div class="alert alert-danger mb-4" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            Please try signing in or registering again.
        </div>

        <div class="d-grid gap-2 mb-3">
            <a href="<?= site_url('auth/login') ?>" class="btn btn-primary btn-lg rounded-pill fw-semibold">
                <i class="mdi mdi-login me-1"></i> Return to Sign In
            </a>
            <a href="<?= site_url('auth/register') ?>" class="btn btn-outline-secondary rounded-pill font-13">
                <i class="mdi mdi-account-plus-outline me-1"></i> Register Again
            </a>
        </div>
    <?php endif; ?>

    <div class="pt-3 border-top text-center">
        <p class="text-muted font-13 mb-0">
            Need help? Visit our <a href="<?= site_url('faqs') ?>" class="text-primary text-decoration-none fw-semibold">Help Center &amp; FAQs</a>
        </p>
    </div>
<?= $this->endSection() ?>