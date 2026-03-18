<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index() {
        return view('user/home');
    }

    public function activities() {
        return view('user/activities');
    }

    public function safety() {
        return view('user/safety');
    }

    public function booking() {
        return view('user/booking');
    }

    public function my_bookings() {
        return view('user/my_bookings'); // Siguraduhin na 'my_bookings.php' ang filename sa 'views/user/'
    }

    public function reviews() {
        return view('user/reviews');
    }
}