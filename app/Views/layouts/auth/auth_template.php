<?= $this->extend('layouts/appstack/auth') ?>

<?= $this->section('content') ?>
    <div class="text-center mt-4">
        <h1 class="h2">Chege JIRA</h1>
        <p class="lead">
            Sign in or create an account to continue
        </p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
