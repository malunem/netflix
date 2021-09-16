<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class CollaborativeRecommenderSystem{

    public function suggestMoviesFor(Movie $movie){
        $selectedMovie = $movie->id;

        $usersWhoLikedIt = $this->getUsersWhoLiked($selectedMovie);
        $suggestedMovies = $this->getSuggestedMovies($usersWhoLikedIt, $selectedMovie);

        //$suggestedMovies = array_pad([], 10, 0);

        return $suggestedMovies;
    }

    private function getUsersWhoLiked($movieID){
        
        $userObjects = DB::table('ratings')
                    ->select('user_id')
                    ->where('movie_id', $movieID)
                    ->where('rating', 5)
                    ->get()
                    ->toArray();
        
        $users = [];

        foreach ($userObjects as $userObject) {
            array_push($users, $userObject->user_id);
        }

        return $users; //array of objects
    }

    private function getSuggestedMovies($users, $id){
        $ratingObjects = DB::table('ratings')
        ->select('movie_id', 'user_id', 'rating')
        ->whereNotIn('movie_id', [$id])
        ->whereIn('user_id', $users)
        ->get()
        ->toArray();

        $movieScores = [];

        foreach ($ratingObjects as $ratingObject) {
            if (isset($movieScores[$ratingObject->movie_id])) {
                $movieScores[$ratingObject->movie_id] += $ratingObject->rating;
            } else {
                $movieScores[$ratingObject->movie_id] = $ratingObject->rating;
            }
        }

        arsort($movieScores);
        $movieScores = array_slice($movieScores, 0, 10, true);

        return $movieScores;
    }
}