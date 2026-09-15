<?= $this->extend('layouts/hyper/auth_template') ?>

<?= $this->section('title') ?>Sign In<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="fw-bold text-body mb-1">Welcome back!</h3>
    <p class="text-muted font-14">Enter your credentials to access your workspace.</p>
</div>

<?php if(session()->has('error')): ?>
    <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
        <i class="mdi mdi-alert-circle-outline font-18 me-2"></i>
        <div><?= session('error') ?></div>
    </div>
<?php endif; ?>

<?php if(session()->has('errors')): ?>
    <div class="alert alert-danger mb-3" role="alert">
        <ul class="mb-0 ps-3">
            <?php foreach(session('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session()->has('success') || session()->has('message')): ?>
    <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
        <i class="mdi mdi-check-circle-outline font-18 me-2"></i>
        <div><?= session('success') ?? session('message') ?></div>
    </div>
<?php endif; ?>

<form action="<?= site_url('auth/login') ?>" method="POST" id="loginForm">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
            <input class="form-control" type="email" id="email" name="email" value="<?= old('email') ?>" required placeholder="name@company.com" autofocus>
        </div>
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="password" class="form-label fw-semibold mb-0">Password</label>
            <a href="<?= site_url('auth/forgot-password') ?>" class="text-muted font-12">Forgot password?</a>
        </div>
        <div class="input-group">
            <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
            <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
        </div>
    </div>

    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" <?= old('remember') ? 'checked' : '' ?>>
            <label class="form-check-label font-13" for="remember">Keep me logged in on this device</label>
        </div>
    </div>

    <div class="d-grid mb-3">
        <button class="btn btn-primary btn-lg rounded-pill fw-semibold" type="submit">
            <i class="mdi mdi-login me-1"></i> Sign In to Workspace
        </button>
    </div>
</form>

<div class="text-center mt-4">
    <p class="text-muted font-14 mb-0">
        Don't have an account yet? 
        <a href="<?= site_url('auth/register') ?>" class="text-primary fw-bold ms-1">Create Account</a>
    </p>
</div>

<?= $this->endSection() ?>
