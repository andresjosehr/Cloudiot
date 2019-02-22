<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // php artisan db:seed
    public function run()
    {


       DB::table('users')->insert([
            'name' => "Sicut Ignis",
            'email' => 'SicutIgnis',
            'password' => bcrypt('Sicut2019'),
            'rol' => "2"
        ]);

    }
}
