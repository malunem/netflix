<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE country (
            id INT NOT NULL,
            country VARCHAR(30) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }
    
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
