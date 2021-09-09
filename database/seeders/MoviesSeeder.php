<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                    require_once 'database/migrations/login.php';

                    try {
                        $pdo = new PDO($attr, $user, $pass, $opts);
                    } catch (PDOException $e) {
                        throw new PDOException($e->getMessage(), (int)$e->getCode());
                    }
                    $index++;
                    continue;
                }

                //var_dump($lineValues);   

                //SQL FUNCTIONS (TEMPORARILY HERE, THEN TO MOVE ELSEWHERE)

                $percentage = ($index/45575)*100;

                static $actual = 0;
                
                if ($percentage-$actual >= 10) {
                    echo "=";
                    $actual = $percentage;
                }

                $completed = false;

                if ($percentage >= 99 && $completed == false) {
                    echo "> 100% completed.\n";
                    $completed = true;
                }

                //echo "$percentage% - iterazione n°$index di 45.572 - id film: $lineValues[5]\n";

                $index++;

                if (Movie::find($lineValues[5]) != NULL || sizeof($lineValues) < 20) {
                    continue;
                }


                /* if ($index >= 19730) {
                    var_dump($lineValues);
                } */

                $q_insertMovie = "INSERT INTO movies VALUES(?, ?, ?, ?)";
                $stmt = $pdo->prepare($q_insertMovie);
                $stmt->execute([
                    $lineValues[5], //id
                    $lineValues[20], //title
                    $lineValues[9], //overview
                    (($lineValues[14] == '') ? NULL : $lineValues[14]), //release date
                ]);

                //echo "completed\n\n";

                //END SQL FUNCTIONS

                if ($index == 11){
                    break;
                }
            }
        };
        fclose($handle);
    }
}
