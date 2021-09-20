<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ContentBasedRecommenderSystem;
use App\Services\CollaborativeRecommenderSystem;

class MainController extends Controller
{
    public function getHomepage() {

        $randomImage = Image::inRandomOrder()->first();
        $headerMovie = Movie::find($randomImage->movie_id);

        $base_path = "http://image.tmdb.org/t/p/w500";
        $backdrop_path = $randomImage->backdrop_path;
        $full_path = $base_path . $backdrop_path;

        //$headerGenres = $headerMovie->getGenres;
        //dd($headerGenres);

        return view('homepage', compact('headerMovie', 'full_path'));
    }
    
    public function getMovie($id) {
        $movie = Movie::find($id);
        
        $collab_engine = new CollaborativeRecommenderSystem;
        $collab_suggestions = $collab_engine->suggestMoviesFor($movie);

        $content_engine = new ContentBasedRecommenderSystem;
        $content_suggestions = $content_engine->suggestMoviesFor($movie);

        dd($content_suggestions);

        return view('movie', compact('collab_suggestions', 'content_suggestions'));
    }
}
