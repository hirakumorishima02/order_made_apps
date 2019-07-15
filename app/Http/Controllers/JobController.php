<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function job(){
        return view('job');
    }
    
    public function job_request(){
        return view('job_request');
    }
    
    
}
