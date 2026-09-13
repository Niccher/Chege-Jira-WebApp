<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Register<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center mt-0 fw-bold">Sign Up</h4>
        <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute.</p>
    </div>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/register') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input class="form-control" type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input class="form-control" type="email" id="email" name="email" required placeholder="Enter your email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                <div class="input-group-text" data-password="false">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirm Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Re-enter your password">
            </div>
        </div>

        <div class="mb-3 text-center">
            <button class="btn btn-primary w-100" type="submit"> Sign Up </button>
        </div>
    </form>
    
    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Already have an account? <a href="<?= site_url('auth/login') ?>" class="text-muted ms-1"><b>Log In</b></a></p>
        </div> <!-- end col -->
    </div>
<?= $this->endSection() ?>
