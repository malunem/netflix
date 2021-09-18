<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE countries (
            id INT NOT NULL AUTO_INCREMENT,
            short VARCHAR(2) NOT NULL,
            country_name VARCHAR(50) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }
    
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('countries');
    }
}
