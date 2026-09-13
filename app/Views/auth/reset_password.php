<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('title') ?>Reset Password<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="reset-box" class="forgot-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-key"></i>
                Set New Password
            </h4>

            <div class="space-6"></div>
            <p>
                Enter your new password below.
            </p>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger">
                    <i class="ace-icon fa fa-exclamation-circle"></i>
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <form action="<?= url_to('reset-password') ?>" method="post">
                <?= csrf_field() ?>
                <!-- Token would be passed here typically via hidden field or URL -->
                
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="password" class="form-control" name="password" placeholder="New Password" required />
                            <i class="ace-icon fa fa-lock"></i>
                        </span>
                    </label>
                    
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password" required />
                            <i class="ace-icon fa fa-retweet"></i>
                        </span>
                    </label>

                    <div class="clearfix">
                        <button type="submit" class="width-40 pull-right btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-save"></i>
                            <span class="bigger-110">Update</span>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.widget-main -->

        <div class="toolbar center">
            <a href="<?= url_to('login') ?>" class="back-to-login-link">
                Back to login
                <i class="ace-icon fa fa-arrow-right"></i>
            </a>
        </div>
    </div><!-- /.widget-body -->
</div>

<?= $this->endSection() ?>
