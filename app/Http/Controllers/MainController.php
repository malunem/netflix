<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CollaborativeRecommenderSystem;
use App\Services\ContentBasedRecommenderSystem;

class MainController extends Controller
{
    public function getHomepage() {
        return view('homepage');
    }
    
    public function getMovie($id) {
        $movie = Movie::find($id);
        
        $collab_engine = new CollaborativeRecommenderSystem;
        $collab_suggestions = $collab_engine->suggestMoviesFor($movie);

        $content_engine = new ContentBasedRecommenderSystem;
        $content_suggestions = $content_engine->suggestMoviesFor($movie);
        dd($content_suggestions);

        return view('movie');
    }
}
