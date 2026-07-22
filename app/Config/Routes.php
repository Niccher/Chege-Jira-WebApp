<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('/features', 'Home::features');
$routes->get('/setup', 'Home::setup');
$routes->get('/faqs', 'Home::faqs');
$routes->group('', ['filter' => 'session'], function($routes) {
    $routes->get('/home', 'User\Dashboard::index');
    $routes->get('/dashboard', 'User\Dashboard::index');
    $routes->get('/projects', 'User\Dashboard::projects');
    $routes->get('/projects/create', 'User\Dashboard::project_create');
    $routes->post('/projects/store', 'User\Dashboard::project_store');
    $routes->get('/projects/view/(:num)', 'User\Dashboard::project_view/$1');
    $routes->get('/projects/kanban/(:num)', 'User\Dashboard::project_kanban/$1');
    $routes->get('/projects/kanban', 'User\Dashboard::project_kanban');
    $routes->post('/projects/task/move', 'User\Dashboard::task_move');
    $routes->post('/projects/task/store', 'User\Dashboard::task_store');
    $routes->post('/projects/task/update/(:num)', 'User\Dashboard::task_update/$1');
    $routes->get('/projects/edit/(:num)', 'User\Dashboard::project_edit/$1');
    $routes->post('/projects/update/(:num)', 'User\Dashboard::project_update/$1');
    $routes->post('/projects/delete/(:num)', 'User\Dashboard::project_delete/$1');
    $routes->get('/kanban', 'User\Dashboard::project_kanban');
    $routes->get('/calendar', 'User\Dashboard::project_calendar');
    $routes->get('/calendar/events', 'User\Dashboard::get_calendar_events');
    $routes->post('/calendar/event/store', 'User\Dashboard::event_store');
    $routes->post('/calendar/event/update/(:num)', 'User\Dashboard::event_update/$1');
    $routes->post('/calendar/event/delete/(:num)', 'User\Dashboard::event_delete/$1');
    $routes->get('/time', 'User\Dashboard::project_time_tracker');
    $routes->post('/time/start', 'User\Dashboard::timer_start');
    $routes->post('/time/stop/(:num)', 'User\Dashboard::timer_stop/$1');
    $routes->post('/time/manual', 'User\Dashboard::timer_manual');
    $routes->get('/notes', 'User\Dashboard::project_notes');
    $routes->post('/notes/store', 'User\Dashboard::note_store');
    $routes->post('/notes/update/(:num)', 'User\Dashboard::note_update/$1');
    $routes->post('/notes/delete/(:num)', 'User\Dashboard::note_delete/$1');
    $routes->post('/notes/star/(:num)', 'User\Dashboard::note_star/$1');
    $routes->post('/notes/complete/(:num)', 'User\Dashboard::note_complete/$1');
    $routes->get('/analytics', 'User\Dashboard::project_analytics');
    $routes->get('/settings', 'User\Dashboard::project_settings');
    $routes->post('/settings/update', 'User\Dashboard::settings_update');
});

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

    // Email Verification - Using Shield's built-in routes
    $routes->get('verify-email', [\App\Controllers\Auth\AccountController::class, 'verifyEmailAction'], ['as' => 'verify-email']);
    
    // Resend verification
    $routes->post('resend-verification', [\App\Controllers\Auth\AccountController::class, 'resendShieldActivation']);

    // Email Verification Success
    $routes->get('verify-email-success', [\App\Controllers\Auth\AccountController::class, 'verifyEmailSuccess']);

    // Locked Account
    $routes->get('locked', [\App\Controllers\Auth\AccountController::class, 'lockedView']);
    $routes->post('unlock-account', [\App\Controllers\Auth\AccountController::class, 'resendActivation']);
});