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
       // DB::table('users')->insert([
       //      'name' => "rconcha@biofiltro.com",
       //      'email' => 'Biofiltro',
       //      'password' => bcrypt('Biofiltro2019'),
       //  ]);








       DB::table('users')->insert([
            'name' => "Demo",
            'email' => 'demo',
            'password' => bcrypt('l8qao58u5ss'),
            'rol' => "4"
        ]);
    }
}
