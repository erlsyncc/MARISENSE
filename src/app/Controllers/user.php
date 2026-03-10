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

    public function calendar() {
        return view('user/calendar');
    }

    public function reviews() {
        return view('user/reviews');
    }
}