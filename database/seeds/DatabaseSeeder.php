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
            'name' => "Rafael Concha",
            'email' => 'rconcha@biofiltro.cl',
            'password' => bcrypt('7TAPAKKRGGaSRBsc'),
            'rol' => "2"
        ]);



       DB::table('users')->insert([
            'name' => " Pablo Lopez",
            'email' => 'plopez@biofiltro.cl',
            'password' => bcrypt('mQETBvgwdhnf7jna'),
            'rol' => "2"
        ]);


       DB::table('users')->insert([
            'name' => "Mauricio Rivera",
            'email' => 'mrivera@biofiltro.cl',
            'password' => bcrypt('EG4zvJJfQ8zP8y7a'),
            'rol' => "2"
        ]);




       DB::table('users')->insert([
            'name' => "Dolores Fernandez",
            'email' => 'dfernandez@biofiltro.cl',
            'password' => bcrypt('VUGNEvXMG3ksMuEf'),
            'rol' => "3"
        ]);

       DB::table('users')->insert([
            'name' => "Teresita Manterola",
            'email' => 'tmanterola@biofiltro.cl',
            'password' => bcrypt('V3Lj7JcUZYMVeDWH'),
            'rol' => "3"
        ]);
    }
}
