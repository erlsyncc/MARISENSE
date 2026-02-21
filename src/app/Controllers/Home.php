<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['apiKey'] = "YOUR_GOOGLE_MAPS_API_KEY";
        return view('landing', $data);
    }
}