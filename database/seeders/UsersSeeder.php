<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UsersSeeder extends Seeder
{
    /**
     * Añade datos de prueba a la tabla exercises
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'routine_id' => null,
                'name' => 'Álvaro',
                'surname' => 'Bañón García', 
                'date_of_birth' => '1989-08-20', 
                'email' => 'admin@example.com',
                'weight' => 92,
                'password' => bcrypt('12345678'),    
            ],
            [
                'routine_id' => null,
                'name' => 'Julia',
                'surname' => 'Perez', 
                'date_of_birth' => '2000-04-16', 
                'email' => 'trainer1@example.com',
                'weight' => 73,
                'password' => bcrypt('12345678'),    
            ],
            [
                'routine_id' => null,
                'name' => 'Antonio',
                'surname' => 'Carmona', 
                'date_of_birth' => '1987-03-03', 
                'email' => 'user1@example.com',
                'weight' => 85,
                'password' => bcrypt('12345678'),    
            ],
            [
                'routine_id' => null,
                'name' => 'María',
                'surname' => 'Martin', 
                'date_of_birth' => '1979-05-05', 
                'email' => 'user2@example.com',
                'weight' => 60,
                'password' => bcrypt('12345678'),    
            ],
            
        ]);
    }
}
