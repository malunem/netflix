<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesSeeder extends Seeder
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

            echo "Inserting data in movies table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0;

                if ($index == 0) {
                    $index++;
                    continue;
                }

                $percentage = ($index/45575)*100;

                static $actual = 0;
                
                if ($percentage-$actual >= 10) {
                    echo "=";
                    $actual = $percentage;
                }

                static $completed = false;

                if ($percentage >= 99 && $completed == false) {
                    echo "> 100% completed.\n";
                    $completed = true;
                }

                $index++;

                //check if movie id exists and row has a valid lentgh
                if (Movie::find($lineValues[5]) != NULL || sizeof($lineValues) < 20) {
                    continue;
                }

                $language = '';

                //if language column has an invalid value, replace it with null, else replace it with its id
                if (DB::table('languages')->where('short', $lineValues[7])->exists()) {
                    $results = (DB::table('languages')->select('id')->where('short', $lineValues[7])->get());
                    
                    $language = $results[0]->id;

                } else {
                    $language = NULL;
                }

                //add movie to table
                $q_insertMovie = "INSERT INTO movies VALUES(?, ?, ?, ?, ?)";

                DB::statement($q_insertMovie, [
                    $lineValues[5], //id
                    $lineValues[20], //title
                    $lineValues[9], //overview
                    (($lineValues[14] == '') ? NULL : $lineValues[14]), //release date
                    $language
                ]);

                if ($index >= 21){
                    break;
                }
            }
        };
        fclose($handle);
    }
}
