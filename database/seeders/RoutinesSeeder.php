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
                'duration' => 8,
                'img' => 'fuerza.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de cardio',
                'description' => 'Rutina para mejorar la resistencia cardiovascular.',
                'days' => 3,
                'duration' => 6,
                'img' => 'cardio.jpg',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de hipertrofia',
                'description' => 'Rutina para desarrollar masa muscular.',
                'days' => 6,
                'duration' => 7,
                'img' => 'hipertrofia.jpg',
            ],
        ]);
    }
}
