<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function bookings()
    {
        return view('admin/bookings');
    }

    public function users()
    {
        return view('admin/users');
    }

    public function seaConditions()
    {
        return view('admin/sea_conditions');
    }

    public function reviews()
    {
        return view('admin/reviews');
    }

    public function activitiesPage()
    {
        return view('admin/activities');
    }
}