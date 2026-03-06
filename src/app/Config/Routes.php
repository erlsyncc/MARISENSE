<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Landing Page
$routes->get('/', 'Home::index');

// Custom Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('loginAuth', 'Auth::loginAuth');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register'); 
$routes->post('registerAuth', 'Auth::registerAuth');

// Protektadong Routes (Dapat naka-login para makapasok)
$routes->group('', ['filter' => 'session'], function($routes) {
    $routes->get('user/home', 'User::index');
    $routes->get('admin/dashboard', 'Admin::index');
});

// Shield default routes
service('auth')->routes($routes);