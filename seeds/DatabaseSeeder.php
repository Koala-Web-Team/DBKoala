<?php

use Illuminate\Database\Seeder;


use App\Language;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 10)->create();

        factory('App\Language', 5)->create();

        factory('App\Translator', 50)->create();

        factory('App\TranslatorFiles', 20)->create();

        factory('App\Photo', 70)->create();

        factory('App\ClientFiles', 70)->create();

    }
}
