<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="text-center w-75 m-auto">
        <h4 class="text-dark-50 text-center mt-0 fw-bold">Sign In</h4>
        <p class="text-muted mb-4">Enter your email address and password to access your dashboard.</p>
    </div>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger" role="alert">
            <i class="mdi mdi-alert-circle-outline me-2"></i>
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i>
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/login') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input class="form-control" type="email" id="email" name="email" required="" placeholder="Enter your email">
        </div>

        <div class="mb-3">
            <a href="<?= site_url('auth/forgot-password') ?>" class="text-muted float-end"><small>Forgot your password?</small></a>
            <label for="password" class="form-label">Password</label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                <div class="input-group-text" data-password="false">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>

        <div class="mb-3 mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        </div>

        <div class="mb-3 text-center">
            <button class="btn btn-primary w-100" type="submit"> Log In </button>
        </div>
    </form>
    
    <div class="row mt-3">
        <div class="col-12 text-center">
            <p class="text-muted">Don't have an account? <a href="<?= site_url('auth/register') ?>" class="text-muted ms-1"><b>Sign Up</b></a></p>
        </div> <!-- end col -->
    </div>
<?= $this->endSection() ?>
