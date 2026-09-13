<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('title') ?>Verify Email<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="verify-box" class="login-box visible card no-border">
    <div class="card-body">
        <div class="p-3">
            <h4 class="header blue lighter bigger">
                <i class="ace-icon fa fa-envelope green"></i>
                Verify Your Email
            </h4>

            <div class="space-6"></div>
            
            <p>
                We've sent an email to your address with a verification link. Please click that link to activate your account.
            </p>
            
            <?php if (session('error')) : ?>
                <div class="alert alert-danger">
                    <?= session('error') ?>
                </div>
            <?php endif ?>
            
            <?php if (session('success')) : ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif ?>

            <div class="space-6"></div>

            <form action="<?= url_to('auth/resend-verification') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="clearfix">
                    <button type="submit" class="width-100 btn btn-sm btn-primary">
                        <i class="ace-icon fa fa-refresh"></i>
                        <span class="bigger-110">Resend Verification Email</span>
                    </button>
                </div>
            </form>
        </div><!-- /.p-3 -->

        <div class="toolbar clearfix">
            <div>
                <a href="<?= url_to('logout') ?>" class="user-signup-link">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Use another account
                </a>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
<?= $this->endSection() ?>
