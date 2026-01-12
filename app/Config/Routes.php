<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/home', 'User\Dashboard::index');
$routes->get('/projects', 'User\Dashboard::projects');
$routes->get('/kanban', 'User\Dashboard::project_kanban');
$routes->get('/calendar', 'User\Dashboard::project_calendar');
$routes->get('/time', 'User\Dashboard::project_time_tracker');
$routes->get('/notes', 'User\Dashboard::project_notes');
$routes->get('/analytics', 'User\Dashboard::project_analytics');
$routes->get('/settings', 'User\Dashboard::project_settings');

// Load default Shield routes, excluding those we'll customize
service('auth')->routes($routes, ['except' => ['login', 'register', 'forgot', 'reset', 'verify-email', 'locked']]);

// Custom Authentication Routes
$routes->group('auth', static function ($routes) {
    // Login
    $routes->get('login', [\App\Controllers\Auth\LoginController::class, 'loginView'], ['as' => 'login']);
    $routes->post('login', [\App\Controllers\Auth\LoginController::class, 'loginAction']);
    $routes->get('logout', [\App\Controllers\Auth\LoginController::class, 'logoutAction'], ['as' => 'logout']);

    // Register
    $routes->get('register', [\App\Controllers\Auth\RegisterController::class, 'registerView'], ['as' => 'register']);
    $routes->post('register', [\App\Controllers\Auth\RegisterController::class, 'registerAction']);

    // Forgot Password
    $routes->get('forgot-password', [\App\Controllers\Auth\ForgotPasswordController::class, 'forgotPasswordView']);
    $routes->post('forgot-password', [\App\Controllers\Auth\ForgotPasswordController::class, 'forgotPasswordAction']);

    // Reset Password
    $routes->get('reset-password', [\App\Controllers\Auth\ResetPasswordController::class, 'resetPasswordView']);
    $routes->post('reset-password', [\App\Controllers\Auth\ResetPasswordController::class, 'resetPasswordAction']);

    // Email Verification
    $routes->get('verify-email', [\App\Controllers\Auth\AccountController::class, 'verifyEmailView']);
    $routes->get('activate/(:any)', [\App\Controllers\Auth\AccountController::class, 'activateAccount']);
    $routes->post('resend-activation', [\App\Controllers\Auth\AccountController::class, 'resendActivation']);
    $routes->post('resend-verification', [\App\Controllers\Auth\AccountController::class, 'resendActivation']);

    // Locked Account
    $routes->get('locked', [\App\Controllers\Auth\AccountController::class, 'lockedView']);
    $routes->post('unlock-account', [\App\Controllers\Auth\AccountController::class, 'resendActivation']);
});