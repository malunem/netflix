<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordMovieTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE keyword_movie (
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
        Schema::dropIfExists('keyword_movie');
    }
}
