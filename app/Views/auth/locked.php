<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Account Locked • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <div class="mb-3">
            <div style="width: 72px; height: 72px; background: rgba(239, 68, 68, 0.12); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center;">
                <i class="fas fa-lock fa-2x text-danger"></i>
            </div>
        </div>
        <h4 class="text-danger text-center mt-0 fw-bold">Account Locked</h4>
        <p class="text-muted mb-4">Due to multiple failed login attempts, your account has been temporarily locked for security reasons.</p>
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

    <?php if (session()->has('email')) : ?>
        <form action="<?= site_url('auth/unlock-account') ?>" method="POST" class="mb-3">
            <?= csrf_field() ?>
            <input type="hidden" name="email" value="<?= esc(session('email')) ?>">
            <button type="submit" class="btn btn-danger w-100">
                <i class="fas fa-unlock me-1"></i> Request Account Unlock
            </button>
        </form>
    <?php endif; ?>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <a href="<?= site_url('auth/login') ?>" class="btn btn-outline-secondary w-100">
                <i class="fas fa-arrow-left me-1"></i> Return to Login
            </a>
        </div>
    </div>
<?= $this->endSection() ?>
