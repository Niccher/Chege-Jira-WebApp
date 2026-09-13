<?= $this->extend('layouts/auth/auth_template') ?>

<?= $this->section('title') ?>Register • Chege JIRA<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <p class="login-info">Create your account to get started.</p>

    <?php if(session()->has('errors')): ?>
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i>
            <ul class="margin-0 padding-10">
                <?php foreach(session('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('auth/register') ?>" method="POST" id="registerForm">
        <?= csrf_field() ?>

        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name" required />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </label>
                </div>
                <div class="col-xs-6">
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name" required />
                            <i class="ace-icon fa fa-user"></i>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required />
                    <i class="ace-icon fa fa-envelope"></i>
                </span>
            </label>
        </div>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="text" class="form-control" name="username" placeholder="Username" required />
                    <i class="ace-icon fa fa-user-circle"></i>
                </span>
            </label>
        </div>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="password" class="form-control" name="password" placeholder="Password (min 8 characters)" required />
                    <i class="ace-icon fa fa-lock"></i>
                </span>
            </label>
        </div>

        <div class="form-group">
            <label class="block clearfix">
                <span class="block input-icon input-icon-right">
                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password" required />
                    <i class="ace-icon fa fa-lock"></i>
                </span>
            </label>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" class="ace" name="terms" required />
                <span class="lbl">
                    I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                </span>
            </label>
        </div>

        <div class="clearfix">
            <button type="submit" class="width-100 btn btn-sm btn-primary">
                <i class="ace-icon fa fa-user-plus"></i>
                <span class="bigger-110">Create Account</span>
            </button>
        </div>

        <div class="space-4"></div>
        <div class="forgot-password-info">
            Already have an account?
            <a href="<?= site_url('auth/login') ?>">
                <i class="ace-icon fa fa-arrow-right"></i>
                Sign In
            </a>
        </div>
    </form>
<?= $this->endSection() ?>
