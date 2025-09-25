<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Route utama: menampilkan halaman dengan chart
$routes->get('/sales', 'Sales::index');

// Route API: data penjualan harian (Line Chart)
$routes->get('/sales/data', 'Sales::data');

// Route API: data penjualan per kategori (Bar Chart)
$routes->get('/sales/categoryData', 'Sales::categoryData');
