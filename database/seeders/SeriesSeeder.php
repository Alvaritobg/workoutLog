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
            [
                'number'=>1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:00:00',
                'used_weight' => 80,
                'repetitions' => 8
            ],
            [
                'number'=>2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:05:00',
                'used_weight' => 80,
                'repetitions' => 7
            ], 
            [
                'number'=>3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:10:00',
                'used_weight' => 80,
                'repetitions' => 6
            ],
            [
                'number'=>4,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 1,
                'date' => '2023-01-01 08:15:00',
                'used_weight' => 80,
                'repetitions' => 5
            ],[
                'number'=>1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:20:00',
                'used_weight' => 120,
                'repetitions' => 10
            ],[
                'number'=>2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:25:00',
                'used_weight' => 120,
                'repetitions' => 9
            ],[
                'number'=>3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:30:00',
                'used_weight' => 120,
                'repetitions' => 8
            ],[
                'number'=>4,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 4,
                'date' => '2023-01-01 08:35:00',
                'used_weight' => 120,
                'repetitions' => 6
            ],[
                'number'=>1,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:40:00',
                'used_weight' => 30,
                'repetitions' => 20
            ],[ // AQUII!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                /// ---------------------------------
                'number'=>2,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:44:00',
                'used_weight' => 30,
                'repetitions' => 19
            ],[
                'number'=>3,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:50:00',
                'used_weight' => 30,
                'repetitions' => 18
            ],[
                'number'=>4,
                'workout_id' => 1,
                'user_id' => 3,
                'exercise_id' => 7,
                'date' => '2023-01-01 08:55:00',
                'used_weight' => 30,
                'repetitions' => 17
            ],
            [
                'number'=>1,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 1,
                'date' => '2023-02-02 08:00:00',
                'used_weight' => 70,
                'repetitions' => 10
            ],[
                'number'=>2,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 1,
                'date' => '2023-02-02 08:05:00',
                'used_weight' => 70,
                'repetitions' => 8
            ],[
                'number'=>3,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 1,
                'date' => '2023-02-02 08:10:00',
                'used_weight' => 70,
                'repetitions' => 7
            ],[
                'number'=>4,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 1,
                'date' => '2023-02-02 08:15:00',
                'used_weight' => 70,
                'repetitions' => 6
            ],
            [
                'number'=>1,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-02-02 08:20:00',
                'used_weight' => 100,
                'repetitions' => 15
            ],[
                'number'=>2,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-02-02 08:25:00',
                'used_weight' => 100,
                'repetitions' => 13
            ],[
                'number'=>3,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-02-02 08:30:00',
                'used_weight' => 100,
                'repetitions' => 10
            ],[
                'number'=>4,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 4,
                'date' => '2023-02-02 08:35:00',
                'used_weight' => 100,
                'repetitions' => 8
            ],
            [//
                'number'=>1,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 7,
                'date' => '2023-02-02 08:40:00',
                'used_weight' => 25,
                'repetitions' => 22
            ],
            [
                'number'=>2,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 7,
                'date' => '2023-02-02 08:44:00',
                'used_weight' => 25,
                'repetitions' => 19
            ],
            [
                'number'=>3,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 7,
                'date' => '2023-02-02 08:50:00',
                'used_weight' => 25,
                'repetitions' => 18
            ],
            [
                'number'=>4,
                'workout_id' => 4,
                'user_id' => 4,
                'exercise_id' => 7,
                'date' => '2023-02-02 08:55:00',
                'used_weight' => 25,
                'repetitions' => 16
            ],
        ]);
    }
}
