<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoutinesSeeder extends Seeder
{
    /**
    * Ejecuta las operaciones de sembrado de la base de datos.
    *
    * @return void
    */
    public function run(): void
    {
        DB::table('routines')->insert([
            [
                'user_id' => 2, 
                'name' => 'Rutina de fuerza', 
                'description' => 'Rutina para desarrollar fuerza muscular.',
                'img'=>'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de cardio',
                'description' => 'Rutina para mejorar la resistencia cardiovascular.',
                'img'=>'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
            [
                'user_id' => 2,
                'name' => 'Rutina de hipertrofia',
                'description' => 'Rutina para desarrollar masa muscular.',
                'img'=>'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            ],
        ]);
    }
}
