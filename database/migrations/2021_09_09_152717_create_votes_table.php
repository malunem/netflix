<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $q_createTable = "CREATE TABLE votes (
            id BIGINT NOT NULL AUTO_INCREMENT,
            vote_average FLOAT NOT NULL,
            vote_count INT NOT NULL,
            movie_id BIGINT NOT NULL,
            PRIMARY KEY(id),
            FOREIGN KEY (movie_id) REFERENCES Movies(id)
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
        Schema::dropIfExists('votes');
    }
}
