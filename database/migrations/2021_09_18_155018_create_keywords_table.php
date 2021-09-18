<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
    public function up()
    {
        $q_createTable = "CREATE TABLE keywords (
            id INT NOT NULL,
            keyword VARCHAR(50) NOT NULL,
            PRIMARY KEY(id)
        )";

        DB::statement($q_createTable);
    }

    public function down()
    {
        Schema::dropIfExists('keywords');
    }
}
