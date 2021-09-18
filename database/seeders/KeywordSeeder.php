<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Keyword;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeywordSeeder extends Seeder
{
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/keywords.csv", "r");
        if ($handle) {

            echo "Inserting data in keywords table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //Jump the first line of the csv file (it has heading not values)
                if ($index == 0) {
                    $index++;
                    continue;
                }

                //if keyword column value doesn't exist, go to next iteration
                if (sizeof($lineValues) < 2 || $lineValues[1] == NULL || $lineValues[1] == "[]") {
                    $index++;
                    continue;
                }
                
                $keywordObjects = $lineValues[1]; //save the keyword column value 

                //check if movie id exists and row has a valid lentgh
                if ($lineValues[0] == NULL || sizeof($lineValues) < 2) {
                    $index++;
                    continue;
                }

                //check if movie exist in movies table
                if (!DB::table('movies')->where('id', $lineValues[0])->exists()) {
                    $index++;
                    continue;
                }

                $wrongs = ["D'I", "e's"];
                $rights = ["D I", "e s"];

                $keywordObjects = str_replace($wrongs, $rights, $keywordObjects);

                $keywordObjects = json_decode(str_replace("'", "\"", $keywordObjects));

                foreach ($keywordObjects as $keywordObject) {
                    
                    $keyword_id = $keywordObject->id ?? NULL;
                    $keyword_name = $keywordObject->name ?? NULL;
                    
                    //if either id or name don't exist, go to next iteration 
                    if ($keyword_id == NULL || $keyword_name == NULL) {
                        $index++;
                        continue;
                    }
    
                    $index++;

                    //Loading bar to be saw in bash
                    // ==========> 100% Completed.
                    $percentage = ($index/46000)*100;
    
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
    
                    //if keyword is already in the table, save relationship and go to next iteration
                    if (DB::table('keywords')->where('id', $keyword_id)->exists()) {

                        $keyword_id = Keyword::where('id', $keyword_id)->get('id');
                        
                        if (!DB::table('keyword_movie')->where('keyword_id', $keyword_id)->where('movie_id', $lineValues[0])->exists()) {

                            $keyword = Keyword::find($keyword_id);
                            $movie = Movie::find($lineValues[0]);

                            $keyword[0]->getMovies()->attach($movie); //insert relationship with movie id in keyword_movie table
                        }

                        continue;
                    }
    
                    //if keyword isn't in the table yet, add it
                    $q_insertkeyword = "INSERT INTO keywords VALUES(NULL, ?, ?)";
    
                    DB::statement($q_insertkeyword, [
                        $keyword_id,
                        $keyword_name
                    ]);

                    $keyword_id = Keyword::where('id', $keyword_id)->get('id');

                    if (!DB::table('keyword_movie')->where('keyword_id', $keyword_id)->where('movie_id', $lineValues[0])->exists()) {

                        $keyword = Keyword::find($keyword_id);
                        $movie = Movie::find($lineValues[0]);

                        $keyword[0]->getMovies()->attach($movie); //insert relationship with movie id in keyword_movie table
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
