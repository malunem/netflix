<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class ContentBasedRecommenderSystem {

    //features: genres (DONE), countries (IN PROGRESS), keywords, cast, companies (IN PROGRESS), language (DONE)

    public function suggestMoviesFor(Movie $movie){
        $selectedMovie = $movie->id;
        $movieScores = [];

        //language scores
        $language = Language::find($movie->language_id);
        //$movieScores = $this->addLanguageScores($language, $movieScores);
        $this->addLanguageScores($language, $movieScores);

        
        //genres scores
        $genres = []; 
        foreach ($movie->getGenres as $genre) {
            array_push($genres, $genre);
        }
        //$movieScores = $this->addGenresScores($genres, $movieScores);
        $this->addGenresScores($genres, $movieScores);
        
        
        //countries scores
        $countries = [];
        foreach ($movie->getCountries as $country) {
            array_push($countries, $country);
        }
        //$movieScores = $this->addCountriesScore($countries, $movieScores);
        $this->addCountriesScore($countries, $movieScores);
        
        //companies scores
        $companies = [];
        foreach ($movie->getCompanies as $company) {
            array_push($companies, $company);
        }
        //$movieScores = $this->addCompaniesScores($companies, $movieScores);
        $this->addCompaniesScores($companies, $movieScores);

        //keywords scores
        $keywords = [];
        foreach ($movie->getKeywords as $keyword) {
            array_push($keywords, $keyword);
        }
        //$movieScores = $this->addKeywordsScores($keywords, $movieScores);
        $this->addKeywordsScores($keywords, $movieScores);
        
        //TOTAL SCORES
        arsort($movieScores);
        $maxScore = $movieScores[$selectedMovie]; //100% (use to calculate similarity %)
        unset($movieScores[$selectedMovie]);
        $suggestedMovies = array_slice($movieScores, 0, 10, true);
        return $suggestedMovies;
    }

    private function addLanguageScores($language, &$movieScores){

        foreach ($language->getMovies as $movie) {
            if (isset($movieScores[$movie->id])) {
                $movieScores[$movie->id] += 1;
            } else {
                $movieScores[$movie->id] = 1;
            }
        }

        //return $movieScores;
    }

    private function addGenresScores($genres, &$movieScores){

        foreach ($genres as $genre) {
            foreach ($genre->getMovies as $movie) {
                if (isset($movieScores[$movie->id])) {
                    $movieScores[$movie->id] += 1;
                } else {
                    $movieScores[$movie->id] = 1;
                }
            }
        }

        //return $movieScores;
    }

    private function addCountriesScore($countries, &$movieScores){

        foreach ($countries as $country) {
            foreach ($country->getMovies as $movie) {
                if (isset($movieScores[$movie->id])) {
                    $movieScores[$movie->id] += 1;
                } else {
                    $movieScores[$movie->id] = 1;
                }
            }
        }

        //return $movieScores;
    }

    private function addCompaniesScores($companies, &$movieScores){

        foreach ($companies as $company) {
            foreach ($company->getMovies as $movie) {
                if (isset($movieScores[$movie->id])) {
                    $movieScores[$movie->id] += 1;
                } else {
                    $movieScores[$movie->id] = 1;
                }
            }
        }

        //return $movieScores;
    }

    private function addKeywordsScores($keywords, &$movieScores){

        foreach ($keywords as $keyword) {
            foreach ($keyword->getMovies as $movie) {
                if (isset($movieScores[$movie->id])) {
                    $movieScores[$movie->id] += 1;
                } else {
                    $movieScores[$movie->id] = 1;
                }
            }
        }

        //return $movieScores;
    }
}