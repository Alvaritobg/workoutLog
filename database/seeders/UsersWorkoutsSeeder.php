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
            ['workout_id' => 1, 'user_id' => 3, 'execution_date' => '2023-01-01 08:05:00'],
            ['workout_id' => 2, 'user_id' => 3, 'execution_date' => '2023-01-02 08:10:00'],
            ['workout_id' => 3, 'user_id' => 3, 'execution_date' => '2023-01-03 09:15:00'],
            ['workout_id' => 4, 'user_id' => 4, 'execution_date' => '2023-02-02 08:00:00']
        ]);
    }
}
