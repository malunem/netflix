<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/movies_metadata.csv", "r");
        if ($handle) {

            echo "Inserting data in images table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

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

                //if images object doesn't exist, go to next iteration
                if ($lineValues[1] == NULL) {
                    $index++;
                    continue;
                }

                //replace single quote with double quotes to be decoded in php object
                $object = json_decode(str_replace("'", "\"", $lineValues[1]));
                
                $poster_path = $object->poster_path ?? NULL;
                $backdrop_path = $object->backdrop_path ?? NULL;
                
                //if neither poster or backdrop exist, go to next iteration 
                if ($poster_path == NULL && $backdrop_path == NULL) {
                    $index++;
                    continue;
                }

                $index++;
                
                //add vote to table
                $q_insertImages = "INSERT INTO images VALUES(NULL, ?, ?, ?)";
                
                DB::statement($q_insertImages, [
                    $poster_path,
                    $backdrop_path,
                    $lineValues[5], //movie id
                ]);

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
                
                /* if ($index >= 21){
                    break;
                } */
            }
        };
        fclose($handle);
    }
}
