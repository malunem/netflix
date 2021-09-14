<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CollaborativeRecommenderSystem;

class MainController extends Controller
{
    public function getHomepage() {
        return view('homepage');
    }
    
    public function getMovie($id) {
        $movie = Movie::find($id);
        $engine = new CollaborativeRecommenderSystem;

        $suggestions = $engine->suggestMoviesFor($movie);

        dd($suggestions);

        return view('movie');
    }
}
