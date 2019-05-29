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
       //      'name' => "Patricio",
       //      'email' => 'Patricio.pinilla@finning.com',
       //      'password' => bcrypt('Patricio2019'),
       //      'rol' => "2"
       //  ]);

       DB::table('instalaciones_asignadas')->insert([
            'id_usuario' => 21,
            'id_instalacion' => 6,
            'rol' => "2"
        ]);

    }
}
