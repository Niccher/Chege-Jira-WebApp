<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Login • <?= esc(setting('App.siteName')) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
    <p class="login-info">Sign in to continue to your dashboard.</p>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i>
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->has('success')): ?>
        <div class="alert alert-success">
            <i class="fa fa-check"></i>
            <?= session('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/login') ?>" method="POST" id="loginForm">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required autofocus />
                    <i class="ace-icon fa fa-envelope"></i>
                </span>
            </label>
        </div>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="password" class="form-control" name="password" placeholder="Password" required />
                    <i class="ace-icon fa fa-lock"></i>
                </span>
            </label>
        </div>

        <div class="clearfix">
            <label class="inline">
                <input type="checkbox" class="ace" name="remember" />
                <span class="lbl"> Remember Me</span>
            </label>

            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                <i class="ace-icon fa fa-key"></i>
                <span class="bigger-110">Login</span>
            </button>
        </div>

        <div class="space-4"></div>

        <div class="forgot-password-info">
            <a href="<?= site_url('auth/forgot-password') ?>">
                <i class="ace-icon fa fa-arrow-left"></i>
                Forgot Password?
            </a>
        </div>
    </form>

    <div class="social-or-login">
        <span class="bigger-110">Don't have an account?</span>
        <br />
        <br />
        <a href="<?= site_url('auth/register') ?>" class="btn btn-sm btn-block btn-success">
            <i class="ace-icon fa fa-user"></i>
            <span class="bigger-110">Create a New Account</span>
        </a>
    </div>
<?= $this->endSection() ?>
