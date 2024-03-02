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
            //-----------------    Usuario 3    -----------------

            // entrenamiento 1 del usuario 3 - Rutina fuerza
            ['workout_id' => 1, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 1, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 1, 'exercise_id' => 7, 'order' => 3],
            // entrenamiento 2 del usuario 3 - Rutina fuerza
            ['workout_id' => 2, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 2, 'exercise_id' => 6, 'order' => 2],
            ['workout_id' => 2, 'exercise_id' => 8, 'order' => 3],
            // entrenamiento 3 del usuario 3 - - Rutina fuerza
            ['workout_id' => 3, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 3, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 3, 'exercise_id' => 4, 'order' => 3],
            // entrenamiento 4  del usuario 3  - Rutina fuerza
            ['workout_id' => 4, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 4, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 4, 'exercise_id' => 4, 'order' => 3],
            // primera semana (repetir otra semana)

            //-----------------    Usuario 4    -----------------

            // Entrenamiento 1 del usuario 4 - Rutina Torso pierna
            ['workout_id' => 5, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 5, 'exercise_id' => 3, 'order' => 2],
            ['workout_id' => 5, 'exercise_id' => 5, 'order' => 3],
            // Entrenamiento 2 del usuario 4 - Rutina Torso pierna
            ['workout_id' => 6, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 6, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 6, 'exercise_id' => 8, 'order' => 3],
            // Entrenamiento 3 del usuario 4 - Rutina Torso pierna
            ['workout_id' => 7, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 7, 'exercise_id' => 3, 'order' => 2],
            ['workout_id' => 7, 'exercise_id' => 5, 'order' => 3],
            // entrenamiento 4  del usuario 4  - Rutina fuerza
            ['workout_id' => 8, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 8, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 8, 'exercise_id' => 8, 'order' => 3],
            // primera semana (repetir otra semana)
        ]);
    }
}
