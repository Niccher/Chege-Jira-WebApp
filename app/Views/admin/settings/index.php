<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>
System Settings
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-header">
    <h1>
        System Settings
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Manage application preferences
        </small>
    </h1>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        
        <?php if (session()->has('message')) : ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <?= session('message') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <?= session('error') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h4 class="widget-title">General Settings</h4>
            </div>

            <div class="card-body">
                <div class="p-3">
                    <form action="<?= base_url('admin/settings/update') ?>" method="POST" class="form-horizontal" role="form">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="site_name"> Application Name </label>

                            <div class="col-sm-9">
                                <input type="text" id="site_name" name="site_name" placeholder="e.g. Chege Jira" class="col-10 col-sm-12" value="<?= esc(setting('App.siteName')) ?>" required />
                                <span class="help-block col-12 col-sm-12 no-padding-left">This name will be displayed in the header, footer, and emails.</span>
                            </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
