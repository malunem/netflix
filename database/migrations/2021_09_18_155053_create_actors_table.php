<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorsTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE actors (
            id INT NOT NULL,
            actor VARCHAR(50) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }
    
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('actors');
    }
}
