<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('series')->insert([
            // usuario 3
            // Entrenamiento 1- Ejercicio 1 press banca
            [
                'number' => 1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:00:00',
                'used_weight' => 80,
                'repetitions' => 8
            ],
            [
                'number' => 2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:05:00',
                'used_weight' => 80,
                'repetitions' => 7
            ],
            [
                'number' => 3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:10:00',
                'used_weight' => 80,
                'repetitions' => 6
            ],
            // Entrenamiento 1- Ejercicio 2 peso muerto 
            [
                'number' => 1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:15:00',
                'used_weight' => 120,
                'repetitions' => 8
            ],
            [
                'number' => 2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:20:00',
                'used_weight' => 120,
                'repetitions' => 7
            ],
            [
                'number' => 3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:25:00',
                'used_weight' => 120,
                'repetitions' => 6
            ],
            // Entrenamiento 1- Ejercicio 3 abdominales 
            [
                'number' => 1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:15:00',
                'used_weight' => 120,
                'repetitions' => 8
            ],
            [
                'number' => 2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:20:00',
                'used_weight' => 120,
                'repetitions' => 7
            ],
            [
                'number' => 3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:25:00',
                'used_weight' => 120,
                'repetitions' => 6
            ],/*
            // Entrenamiento 2- Ejercicio 1 sentadilla
            [
                'number'=>1,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 2,
                'date' => '2023-01-02 08:00:00',
                'used_weight' => 140,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 2,
                'date' => '2023-01-02 08:05:00',
                'used_weight' => 140,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 2,
                'date' => '2023-01-02 08:10:00',
                'used_weight' => 140,
                'repetitions' => 6
            ],
            // Entrenamiento 2- Ejercicio 2 prensa
            [
                'number'=>1,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 6,
                'date' => '2023-01-02 08:15:00',
                'used_weight' => 120,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 6,
                'date' => '2023-01-02 08:20:00',
                'used_weight' => 120,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 6,
                'date' => '2023-01-02 08:25:00',
                'used_weight' => 120,
                'repetitions' => 6
            ],
            // Entrenamiento 2- Ejercicio 3 zancadas 
            [
                'number'=>1,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 8,
                'date' => '2023-01-02 08:15:00',
                'used_weight' => 40,
                'repetitions' => 18
            ],
            [
                'number'=>2,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 8,
                'date' => '2023-01-02 08:20:00',
                'used_weight' => 40,
                'repetitions' => 15
            ], 
            [
                'number'=>3,
                'workout_id' => 2,
                'user_id' => 3,
                'exercise_id' => 8,
                'date' => '2023-01-02 08:25:00',
                'used_weight' => 40,
                'repetitions' => 12
            ],
            // usuario 4
            // entrenamiento 3 ejercicio dominadas
            [
                'number'=>1,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 3,
                'date' => '2023-01-03 09:15:00',
                'used_weight' => 80,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 3,
                'date' => '2023-01-03 09:20:00',
                'used_weight' => 80,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 3,
                'date' => '2023-01-03 09:25:00',
                'used_weight' => 80,
                'repetitions' => 6
            ],
            // entrenamiento 3 ejercicio remo mancuerna
            [
                'number'=>1,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 5,
                'date' => '2023-01-03 09:30:00',
                'used_weight' => 30,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 5,
                'date' => '2023-01-03 09:35:00',
                'used_weight' => 30,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 5,
                'date' => '2023-01-03 09:40:00',
                'used_weight' => 30,
                'repetitions' => 6
            ],
            // entrenamiento 3 ejercicio peso muerto
            [
                'number'=>1,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-01-03 09:45:00',
                'used_weight' => 130,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 3,
                'user_id' =>4,
                'exercise_id' => 4,
                'date' => '2023-01-03 09:50:00',
                'used_weight' => 130,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 3,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-01-03 09:55:00',
                'used_weight' => 130,
                'repetitions' => 6
            ], */
        ]);
    }
}
