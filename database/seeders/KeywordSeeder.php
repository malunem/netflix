<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Keyword;
use ForceUTF8\Encoding;
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
                
                echo "\n\n\n$index\n";
                var_dump($lineValues);
                
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

                $wrongs = ["d'I", "D'P", "n' M", "r's", "l'A", "l's",
                    
                    "n' G", "'58", "''Babelsberg''", "\"Das Kleine Fernsehspiel\"", "l'n", "l'm", "L'i", "h't", "'N'", "O'B", "s' S", "O' S", "\"Luch\"", "I'm", "'Konrad Wolf'", "\xa0", "n's", "l'A", "d'm", '\xa0', "\"Weltfilm\"", "n' F", "We're", "\"Orlenok\"", "n' R", "O' G", "f's", "O'H", "d'H", "k'd", "d'i", "''Futurum''", "L'e", "''Berlin''", "\"Tsar\"", "s'i", "\"Kvadrat\"", "n' W", "a'a", "\"Zespoly Filmowe\"", "'n'", "N' C", "u's", "L'E", "l't", "\"F.A.F\"", "'A'", "l 'E", "n' D",

                    "D'I", "e's", "s' m", "s' l", "d'e", "d'a", "a's", "s' s", "s' b", "o'h", "m's", "s' q", "h's", "s' ", "u'v", "i's", "'s ", "a'u", "\"trudy jackson\"", "'comfort women'"
                ];

                $rights = ["d I", "D P", "n M", "r s", "l A", "l s",
                    
                    "n G", "58", "Babelsberg", "Das Kleine Fernsehspiel", "l n", "l m", "L i", "h t", "N", "O B", "s S", "O S", "Luch", "I m", "Konrad Wolf", "", "n s", "l A", "d m", "", "Weltfilm", "n F", "We re", "Orlenok", "n R", "O G", "f s", "O H", "d H", "k d", "d i", "Futurm", "L e", "Berlin", "Tsar", "s i", "Kvadrat", "n W", "a a", "Zespoly Filmowe", "n", "N C", "u s", "L E", "l t", "F.A.F", "A", "l  E", "n D",

                    "D I", "e s", "s m", "s l", "d e", "d a", "a s", "s s", "s b", "o h", "m s", "s q", "h s", "s ", "u v", "i s", "s ", "a u", "trudy jackson", "comfort women"
                ];
                
                
                $keywordObjects = str_replace(["o' B"], "o B", $keywordObjects);
                $keywordObjects = str_replace(["l'E"], "l E", $keywordObjects);
                $keywordObjects = str_replace(["l'o"], "l o", $keywordObjects);
                $keywordObjects = str_replace(["w's"], "w s", $keywordObjects);
                $keywordObjects = str_replace(["\"Tor\""], "Tor", $keywordObjects);
                $keywordObjects = str_replace(["c's"], "c s", $keywordObjects);
                $keywordObjects = str_replace(["v'e"], "v e", $keywordObjects);
                $keywordObjects = str_replace(["d'é"], "d é", $keywordObjects);
                $keywordObjects = str_replace(["D'A"], "D A", $keywordObjects);
                $keywordObjects = str_replace(["D'O"], "D O", $keywordObjects);
                $keywordObjects = str_replace(["n's"], "n s", $keywordObjects);
                $keywordObjects = str_replace(["a '8"], "a 8", $keywordObjects);
                $keywordObjects = str_replace(["i'a"], "i a", $keywordObjects);
                $keywordObjects = str_replace(["t '9"], "t 9", $keywordObjects);
                $keywordObjects = str_replace(["d'A"], "d A", $keywordObjects);
                $keywordObjects = str_replace(["s' C"], "s C", $keywordObjects);
                $keywordObjects = str_replace(["k's"], "k s", $keywordObjects);
                $keywordObjects = str_replace(["\"A\""], "A", $keywordObjects);
                $keywordObjects = str_replace(["n't"], "n t", $keywordObjects);
                $keywordObjects = str_replace(["s' W"], "s W", $keywordObjects);
                $keywordObjects = str_replace(["L'O"], "L O", $keywordObjects);
                $keywordObjects = str_replace(["d's"], "d s", $keywordObjects);
                $keywordObjects = str_replace(["l'I"], "l I", $keywordObjects);
                $keywordObjects = str_replace(["y's"], "y s", $keywordObjects);
                $keywordObjects = str_replace(["\"X\""], "X", $keywordObjects);
                $keywordObjects = str_replace(["\"Perspektywa\"", "\"Perspektywa"], "Perspektywa", $keywordObjects);
                $keywordObjects = str_replace(["d'E"], "d E", $keywordObjects);
                $keywordObjects = str_replace(["\"Kadr\""], "Kadr", $keywordObjects);
                $keywordObjects = str_replace(["e's"], "e s", $keywordObjects);
                $keywordObjects = str_replace(["\"DIA\""], "DIA", $keywordObjects);
                $keywordObjects = str_replace(["P'A"], "P A", $keywordObjects);
                $keywordObjects = str_replace(["l'i"], "l i", $keywordObjects);
                $keywordObjects = str_replace(["\"Johannisthal\""], "Johannisthal", $keywordObjects);
                $keywordObjects = str_replace(["\"Kamera\""], "Kamera", $keywordObjects);
                $keywordObjects = str_replace(["s' R"], "s R", $keywordObjects);
                $keywordObjects = str_replace(["\"Zespol Filmowy\""], "Zespol Filmowy", $keywordObjects);
                $keywordObjects = str_replace(["g's"], "g s", $keywordObjects);
                $keywordObjects = str_replace(["L'I"], "L I", $keywordObjects);
                $keywordObjects = str_replace(["''Mosfilm''"], "Mosfilm", $keywordObjects);
                $keywordObjects = str_replace(["\"Pryzmat\""], "Pryzmat", $keywordObjects);
                $keywordObjects = str_replace(["n' P"], "n P", $keywordObjects);
                $keywordObjects = str_replace(["L'A"], "L A", $keywordObjects);
                $keywordObjects = str_replace(["d'O"], "d O", $keywordObjects);
                $keywordObjects = str_replace(["\"Silesia\""], "Silesia", $keywordObjects);
                $keywordObjects = str_replace(["t's"], "t s", $keywordObjects);
                $keywordObjects = str_replace(["O'C"], "O C", $keywordObjects);
                $keywordObjects = str_replace(["\"Oko\""], "Oko", $keywordObjects);
                $keywordObjects = str_replace(["\"Plan\""], "Plan", $keywordObjects);
                $keywordObjects = str_replace(["\"Syrena\""], "Syrena", $keywordObjects);
                $keywordObjects = str_replace(["\"Iluzjon\""], "Iluzjon", $keywordObjects);
                $keywordObjects = str_replace(["i'n"], "i n", $keywordObjects);
                $keywordObjects = str_replace(["l'O"], "l O", $keywordObjects);

                $keywordObjects = str_replace($wrongs, $rights, $keywordObjects);

                echo "\n dopo sostituzioni\n";
                var_dump($keywordObjects);

                $keywordObjects = Encoding::fixUTF8($keywordObjects);
                echo "\n company objects dopo utf8 encode:\n";
                var_dump($keywordObjects); 


                $keywordObjects = json_decode(str_replace("'", "\"", $keywordObjects));

                echo "\n dopo json decode\n";
                var_dump($keywordObjects);

                foreach ($keywordObjects as $keywordObject) {

                    echo "foreach keyword object\n";
                    var_dump($keywordObject);
                    
                    $keyword_id = $keywordObject->id ?? NULL;
                    $keyword_name = $keywordObject->name ?? NULL;
                    
                    echo "values:\n";
                    var_dump($keyword_id, $keyword_name);

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
                        
                        if (!DB::table('keyword_movie')->where('keyword_id', $keyword_id)->where('movie_id', $lineValues[0])->exists()) {

                            $keyword = Keyword::find($keyword_id);
                            $movie = Movie::find($lineValues[0]);

                            //echo "\nfind result:\n";
                            //var_dump($keyword);

                            $keyword->getMovies()->attach($movie); //insert relationship with movie id in keyword_movie table

                            echo "\ninserito\n";
                        }

                        continue;
                    }
    
                    //if keyword isn't in the table yet, add it
                    $q_insertkeyword = "INSERT INTO keywords VALUES(?, ?)";
    
                    DB::statement($q_insertkeyword, [
                        $keyword_id,
                        $keyword_name
                    ]);

                    //$keyword_id = Keyword::where('id', $keyword_id)->get('id');

                    if (!DB::table('keyword_movie')->where('keyword_id', $keyword_id)->where('movie_id', $lineValues[0])->exists()) {

                        $keyword = Keyword::find($keyword_id);
                        $movie = Movie::find($lineValues[0]);

                        var_dump($keyword);
                        echo "qua\n";

                        $keyword->getMovies()->attach($movie); //insert relationship with movie id in keyword_movie table

                        echo "inserito\n";
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
