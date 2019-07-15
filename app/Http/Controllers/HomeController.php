<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function user() {
        return view('user');
    }
    public function profile() {
        return view('profile');
    }
    
}
