<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        return view('Frontend.index');
    }
    // User registration and login methods can be added here

    public function register()
    {
        return view('Frontend.login.register');
    }
}
