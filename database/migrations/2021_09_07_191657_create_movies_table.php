<?php

use App\Models\Movie;
use Illuminate\Support\Facades\DB;
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
        $q_createTable = "CREATE TABLE movies (
            id BIGINT NOT NULL AUTO_INCREMENT,
            title TEXT NOT NULL,
            overview TEXT NOT NULL, 
            release_date DATE,
            language_id BIGINT,
            PRIMARY KEY(id),
            FOREIGN KEY (language_id) REFERENCES Languages(id)
        )";

        DB::statement($q_createTable);
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
