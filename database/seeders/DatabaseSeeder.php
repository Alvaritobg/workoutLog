<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Lanza las seeds que añadamos en el siguiente método.
     */
    public function run(): void
    {
        $this->call(ExerciseSeeder::class); // Llama a las seeders de la tabla "exercises"
        $this->call(UsersSeeder::class); // Llama a las seeders de la tabla "users"
        $this->call(RoutinesSeeder::class); // Llama a las seeders de la tabla "routines"
        $this->call(WorkoutsSeeder::class); // Llama a las seeders de la tabla "workouts"
        $this->call(SeriesSeeder::class); // Llama a las seeders de la tabla "series"
        $this->call(ExercisesWorkoutsSeeder::class); // Llama a las seeders de la tabla "exercises_workouts"
        $this->call(UsersWorkoutsSeeder::class); // Llama a las seeders de la tabla "users_workouts"
        $this->call(SubscriptionsSeeder::class); // Llama a las seeders de la tabla "subscriptions"
        $this->call(SetUsersRoutinesSeeder::class); // Llama a las seeders para asignar rutinas a usuarios en la tabla users

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
