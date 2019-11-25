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
            'name' => "Welko",
            'email' => 'welko@welkco.com',
            'password' => bcrypt('welko'),
            'rol' => 2
        ]);

       DB::table('instalaciones_asignadas')->insert([
            'id_usuario' => 23,
            'id_instalacion' => 13,
            'rol' => 1
        ]);

    }
}
