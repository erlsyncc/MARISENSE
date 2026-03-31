<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. PUBLIC ROUTES
$routes->get('/', 'Home::index');

// Custom Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('loginAuth', 'Auth::loginAuth');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register'); 
$routes->post('registerAuth', 'Auth::registerAuth');

// 2. PROTECTED ROUTES (Kailangan ng Login)
$routes->group('', ['filter' => 'session'], function($routes) {
    
    // --- USER SIDE ROUTES ---
    $routes->get('user/home', 'User::index');
    $routes->get('user/activities', 'User::activities');
    $routes->get('user/safety', 'User::safety');
    $routes->get('user/booking', 'User::booking');
    $routes->get('user/my-bookings', 'User::my_bookings');
    $routes->get('user/calendar', 'User::calendar');
    $routes->get('user/reviews', 'User::reviews');

    // --- ADMIN SIDE ROUTES ---
    // Lahat ng ito ay magsisimula sa /admin/...
    $routes->group('admin', function($routes) {
        // Dashboard
        $routes->get('dashboard',      'Admin::index');
        
        // Bookings Management
        $routes->get('bookings',       'Admin::bookings');
        $routes->post('bookings/update-status', 'Admin::updateBookingStatus');

        // User Management
        $routes->get('users',          'Admin::users');

        // MARISENSE / Sea Conditions
        $routes->get('sea-conditions', 'Admin::seaConditions');
        $routes->post('sea-conditions/update', 'Admin::updateSeaConditions');

        // Reviews Moderation
        $routes->get('reviews',        'Admin::reviews');
        $routes->post('reviews/delete', 'Admin::deleteReview');

        // Activities Management
        $routes->get('activities',     'Admin::activitiesPage');
        $routes->post('activities/save', 'Admin::saveActivity');
    });
});

// 3. SHIELD DEFAULT ROUTES
service('auth')->routes($routes);