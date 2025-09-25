<?php
// === Add these lines into app/Config/Routes.php ===

// Auth (no filter)
$routes->post('login', 'AuthController::login');

// Protected routes (require Bearer token)
$routes->group('api', ['filter' => 'auth'], static function($routes) {
    $routes->get('users', 'Api\UserController::index');
    $routes->post('users', 'Api\UserController::create');
    $routes->get('users/(:num)', 'Api\UserController::show/$1');
    $routes->put('users/(:num)', 'Api\UserController::update/$1');
    $routes->patch('users/(:num)', 'Api\UserController::partialUpdate/$1');
    $routes->delete('users/(:num)', 'Api\UserController::delete/$1');
});
