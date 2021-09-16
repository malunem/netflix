<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/movies_metadata.csv", "r");
        if ($handle) {

            echo "Inserting data in genres table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //Jump the first line of the csv file (it has heading not values)
                if ($index == 0) {
                    $index++;
                    continue;
                }

                //if genre column value doesn't exist, go to next iteration
                if ($lineValues[3] == NULL) {
                    echo "iterazione $index check 2\n";
                    $index++;
                    continue;
                }
                
                $genreObjects = $lineValues[3]; //save the genre column value 

                //check if movie id exists and row has a valid lentgh
                if ($lineValues[5] == NULL || sizeof($lineValues) < 20) {
                    $index++;
                    continue;
                }

                //check if movie exist in movies table
                if (!DB::table('movies')->where('id', $lineValues[5])->exists()) {
                    $index++;
                    continue;
                }

                $genreObjects = json_decode(str_replace("'", "\"", $genreObjects));

                foreach ($genreObjects as $genreObject) {
                    
                    $genre_id = $genreObject->id ?? NULL;
                    $genre_name = $genreObject->name ?? NULL;
                    
                    //if id or name doesn't exist, go to next iteration 
                    if ($genre_id == NULL || $genre_name == NULL) {
                        echo "iterazione $index check 5\n";
                        $index++;
                        continue;
                    }
    
                    $index++;

                    //Loading bar to be saw in bash
                    // ==========> 100% Completed.
                    $percentage = ($index/181000)*100;
    
                    static $actual = 0; //save actual percentage completion through iterations
                    
                    if ($percentage-$actual >= 10) { //every 10% of completion
                        echo "=";                   //print "=" to extend loading bar
                        $actual = $percentage;     //save new percentage in actual
                    }
    
                    static $completed = false;
    
                    if ($percentage >= 99 && $completed == false) {
                        echo "> 100% completed.\n";
                        $completed = true;  //save completed in static variable to not trigger previous echo anymore
                    }
                    //End loading bar 
    
                    $index++;
    
                    //if genre is already in the table, save relationship and go to next iteration
                    if (DB::table('genres')->where('id', $genre_id)->exists()) {
                        
                        if (!DB::table('genre_movie')->where('genre_id', $genre_id)->where('movie_id', $lineValues[5])->exists()) {

                            echo "qui\n";
                            echo "genre: $genre_id, movie: $lineValues[5]\n";

                            $genre = Genre::find($genre_id);
                            $movie = Movie::find($lineValues[5]);

                            //$movie->getGenres()->attach($genre);
                            //echo "- attached genre $genre to movie $movie\n";

                            $genre->getMovies()->attach($movie); //insert relationship with movie id in genre_movie table
                            echo "- attached movie $movie to genre $genre\n\n";
                        }
    
                        //echo "iterazione $index check 6\n";

                        continue;
                    }
    
                    //if genre isn't in the table yet, add it
                    $q_insertGenre = "INSERT INTO genres VALUES(?, ?)";
    
                    DB::statement($q_insertGenre, [
                        $genre_id,
                        $genre_name
                    ]);

                    if (!DB::table('genre_movie')->where('genre_id', $genre_id)->where('movie_id', $lineValues[5])->exists()) {
                        echo "qua\n";
                        echo "genre: $genre_id, movie: $lineValues[5]\n";

                        $genre = Genre::find($genre_id);
                        $movie = Movie::find($lineValues[5]);

                        //$movie->getGenres()->attach($genre);
                        echo "- attached genre $genre to movie $movie\n";

                        //$genre->getMovies()->attach($movie); //insert relationship with movie id in genre_movie table
                        echo "- attached movie $movie to genre $genre\n\n";
                    }
                }

                /* if ($index >= 100){
                    break;
                } */
            }
        };
        fclose($handle);
    }
}
