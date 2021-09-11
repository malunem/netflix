<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get info from file ratings.csv 
        $handle = fopen("resources/movies-dataset/ratings.csv", "r");
        if ($handle) {

            echo "Inserting data in ratings table:";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //don't evaluate first row (headings)
                if ($index == 0) {
                    $index++;
                    continue;
                }
                
                $user_id = $lineValues[0];
                $movie_id = $lineValues[1];
                $rating = $lineValues[2];
                
                //check if movie exist in movies table
                if (!DB::table('movies')->where('id', $movie_id)->exists()) {
                    $index++;
                    continue;
                }

                $index++;
                
                //add vote to table
                $q_insertImages = "INSERT INTO ratings VALUES(NULL, ?, ?, ?)";
                
                DB::statement($q_insertImages, [
                    $user_id,
                    $movie_id,
                    $rating,
                ]);

                //Loading bar to be saw in bash
                // ==========> 100% Completed.
                $percentage = ($index/26024289)*100;
                
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
                
                /* if ($index >= 21){
                    break;
                } */
            }
        };
        fclose($handle);
    }
}
