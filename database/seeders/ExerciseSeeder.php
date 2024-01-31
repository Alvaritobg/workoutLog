<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Añade datos de prueba a la tabla exercises
     *
     * @return void
     */
    public function run()
    {
        DB::table('exercises')->insert([
            ['max_reps_desired' => 10, 'min_reps_desired' => 5, 'name' => 'Press de banca', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer el pecho.'],
            ['max_reps_desired' => 8, 'min_reps_desired' => 4, 'name' => 'Sentadilla', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer las piernas.'],
            ['max_reps_desired' => 12, 'min_reps_desired' => 6, 'name' => 'Dominadas', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 8, 'name' => 'Peso muerto', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer las piernas y la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 12, 'name' => 'Remo mancuerna', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 12, 'name' => 'Prensa', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer las piernas.'],
            ['max_reps_desired' => 20, 'min_reps_desired' => 15, 'name' => 'Crunch abdominal', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer los abdominales.'],
            ['max_reps_desired' => 10, 'min_reps_desired' => 10, 'name' => 'Zancadas', 'img' => 'ejemplo.jpg', 'description' => 'Ejercicio para fortalecer piernas.'],
        ]);
    }
}