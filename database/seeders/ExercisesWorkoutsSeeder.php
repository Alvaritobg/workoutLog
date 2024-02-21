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
            // entrenamiento del usuario 3
            ['workout_id' => 1, 'exercise_id' => 1, 'order' => 1],
            ['workout_id' => 1, 'exercise_id' => 4, 'order' => 2],
            ['workout_id' => 1, 'exercise_id' => 7, 'order' => 3],
            // entrenamiento del usuario 3
            ['workout_id' => 2, 'exercise_id' => 2, 'order' => 1],
            ['workout_id' => 2, 'exercise_id' => 6, 'order' => 2],
            ['workout_id' => 2, 'exercise_id' => 8, 'order' => 3],
            // entrenamiento del usuario 4
            ['workout_id' => 3, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 3, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 3, 'exercise_id' => 4, 'order' => 3],
            // entrenamiento del usuario 4
            /*
            ['workout_id' => 4, 'exercise_id' => 3, 'order' => 1],
            ['workout_id' => 4, 'exercise_id' => 5, 'order' => 2],
            ['workout_id' => 4, 'exercise_id' => 4, 'order' => 3], */
         
        ]);
    }
}
