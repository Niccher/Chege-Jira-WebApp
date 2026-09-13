<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Verify Email • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <div class="mb-3">
            <div style="width: 72px; height: 72px; background: rgba(114, 94, 195, 0.12); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-envelope-open-text fa-2x text-primary"></i>
            </div>
        </div>
        <h4 class="text-dark-50 text-center mt-0 fw-bold">Verify Your Email</h4>
        <p class="text-muted mb-4">We've sent an activation link to your email address. Please check your inbox and click the link to activate your account.</p>
    </div>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <?= session('error') ?>
        </div>
    <?php endif ?>

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i>
            <?= session('success') ?>
        </div>
    <?php endif ?>

    <form action="<?= site_url('auth/resend-verification') ?>" method="POST" class="mb-3">
        <?= csrf_field() ?>
        <?php if (session()->has('email')) : ?>
            <input type="hidden" name="email" value="<?= esc(session('email')) ?>">
        <?php endif; ?>
        
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sync-alt me-1"></i> Resend Verification Email
        </button>
    </form>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Need to use another account? <a href="<?= site_url('auth/logout') ?>" class="text-muted ms-1"><b>Log Out</b></a></p>
        </div>
    </div>
<?= $this->endSection() ?>
