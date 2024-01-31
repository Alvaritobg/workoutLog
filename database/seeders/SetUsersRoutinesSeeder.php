<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SetUsersRoutinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')
        ->where('id', 3)
        ->update(['routine_id' => 3]);

        DB::table('users')
          ->where('id', 4)
          ->update(['routine_id' => 3]);
    }
}
