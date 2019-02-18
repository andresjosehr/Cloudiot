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
            'name' => "prueba",
            'email' => 'prueba',
            'password' => bcrypt('l8qao58u5ss'),
            'rol' => "2"
        ]);
    }
}
