<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/process-login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

$routes->get('/register', 'Auth::register');
$routes->post('/process-register', 'Auth::processRegister');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth:admin,petugas']);

$routes->group('book', ['filter' => 'auth:admin,petugas'], function($routes) {
    $routes->get('/', 'Book::index');
    $routes->get('create', 'Book::create');
    $routes->post('store', 'Book::store');
    $routes->get('edit/(:num)', 'Book::edit/$1');
    $routes->post('update/(:num)', 'Book::update/$1');
    $routes->get('delete/(:num)', 'Book::delete/$1');
});

$routes->group('member', ['filter' => 'auth:admin,petugas'], function($routes) {
    $routes->get('/', 'Member::index');
    $routes->get('create', 'Member::create');
    $routes->post('store', 'Member::store');
    $routes->get('edit/(:num)', 'Member::edit/$1');
    $routes->post('update/(:num)', 'Member::update/$1');
    $routes->get('delete/(:num)', 'Member::delete/$1');
});

$routes->group('loan', ['filter' => 'auth:admin,petugas'], function($routes) {
    $routes->get('/', 'Loan::index');
    $routes->get('create', 'Loan::create');
    $routes->post('store', 'Loan::store');
    $routes->get('edit/(:num)', 'Loan::edit/$1');
    $routes->post('update/(:num)', 'Loan::update/$1');
    $routes->get('delete/(:num)', 'Loan::delete/$1');
});

$routes->group('config', ['filter' => 'auth:admin,petugas'], function($routes) {
    $routes->get('/', 'Config::index');
    $routes->post('process', 'Config::processConfig');
});

$routes->group('account', ['filter' => 'auth:admin,petugas'], function($routes) {
    $routes->get('/', 'Account::index');
    $routes->post('process', 'Account::do_apply_account');
});