<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $q_createTable = "CREATE TABLE ratings (
            id BIGINT NOT NULL AUTO_INCREMENT,
            user_id INT NOT NULL,
            movie_id BIGINT NOT NULL,
            rating FLOAT NOT NULL,
            PRIMARY KEY(id),
            FOREIGN KEY(movie_id) REFERENCES Movies(id) ON DELETE CASCADE
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
        Schema::dropIfExists('ratings');
    }
}
