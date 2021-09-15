<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Play extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "ciao\n";

        /* $this->call('migrate:fresh');
        $this->call('db:seed'); */

        //inserire solo le tabelle nuove per i test
        $this->call('migrate:rollback'); //rollback only last migration
        $this->call('migrate');
        //a mano php artisan migrate --path=database/migrations/2021_09_15_200251_create_genres_table
        //DA FARE A MANO php artisan db:seed --class=GenreSeeder
    }
}
