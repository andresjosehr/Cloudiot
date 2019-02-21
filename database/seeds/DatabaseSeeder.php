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
            'name' => "Demo Electronico",
            'email' => 'DemoElectronico',
            'password' => bcrypt('ils8fsd5twm2'),
            'rol' => "2"
        ]);

    }
}
