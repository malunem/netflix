<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenresTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE genres (
            id INT NOT NULL,
            genre VARCHAR(20) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }

    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
