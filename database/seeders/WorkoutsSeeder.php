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
            [
                'name' => 'Entrenamiento 1', 
                'routine_id' => 1, 
                'order' => 1 
            ],
            [
                'name' => 'Entrenamiento 2',
                'routine_id' => 1,
                'order' => 2
            ],
            [
                'name' => 'Entrenamiento 1',
                'routine_id' => 1,
                'order' => 1
            ],
            [
                'name' => 'Entrenamiento 2',
                'routine_id' => 1,
                'order' => 2
            ],
            
        ]);
    }
}
