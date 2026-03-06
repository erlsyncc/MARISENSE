<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        // Siguraduhin na ang view file ay nasa app/Views/admin/dashboard.php
        return view('admin/dashboard');
    }
}