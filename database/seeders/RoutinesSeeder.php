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
                'user_id' => 2, 
                'name' => 'Rutina de fuerza', 
                'description' => 'Rutina para desarrollar fuerza muscular.',
                'img'=>'https://images.pexels.com/photos/260352/pexels-photo-260352.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de cardio',
                'description' => 'Rutina para mejorar la resistencia cardiovascular.',
                'img'=>'https://images.pexels.com/photos/260352/pexels-photo-260352.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de hipertrofia',
                'description' => 'Rutina para desarrollar masa muscular.',
                'img'=>'https://images.pexels.com/photos/260352/pexels-photo-260352.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
            ],
        ]);
    }
}
