<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscriptions')->insert([
            [
                'start_date' => '2023-01-01', // 'inicio' 
                'end_date' => DB::raw("DATE_ADD('2023-01-01', INTERVAL 1 MONTH)"), // 'fin' 
                'user_id' => 2, // 'id_usuario' 
                'paid' => true, // 'pagado'
                'renew' => true // 'renovar' 
            ],
            
        ]);
    }
}
