<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function getHomepage() {
        return view('homepage');
    }
    
    public function getMovie() {
        return view('movie');
    }
}
