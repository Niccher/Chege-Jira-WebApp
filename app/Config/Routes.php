<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'User\Dashboard::index');
$routes->get('/projects', 'User\Dashboard::projects');
$routes->get('/kanban', 'User\Dashboard::project_kanban');
$routes->get('/calendar', 'User\Dashboard::project_calendar');
$routes->get('/time', 'User\Dashboard::project_time_tracker');
$routes->get('/notes', 'User\Dashboard::project_notes');
$routes->get('/analytics', 'User\Dashboard::project_analytics');
$routes->get('/settings', 'User\Dashboard::project_settings');

