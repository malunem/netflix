<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/movies_metadata.csv", "r");
        if ($handle) {

            echo "Inserting data in votes table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //check if movie id exists and row has a valid lentgh
                if ($lineValues[5] == NULL || sizeof($lineValues) < 20) {
                    echo "check 1 \n";
                    $index++;
                    continue;
                }

                //check if movie exist in movies table
                if (!DB::table('movies')->where('id', $lineValues[5])->exists()) {
                    echo "check 2: movie_id: $lineValues[5] doesn't exist \n";
                    $index++;
                    continue;
                }
                
                $vote_average = $lineValues[22]; //save the vote average column value 
                $vote_count = $lineValues[23]; //save the vote average column value 

                //if vote average has an invalid value, go to next iteration
                if (!is_numeric($vote_average)){
                    $index++;
                    continue;
                }
                //if vote count has an invalid value, go to next iteration
                if (!is_numeric($vote_count)){
                    $index++;
                    continue;
                }

                //Jump the first line of the csv file (it has heading not values)
                if ($index == 0) {
                    $index++;
                    continue;
                }

                //Loading bar to be saw in bash
                // ==========> 100% Completed.
                $percentage = ($index/45575)*100;

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

                //add vote to table
                $q_insertVote = "INSERT INTO votes VALUES(NULL, ?, ?, ?)";

                DB::statement($q_insertVote, [
                    $vote_average,
                    $vote_count,
                    $lineValues[5], //movie id
                ]);

                if ($index >= 21){
                    break;
                }
            }
        };
        fclose($handle);
    }
}

