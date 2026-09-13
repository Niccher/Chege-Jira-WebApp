<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Forgot Password • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center mt-0 fw-bold">Reset Password</h4>
        <p class="text-muted mb-4">Enter your email address and we'll send you instructions to reset your password.</p>
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

    <form action="<?= site_url('auth/forgot-password') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input class="form-control" type="email" id="email" name="email" required="" placeholder="Enter your registered email">
        </div>

        <div class="mb-3 text-center">
            <button class="btn btn-primary w-100" type="submit">
                <i class="fas fa-paper-plane me-1"></i> Send Instructions
            </button>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Back to <a href="<?= site_url('auth/login') ?>" class="text-muted ms-1"><b>Log In</b></a></p>
        </div>
    </div>
<?= $this->endSection() ?>
