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
            // el usuario 3 realiza el entrenamiento 1 (día 1 de fuerza) en la fecha '2023-01-01 08:05:00'
            ['workout_id' => 1, 'user_id' => 3, 'execution_date' => '2023-01-01 08:05:00'],
            // el usuario 4 realiza el entrenamiento 1 (día 1 de fuerza) en la fecha '2023-01-02 08:05:00'
            //['workout_id' => 1, 'user_id' => 4, 'execution_date' => '2023-01-02 08:10:00'],


        ]);
    }
}
