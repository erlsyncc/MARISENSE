<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. PUBLIC ROUTES (Kahit hindi naka-login)
$routes->get('/', 'Home::index');

// Custom Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('loginAuth', 'Auth::loginAuth');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register'); 
$routes->post('registerAuth', 'Auth::registerAuth');

// 2. PROTECTED ROUTES (Kailangan ng Session/Login)
$routes->group('', ['filter' => 'session'], function($routes) {
    
    // USER SIDE ROUTES
    $routes->get('user/home', 'User::index');       // home.php
    $routes->get('user/activities', 'User::activities'); // activities.php
    $routes->get('user/safety', 'User::safety');     // safety.php
    $routes->get('user/booking', 'User::booking');   // booking.php
    $routes->get('user/calendar', 'User::calendar'); // calendar.php
    $routes->get('user/reviews', 'User::reviews');   // reviews.php

    // ADMIN SIDE ROUTES
    $routes->get('admin/dashboard', 'Admin::index');
});

// 3. SHIELD DEFAULT ROUTES
service('auth')->routes($routes);