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
                'days' => 5,
                'duration'=>8,
                'img'=>'https://cdn.pixabay.com/photo/2016/03/27/07/08/man-1282232_1280.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de cardio',
                'description' => 'Rutina para mejorar la resistencia cardiovascular.',
                'days' => 3,
                'duration'=>6,
                'img'=>'https://cdn.pixabay.com/photo/2017/04/27/08/29/man-2264825_1280.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de hipertrofia',
                'description' => 'Rutina para desarrollar masa muscular.',
                'days' => 6,
                'duration'=>7,
                'img'=>'https://cdn.pixabay.com/photo/2015/07/02/10/22/training-828726_1280.jpg',
            ],
        ]);
    }
}
