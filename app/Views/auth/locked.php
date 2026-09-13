<?= $this->extend(config('Auth')->views['layout']) ?>
<?= $this->section('title') ?>Account Locked<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div id="locked-box" class="login-box visible card no-border">
    <div class="card-body">
        <div class="p-3 center">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-lock"></i>
                Account Locked
            </h4>

            <div class="space-6"></div>
            
            <p>
                Due to too many failed login attempts, your account has been temporarily locked for security reasons.
            </p>
            <p>
                Please try again later.
            </p>
            
            <div class="space-12"></div>
            
            <a href="<?= url_to('login') ?>" class="btn btn-sm btn-primary">
                <i class="ace-icon fa fa-arrow-left"></i> Return to Login
            </a>
            
        </div><!-- /.p-3 -->
    </div><!-- /.card-body -->
</div>
<?= $this->endSection() ?>
