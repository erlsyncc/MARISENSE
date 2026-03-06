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

// Idagdag itong dalawa para sa Register
$routes->get('register', 'Auth::register'); 
$routes->post('registerAuth', 'Auth::registerAuth');

// Shield default routes (Keep this at the bottom)
service('auth')->routes($routes);