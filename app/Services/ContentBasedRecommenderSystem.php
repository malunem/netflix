<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class ContentBasedRecommenderSystem {

    //features: genre, country, keywords, cast, company, language

    public function suggestMoviesFor(Movie $movie){
        $selectedMovie = $movie->id;
        $movieScores = [];

        //genres scores
        $genres = []; 
        foreach ($movie->getGenres as $genre) {
            array_push($genres, $genre);
        }
        $movieScores = $this->addGenresScores($genres, $movieScores);

        //companies scores
        $companies = [];
        foreach ($movie->getCompanies as $company) {
            array_push($companies, $company);
        }
        $movieScores = $this->addCompaniesScores($companies, $movieScores);
        
        //TOTAL SCORES
        arsort($movieScores);
        unset($movieScores[$selectedMovie]);
        $suggestedMovies = array_slice($movieScores, 0, 10, true);
        
        dd($suggestedMovies);
        return $suggestedMovies;
    }

    private function addGenresScores($genres, $movieScores){

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

    private function addCompaniesScores($companies, $movieScores){

        $movieScores = [];

        foreach ($companies as $company) {
            foreach ($company->getMovies as $company) {
                if (isset($movieScores[$company->id])) {
                    $movieScores[$company->id] += 1;
                } else {
                    $movieScores[$company->id] = 1;
                }
            }
        }

        return $movieScores;
    }
}