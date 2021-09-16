<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class ContentBasedRecommenderSystem {

    //features: genre, country, keywords, cast, company, language

    public function suggestMoviesFor(Movie $movie){
        $selectedMovie = $movie->id;

        $suggestedMovies = "funzione incompleta\n";
        //$suggestedMovies = array_pad([], 10, 0);
        
        $movieScores = [];

        //genre
        $genres = []; //$movie->getGenres('id'); //VEDERE SUL BROWSER COSA ESCE
        foreach ($movie->getGenres as $genre) {
            array_push($genres, $genre);
        }
        
        $movieScores = $this->addGenreScores($genres, $movieScores);
        
        arsort($movieScores);
        $movieScores = array_slice($movieScores, 0, 10, true);
        
        dd($movieScores);
        return $movieScores;
    }

    private function addGenreScores($genres, $movieScores){

        $movieScores = [];

        foreach ($genres as $genre) {
            foreach ($genre->getMovies as $movie) {
                if (isset($movieScores[$movie->id])) {
                    $movieScores[$movie->id] += 1;
                } else {
                    $movieScores[$movie->id] = 1;
                }
            }
            
        }

        return $movieScores;
    }
}