<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class WebController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function contactus()
    {
        return view('contactus');
    }

    public function aboutus()
    {
        return view('aboutus');
    }

    public function terms()
    {
        return view('terms');
    }

    public function privacy()
    {
        return view('privacy');
    }
}
