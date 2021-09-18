<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/movies_metadata.csv", "r");
        if ($handle) {

            echo "Inserting data in countries table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //Jump the first line of the csv file (it has heading not values)
                if ($index == 0) {
                    $index++;
                    continue;
                }

                //if country column value doesn't exist, go to next iteration
                if (sizeof($lineValues) < 13 || $lineValues[13] == NULL || $lineValues[13] == "[]") {
                    $index++;
                    continue;
                }
                
                $countryObjects = $lineValues[13]; //save the country column value 

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

                $wrongs = ["D'I", "e's"];
                $rights = ["D I", "e s"];

                $countryObjects = str_replace($wrongs, $rights, $countryObjects);

                $countryObjects = json_decode(str_replace("'", "\"", $countryObjects));

                foreach ($countryObjects as $countryObject) {
                    
                    $country_short = $countryObject->iso_3166_1 ?? NULL;
                    $country_name = $countryObject->name ?? NULL;
                    
                    //if either short or name don't exist, go to next iteration 
                    if ($country_short == NULL && $country_name == NULL) {
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
    
                    //if country is already in the table, save relationship and go to next iteration
                    if (DB::table('countries')->where('short', $country_short)->exists()) {

                        $country_id = Country::where('short', $country_short)->get('id');
                        
                        if (!DB::table('country_movie')->where('country_id', $country_id)->where('movie_id', $lineValues[5])->exists()) {

                            $country = Country::find($country_id);
                            $movie = Movie::find($lineValues[5]);

                            $country[0]->getMovies()->attach($movie); //insert relationship with movie id in country_movie table
                        }

                        continue;
                    }
    
                    //if country isn't in the table yet, add it
                    $q_insertcountry = "INSERT INTO countries VALUES(NULL, ?, ?)";
    
                    DB::statement($q_insertcountry, [
                        $country_short,
                        $country_name
                    ]);

                    $country_id = Country::where('short', $country_short)->get('id');

                    if (!DB::table('country_movie')->where('country_id', $country_id)->where('movie_id', $lineValues[5])->exists()) {

                        $country = Country::find($country_id);
                        $movie = Movie::find($lineValues[5]);

                        $country[0]->getMovies()->attach($movie); //insert relationship with movie id in country_movie table
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
