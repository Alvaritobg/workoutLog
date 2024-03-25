<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UsersWorkoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users_workouts')->insert([
            // el usuario 4 realiza el entrenamiento 12 (hipertrofia routine_id 4) en la fecha '2023-01-01 08:05:00'
            // primera semana
            ['workout_id' => 12, 'user_id' => 4, 'execution_date' => '2023-01-01 08:05:00'],
            ['workout_id' => 13, 'user_id' => 4, 'execution_date' => '2023-02-02 08:05:00'],
            ['workout_id' => 14, 'user_id' => 4, 'execution_date' => '2023-03-03 08:05:00'],
            ['workout_id' => 15, 'user_id' => 4, 'execution_date' => '2023-04-04 08:05:00'],
            ['workout_id' => 16, 'user_id' => 4, 'execution_date' => '2023-05-05 08:05:00'],
            // segunda semana
            ['workout_id' => 12, 'user_id' => 4, 'execution_date' => '2023-06-06 08:05:00'],
            ['workout_id' => 13, 'user_id' => 4, 'execution_date' => '2023-07-07 08:05:00'],
            //['workout_id' => 15, 'user_id' => 4, 'execution_date' => '2023-08-08 08:05:00'],
        ]);
    }
}
