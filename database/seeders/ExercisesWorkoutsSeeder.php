<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExercisesWorkoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('exercises_workouts')->insert([

            //  ++ Ejercicios de la rutina de fuerza ++
            // Ejercicios del  día 1 - Rutina fuerza
            ['workout_id' => 1, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 1, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 1, 'exercise_id' => 7, 'order' => 3],
            // Ejercicios del  día 2 - Rutina fuerza - Rutina fuerza
            ['workout_id' => 2, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 2, 'exercise_id' => 6, 'order' => 2],
            ['workout_id' => 2, 'exercise_id' => 8, 'order' => 3],
            // Ejercicios del  día 3 - Rutina fuerza
            ['workout_id' => 3, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 3, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 3, 'exercise_id' => 4, 'order' => 3],
            // Ejercicios del  día 4 - Rutina fuerza 
            ['workout_id' => 4, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 4, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 4, 'exercise_id' => 4, 'order' => 3],

            //  ++ Ejercicios de la rutina de Torso-pierna ++
            // Ejercicios del  día 1 - Rutina Torso pierna 
            ['workout_id' => 5, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 5, 'exercise_id' => 3, 'order' => 2],
            ['workout_id' => 5, 'exercise_id' => 5, 'order' => 3],
            // Ejercicios del  día 2 - Rutina Torso pierna 
            ['workout_id' => 6, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 6, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 6, 'exercise_id' => 8, 'order' => 3],
            // Ejercicios del  día 3 - Rutina Torso pierna 
            ['workout_id' => 7, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 7, 'exercise_id' => 3, 'order' => 2],
            ['workout_id' => 7, 'exercise_id' => 5, 'order' => 3],
            // Ejercicios del  día 4 - Rutina Torso pierna 
            ['workout_id' => 8, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 8, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 8, 'exercise_id' => 8, 'order' => 3],

            //  ++ Ejercicios de la Rutina de cardio ++
            // Ejercicios del  día 1 - Rutina de cardio 
            ['workout_id' => 9, 'exercise_id' => 16, 'order' => 1],
            ['workout_id' => 9, 'exercise_id' => 10, 'order' => 2],
            ['workout_id' => 9, 'exercise_id' => 15, 'order' => 3],
            // Ejercicios del  día 2 - Rutina de cardio 
            ['workout_id' => 10, 'exercise_id' => 16, 'order' => 1],
            ['workout_id' => 10, 'exercise_id' => 10, 'order' => 2],
            ['workout_id' => 10, 'exercise_id' => 7, 'order' => 3],
            // Ejercicios del  día 3 - Rutina de cardio 
            ['workout_id' => 11, 'exercise_id' => 16, 'order' => 1],
            ['workout_id' => 11, 'exercise_id' => 10, 'order' => 2],
            ['workout_id' => 11, 'exercise_id' => 9, 'order' => 3],


            //  ++ Ejercicios de la Rutina de hipertrofia ++
            // Ejercicios del  día 1 - Rutina de hipertrofia 
            ['workout_id' => 12, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 12, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 12, 'exercise_id' => 15, 'order' => 3],
            // Ejercicios del  día 2 - Rutina de hipertrofia 
            ['workout_id' => 13, 'exercise_id' => 9, 'order' => 1],
            ['workout_id' => 13, 'exercise_id' => 11, 'order' => 2],
            ['workout_id' => 13, 'exercise_id' => 1, 'order' => 3],
            // Ejercicios del  día 3 - Rutina de hipertrofia 
            ['workout_id' => 14, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 14, 'exercise_id' => 6, 'order' => 2],
            ['workout_id' => 14, 'exercise_id' => 8, 'order' => 3],
            // Ejercicios del  día 4 - Rutina de hipertrofia 
            ['workout_id' => 15, 'exercise_id' => 12, 'order' => 1],
            ['workout_id' => 15, 'exercise_id' => 11, 'order' => 2],
            ['workout_id' => 15, 'exercise_id' => 13, 'order' => 3],
            // Ejercicios del  día 5 - Rutina de hipertrofia 
            ['workout_id' => 16, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 16, 'exercise_id' => 2, 'order' => 2],
            ['workout_id' => 16, 'exercise_id' => 7, 'order' => 3],
        ]);
    }
}
