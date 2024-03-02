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
            ['max_reps_desired' => 10, 'min_reps_desired' => 5, 'name' => 'Press de banca', 'info' => 'https://www.youtube.com/watch?v=ICaZxO7RmKs', 'description' => 'Ejercicio para fortalecer el pecho.'],
            ['max_reps_desired' => 8, 'min_reps_desired' => 4, 'name' => 'Sentadilla', 'info' => 'https://www.youtube.com/watch?v=VRKdOsad3HQ', 'description' => 'Ejercicio para fortalecer las piernas.'],
            ['max_reps_desired' => 12, 'min_reps_desired' => 6, 'name' => 'Dominadas', 'info' => 'https://www.youtube.com/watch?v=jawH2Pn_16Y', 'description' => 'Ejercicio para fortalecer la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 8, 'name' => 'Peso muerto', 'info' => 'https://www.youtube.com/shorts/VLW-vK6ZF94', 'description' => 'Ejercicio para fortalecer las piernas y la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 12, 'name' => 'Remo mancuerna', 'info' => 'https://www.youtube.com/watch?v=EYp9L2gfFBY', 'description' => 'Ejercicio para fortalecer la espalda.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 12, 'name' => 'Prensa', 'info' => 'https://www.youtube.com/watch?v=3T7EFxh8kq4', 'description' => 'Ejercicio para fortalecer las piernas.'],
            ['max_reps_desired' => 20, 'min_reps_desired' => 15, 'name' => 'Crunch abdominal', 'info' => 'https://www.youtube.com/watch?v=OsUz898onTE', 'description' => 'Ejercicio para fortalecer los abdominales.'],
            ['max_reps_desired' => 10, 'min_reps_desired' => 10, 'name' => 'Zancadas', 'info' => 'https://www.youtube.com/watch?v=Xcfs_3DMKlc', 'description' => 'Ejercicio para fortalecer piernas.'],
            ['max_reps_desired' => 12, 'min_reps_desired' => 6, 'name' => 'Flexiones', 'info' => 'https://www.youtube.com/watch?v=2ZSq1BRYwAI', 'description' => 'Ejercicio para fortalecer el pecho y los tríceps.'],
            ['max_reps_desired' => 20, 'min_reps_desired' => 10, 'name' => 'Saltos al cajón', 'info' => 'https://www.youtube.com/watch?v=bbFEYR3i8JU', 'description' => 'Ejercicio para mejorar la potencia de piernas.'],
            ['max_reps_desired' => 10, 'min_reps_desired' => 5, 'name' => 'Fondos en paralelas', 'info' => 'https://www.youtube.com/watch?v=1yXVgh_DbqA', 'description' => 'Ejercicio para tríceps y pecho.'],
            ['max_reps_desired' => 12, 'min_reps_desired' => 8, 'name' => 'Curl de bíceps', 'info' => 'https://www.youtube.com/watch?v=toR4XLLVzwY', 'description' => 'Ejercicio para fortalecer los bíceps.'],
            ['max_reps_desired' => 15, 'min_reps_desired' => 10, 'name' => 'Elevaciones laterales', 'info' => 'https://www.youtube.com/watch?v=dT6Q3NHtSjw', 'description' => 'Ejercicio para fortalecer los hombros.'],
            ['max_reps_desired' => 10, 'min_reps_desired' => 8, 'name' => 'Femoral sentado', 'info' => 'https://www.youtube.com/watch?v=locj9zuXya0', 'description' => 'Ejercicio para  parte trasera de piernas y glúteos.'],
            ['max_reps_desired' => 25, 'min_reps_desired' => 15, 'name' => 'Plancha', 'info' => 'https://www.youtube.com/watch?v=d0atctiI7Vw', 'description' => 'Ejercicio de core para fortalecer el abdomen.'],
            ['max_reps_desired' => 20, 'min_reps_desired' => 10, 'name' => 'Burpees', 'info' => 'https://www.youtube.com/watch?v=Uy2nUNX38xE', 'description' => 'Ejercicio de cuerpo completo para mejorar la resistencia.'],
        ]);
    }
}
