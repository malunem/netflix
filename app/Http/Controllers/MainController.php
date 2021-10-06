<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ContentBasedRecommenderSystem;
use App\Services\CollaborativeRecommenderSystem;

class MainController extends Controller
{
    private $base_path = "http://image.tmdb.org/t/p/w500/";

    public function getHomepage() {

        
        /* HEADER RANDOM MOVIE */
        $randomImage = Image::inRandomOrder()->first();
        $headerMovie = Movie::find($randomImage->movie_id);
        $base_path = $this->base_path;
        $backdrop_path = $randomImage->backdrop_path;
        $full_path = $this->base_path . $backdrop_path;
        
        /* CATEGORIES */
        $genres = Genre::inRandomOrder()->get();
        $genresRandomMovies = [];
        
        $moviesWithImages = DB::table('images')
            ->join('movies', 'images.movie_id', '=', 'movies.id')

            ->get();


        foreach ($genres as $genre) {
            $movies = DB::table('genre_movie')
                            ->where('genre_id', $genre->id)
                            ->join('images', 'genre_movie.movie_id', '=', 'images.movie_id')
                            ->join('movies', 'genre_movie.movie_id', '=', 'movies.id')
                            ->inRandomOrder()
                            ->limit(10)
                            ->get();

            $genresRandomMovies[$genre->genre] = $movies;

            
        }

        return view('homepage', compact('headerMovie', 'full_path', 'base_path', 'genres', 'genresRandomMovies'));
    }
    
    public function getMovie($id) {
        $movie = Movie::find($id);
        $base_path = $this->base_path;
        if (Image::where('movie_id', $id)->exists()) {
            $backdrop_path = $this->base_path . Image::where('movie_id', $id)->first()->backdrop_path;
        } else {
            $backdrop_path = "/images/movie_graphic.png";
        }
        
        $collab_engine = new CollaborativeRecommenderSystem;
        //return array key value where key = movie id and value = score
        $collab_suggestions = $collab_engine->suggestMoviesFor($movie);
        $collab_movies = [];

        //create array with Movie models
        foreach ($collab_suggestions as $movie_id => $score) {
            $collab_suggested_movie = Movie::find($movie_id);

            $collab_movies[] = $collab_suggested_movie; //append movie to array
        }

        ini_set('memory_limit', '1024M'); //TO-DO: FIND A WAY TO USE LESS MEMORY AND REMOVE THIS
        ini_set('max_execution_time', 120);

        $content_engine = new ContentBasedRecommenderSystem;
        $content_suggestions = $content_engine->suggestMoviesFor($movie);
        $content_movies = [];

        //create array with Movie models
        foreach ($content_suggestions as $movie_id => $score) {
            $content_suggested_movie = Movie::find($movie_id);

            $content_movies[] = $content_suggested_movie; //append movie to array
        }

        return view('movie', compact('base_path', 'backdrop_path', 'movie', 'collab_suggestions', 'collab_movies', 'content_suggestions', 'content_movies'));
    }
}
