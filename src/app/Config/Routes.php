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
    $routes->get('user/home',        'User::index');
    $routes->get('user/activities',  'User::activities');
    $routes->get('user/safety',      'User::safety');
    $routes->get('user/reviews',     'User::reviews');
    
    // Review Submission
    $routes->post('user/post-review', 'User::postReview'); // <--- ITO ANG DINAGDAG NATIN

    // Booking - Form & Submit
    $routes->get('user/booking',               'User::booking');
    $routes->post('user/booking/store',        'User::storeBooking');

    // Booking - AJAX endpoints
    $routes->get('user/booking/slots',         'User::bookingSlots');
    $routes->get('user/booking/booked-dates',  'User::bookedDates');

    // My Bookings, Details & Cancel
    $routes->get('user/my-bookings',               'User::my_bookings');
    $routes->get('user/booking-details/(:num)',    'User::bookingDetails/$1');
    $routes->post('user/booking/cancel/(:num)',    'User::cancelBooking/$1');

    // --- ADMIN SIDE ROUTES ---
    $routes->group('admin', function($routes) {
        // Dashboard
        $routes->get('dashboard',      'Admin::index');
        
        // Bookings Management
        $routes->get('bookings',       'Admin::bookings');
        $routes->post('bookings/update-status', 'Admin::updateBookingStatus');

        // User Management
        $routes->get('users',           'Admin::users');

        // MARISENSE / Sea Conditions
        $routes->get('sea-conditions', 'Admin::seaConditions');
        $routes->post('sea-conditions/update', 'Admin::updateSeaConditions');

        // Reviews Moderation
        $routes->get('reviews',        'Admin::reviews');
        $routes->post('reviews/delete', 'Admin::deleteReview');

        // Activities Management
        $routes->get('activities',     'Admin::activitiesPage');
        $routes->post('activities/save', 'Admin::saveActivity');

        $routes->get('sales', 'Admin::sales');
    });
});

// 3. SHIELD DEFAULT ROUTES
service('auth')->routes($routes);