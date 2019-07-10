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
       //      'name' => "fiacobelli",
       //      'email' => 'fiacobelli@maitenal.cl',
       //      'password' => bcrypt('fiacobelli'),
       //      'rol' => "1"
       //  ]);

       DB::table('instalaciones_asignadas')->insert([
            'id_usuario' => 22,
            'id_instalacion' => 5,
            'rol' => "1"
        ]);

    }
}
