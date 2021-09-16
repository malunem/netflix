<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use \ForceUTF8\Encoding;

class CompanySeeder extends Seeder
{
    public function run()
    {
        //get info from file movies_metadata.csv 
        $handle = fopen("resources/movies-dataset/movies_metadata.csv", "r");
        if ($handle) {

            echo "Inserting data in companies table: ";

            while (($lineValues = fgetcsv($handle, 0 , ",")) !== false) {
                static $index = 0; //count iterations to calculate percentage of completion

                //Jump the first line of the csv file (it has heading not values)
                if ($index == 0) {
                    $index++;
                    continue;
                }

                //if company column value doesn't exist, go to next iteration
                if ($lineValues[12] == NULL) {
                    $index++;
                    continue;
                }
                
                $companyObjects = $lineValues[12]; //save the company column value 

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
                
                echo "iterazione $index\n companyobjects prima:\n";
                var_dump($companyObjects);

                /* $companyObjects = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $companyObjects);

                echo "\n company objects dopo preg_replace:\n";
                var_dump($companyObjects); */
                
                $companyObjects = str_replace(["d'I"], "d I", $companyObjects);
                $companyObjects = str_replace(["D'P"], "D P", $companyObjects);
                $companyObjects = str_replace(["n' M"], "n M", $companyObjects);
                $companyObjects = str_replace(["r's"], "r s", $companyObjects);
                $companyObjects = str_replace(["l'A"], "l A", $companyObjects);
                $companyObjects = str_replace(["l's"], "l s", $companyObjects);
                $companyObjects = str_replace(["o' B"], "o B", $companyObjects);
                $companyObjects = str_replace(["l'E"], "l E", $companyObjects);
                $companyObjects = str_replace(["l'o"], "l o", $companyObjects);
                $companyObjects = str_replace(["w's"], "w s", $companyObjects);
                $companyObjects = str_replace(["\"Tor\""], "Tor", $companyObjects);
                $companyObjects = str_replace(["c's"], "c s", $companyObjects);
                $companyObjects = str_replace(["v'e"], "v e", $companyObjects);
                $companyObjects = str_replace(["d'é"], "d é", $companyObjects);
                $companyObjects = str_replace(["D'A"], "D A", $companyObjects);
                $companyObjects = str_replace(["D'O"], "D O", $companyObjects);
                $companyObjects = str_replace(["n's"], "n s", $companyObjects);
                $companyObjects = str_replace(["a '8"], "a 8", $companyObjects);
                $companyObjects = str_replace(["i'a"], "i a", $companyObjects);
                $companyObjects = str_replace(["t '9"], "t 9", $companyObjects);
                $companyObjects = str_replace(["d'A"], "d A", $companyObjects);
                $companyObjects = str_replace(["s' C"], "s C", $companyObjects);
                $companyObjects = str_replace(["k's"], "k s", $companyObjects);
                $companyObjects = str_replace(["\"A\""], "A", $companyObjects);
                $companyObjects = str_replace(["n't"], "n t", $companyObjects);
                $companyObjects = str_replace(["s' W"], "s W", $companyObjects);
                $companyObjects = str_replace(["L'O"], "L O", $companyObjects);
                $companyObjects = str_replace(["d's"], "d s", $companyObjects);
                $companyObjects = str_replace(["l'I"], "l I", $companyObjects);
                $companyObjects = str_replace(["y's"], "y s", $companyObjects);
                $companyObjects = str_replace(["\"X\""], "X", $companyObjects);
                $companyObjects = str_replace(["\"Perspektywa\"", "\"Perspektywa"], "Perspektywa", $companyObjects);
                $companyObjects = str_replace(["d'E"], "d E", $companyObjects);
                $companyObjects = str_replace(["\"Kadr\""], "Kadr", $companyObjects);
                $companyObjects = str_replace(["e's"], "e s", $companyObjects);
                $companyObjects = str_replace(["\"DIA\""], "DIA", $companyObjects);
                $companyObjects = str_replace(["P'A"], "P A", $companyObjects);
                $companyObjects = str_replace(["l'i"], "l i", $companyObjects);
                $companyObjects = str_replace(["\"Johannisthal\""], "Johannisthal", $companyObjects);
                $companyObjects = str_replace(["\"Kamera\""], "Kamera", $companyObjects);
                $companyObjects = str_replace(["s' R"], "s R", $companyObjects);
                $companyObjects = str_replace(["\"Zespol Filmowy\""], "Zespol Filmowy", $companyObjects);
                $companyObjects = str_replace(["g's"], "g s", $companyObjects);
                $companyObjects = str_replace(["L'I"], "L I", $companyObjects);
                $companyObjects = str_replace(["''Mosfilm''"], "Mosfilm", $companyObjects);
                $companyObjects = str_replace(["\"Pryzmat\""], "Pryzmat", $companyObjects);
                $companyObjects = str_replace(["n' P"], "n P", $companyObjects);
                $companyObjects = str_replace(["L'A"], "L A", $companyObjects);
                $companyObjects = str_replace(["d'O"], "d O", $companyObjects);
                $companyObjects = str_replace(["\"Silesia\""], "Silesia", $companyObjects);
                $companyObjects = str_replace(["t's"], "t s", $companyObjects);
                $companyObjects = str_replace(["O'C"], "O C", $companyObjects);
                $companyObjects = str_replace(["\"Oko\""], "Oko", $companyObjects);
                $companyObjects = str_replace(["\"Plan\""], "Plan", $companyObjects);
                $companyObjects = str_replace(["\"Syrena\""], "Syrena", $companyObjects);
                $companyObjects = str_replace(["\"Iluzjon\""], "Iluzjon", $companyObjects);
                $companyObjects = str_replace(["i'n"], "i n", $companyObjects);


                $companyObjects = str_replace(["'"], "\"", $companyObjects);
                echo "\n company objects dopo str replace:\n";
                var_dump($companyObjects);


                /* $companyObjects = Encoding::fixUTF8($companyObjects);
                echo "\n company objects dopo utf8 encode:\n";
                var_dump($companyObjects); */ 



                $companyObjects = json_decode($companyObjects);
                

                echo "\n company objects dopo:\n";
                var_dump($companyObjects);


                foreach ($companyObjects as $companyObject) {
                    
                    $company_id = $companyObject->id ?? NULL;
                    $company_name = $companyObject->name ?? NULL;
                    
                    //if id or name doesn't exist, go to next iteration 
                    if ($company_id == NULL || $company_name == NULL) {
                        $index++;
                        continue;
                    }
    
                    $index++;

                    //Loading bar to be saw in bash
                    // ==========> 100% Completed.
                    $percentage = ($index/45430)*100;
    
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
    
                    //if company is already in the table, save relationship and go to next iteration
                    if (DB::table('companies')->where('id', $company_id)->exists()) {
                        
                        if (!DB::table('company_movie')->where('company_id', $company_id)->where('movie_id', $lineValues[5])->exists()) {

                            $company = company::find($company_id);
                            $movie = Movie::find($lineValues[5]);

                            $company->getMovies()->attach($movie); //insert relationship with movie id in company_movie table
                        }
                        continue;
                    }
    
                    //if company isn't in the table yet, add it
                    $q_insertcompany = "INSERT INTO companies VALUES(?, ?)";
    
                    DB::statement($q_insertcompany, [
                        $company_id,
                        $company_name
                    ]);

                    if (!DB::table('company_movie')->where('company_id', $company_id)->where('movie_id', $lineValues[5])->exists()) {

                        $company = Company::find($company_id);
                        $movie = Movie::find($lineValues[5]);

                        //$company->getMovies()->attach($movie); //insert relationship with movie id in company_movie table
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
