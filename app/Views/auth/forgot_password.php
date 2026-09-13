<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('title') ?>Forgot Password<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="forgot-box" class="forgot-box visible card no-border">
    <div class="card-body">
        <div class="p-3">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-key"></i>
                Retrieve Password
            </h4>

            <div class="space-6"></div>
            <p>
                Enter your email and to receive instructions
            </p>

            <?php if (session('error')) : ?>
                <div class="alert alert-danger">
                    <i class="ace-icon fa fa-exclamation-circle"></i>
                    <?= session('error') ?>
                </div>
            <?php endif ?>

            <?php if (session('success')) : ?>
                <div class="alert alert-success">
                    <i class="ace-icon fa fa-check-circle"></i>
                    <?= session('success') ?>
                </div>
            <?php endif ?>

            <form action="<?= url_to('magic-link') ?>" method="post">
                <?= csrf_field() ?>

                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required />
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>

                    <div class="clearfix">
                        <button type="submit" class="width-35 float-end btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-lightbulb-o"></i>
                            <span class="bigger-110">Send Me!</span>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.p-3 -->

        <div class="toolbar center">
            <a href="<?= url_to('login') ?>" class="back-to-login-link">
                Back to login
                <i class="ace-icon fa fa-arrow-right"></i>
            </a>
        </div>
    </div><!-- /.card-body -->
</div><!-- /.forgot-box -->

<?= $this->endSection() ?>
