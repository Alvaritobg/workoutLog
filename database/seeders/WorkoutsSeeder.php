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
            // Entrenamiento
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

        ]);
    }
}
