<?= $this->extend('layouts/hyper/main') ?>

<?= $this->section('title') ?>
System Settings
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title"><i class="fas fa-cogs text-primary me-2"></i> System Settings</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-8 col-lg-6">
        
        <?php if (session()->has('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">General Settings</h5>
            </div>

            <div class="card-body">
                <form action="<?= site_url('admin/settings/update') ?>" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold" for="site_name">Application Name</label>
                        <input type="text" id="site_name" name="site_name" placeholder="e.g. Chege Jira" class="form-control" value="<?= esc(setting('App.siteName')) ?>" required />
                        <div class="form-text text-muted">This name will be displayed in the header, footer, page titles, and notification emails.</div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save me-1"></i> Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
