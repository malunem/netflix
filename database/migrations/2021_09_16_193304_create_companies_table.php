<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE companies (
            id INT NOT NULL,
            company VARCHAR(110) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('companies');
    }
}
