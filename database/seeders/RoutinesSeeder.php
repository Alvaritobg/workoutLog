<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoutinesSeeder extends Seeder
{
    /**
    * Ejecuta las operaciones de sembrado de la base de datos.
    *
    * @return void
    */
    public function run(): void
    {
        DB::table('routines')->insert([
            [
                'user_id' => 4, 
                'name' => 'Rutina de fuerza', 
                'description' => 'Rutina para desarrollar fuerza muscular.'
            ],
            [
                'user_id' => 4,
                'name' => 'Rutina de cardio',
                'description' => 'Rutina para mejorar la resistencia cardiovascular.'
            ],
            [
                'user_id' => 4,
                'name' => 'Rutina de hipertrofia',
                'description' => 'Rutina para desarrollar masa muscular.'
            ],
        ]);
    }
}
