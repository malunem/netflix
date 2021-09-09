<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //SQL FUNCTIONS (TEMPORARILY HERE, THEN TO MOVE ELSEWHERE)
        require_once 'database/migrations/login.php';

        try {
            $pdo = new PDO($attr, $user, $pass, $opts);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

        $q_createTable = "CREATE TABLE movies (
            id BIGINT NOT NULL AUTO_INCREMENT,
            title TEXT NOT NULL,
            overview TEXT NOT NULL, 
            release_date DATE,
            PRIMARY KEY(id)
        )";

        $table = $pdo->query($q_createTable);

        //END SQL FUNCTIONS

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

                /* if ($index == 11){
                    break;
                } */
            }
        };
        fclose($handle);


        // DB::insert 
        //view book page264

        //at the end move this code to a seeder (view https://laravel.com/docs/8.x/seeding)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
