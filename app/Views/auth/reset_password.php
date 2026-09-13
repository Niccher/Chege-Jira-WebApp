<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Create New Password • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center mt-0 fw-bold">Set New Password</h4>
        <p class="text-muted mb-4">Enter your new password below to regain access to your account.</p>
    </div>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <?= session('error') ?>
        </div>
    <?php endif ?>

    <?php if (session()->has('errors')) : ?>
        <div class="alert alert-danger" role="alert">
            <ul class="list-unstyled mb-0">
                <?php foreach (session('errors') as $error) : ?>
                    <li><i class="mdi mdi-alert-circle-outline me-1"></i> <?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= site_url('auth/reset-password') ?>" method="POST">
        <?= csrf_field() ?>
        <?php if (!empty($token)): ?>
            <input type="hidden" name="token" value="<?= esc($token) ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password" required minlength="8">
                <div class="input-group-text" data-password="false">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirm New Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Confirm new password" required minlength="8">
                <div class="input-group-text" data-password="false">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>

        <div class="mb-3 text-center">
            <button class="btn btn-primary w-100" type="submit">
                <i class="fas fa-lock me-1"></i> Update Password
            </button>
        </div>
    </form>

    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Remembered your password? <a href="<?= site_url('auth/login') ?>" class="text-muted ms-1"><b>Log In</b></a></p>
        </div>
    </div>
<?= $this->endSection() ?>
