<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieKeywordTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE movie_keyword (
            id INT NOT NULL AUTO_INCREMENT,
            movie_id BIGINT NOT NULL,
            keyword_id INT NOT NULL,
            PRIMARY KEY(id),
            FOREIGN KEY(movie_id) REFERENCES Movies(id) ON DELETE CASCADE,
            FOREIGN KEY(keyword_id) REFERENCES Keywords(id) ON DELETE CASCADE
        )";

        DB::statement($q_createTable);
    }
    
    public function down()
    {
        Schema::dropIfExists('movie_keyword');
    }
}
