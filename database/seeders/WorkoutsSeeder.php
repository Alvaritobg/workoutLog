<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class WorkoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workouts')->insert([
            // Entrenamientos Rutina de fuerza
            [
                'name' => 'Entrenamiento 1 | Rutina de fuerza',
                'routine_id' => 1,
                'order' => 1
            ],
            [
                'name' => 'Entrenamiento 2 | Rutina de fuerza',
                'routine_id' => 1,
                'order' => 2
            ],
            [
                'name' => 'Entrenamiento 3 | Rutina de fuerza',
                'routine_id' => 1,
                'order' => 3
            ],
            [
                'name' => 'Entrenamiento 4 | Rutina de fuerza',
                'routine_id' => 1,
                'order' => 4
            ],
            // Entrenamientos torso pierna
            [
                'name' => 'Entrenamiento 1 | Rutina torso pierna',
                'routine_id' => 4,
                'order' => 1
            ],
            [
                'name' => 'Entrenamiento 2 | Rutina torso pierna',
                'routine_id' => 4,
                'order' => 2
            ],
            [
                'name' => 'Entrenamiento 3 | Rutina torso pierna',
                'routine_id' => 4,
                'order' => 3
            ],
            [
                'name' => 'Entrenamiento 4 | Rutina torso pierna',
                'routine_id' => 4,
                'order' => 4
            ],
            // Entrenamientos cardio
            [
                'name' => 'Entrenamiento 1 | Rutina cardio',
                'routine_id' => 2,
                'order' => 1
            ],
            [
                'name' => 'Entrenamiento 2 | Rutina cardio',
                'routine_id' => 2,
                'order' => 2
            ],
            [
                'name' => 'Entrenamiento 3 | Rutina cardio',
                'routine_id' => 2,
                'order' => 3
            ],
            // Entrenamientos hipertrofia
            [
                'name' => 'Entrenamiento 1 | Entrenamientos hipertrofia',
                'routine_id' => 3,
                'order' => 1
            ],
            [
                'name' => 'Entrenamiento 2 | Entrenamientos hipertrofia',
                'routine_id' => 3,
                'order' => 2
            ],
            [
                'name' => 'Entrenamiento 3 | Entrenamientos hipertrofia',
                'routine_id' => 3,
                'order' => 3
            ],
            [
                'name' => 'Entrenamiento 4 | Entrenamientos hipertrofia',
                'routine_id' => 3,
                'order' => 4
            ],
            [
                'name' => 'Entrenamiento 5 | Entrenamientos hipertrofia',
                'routine_id' => 3,
                'order' => 5
            ],

        ]);
    }
}