<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'exercises_workouts' con una estructura específica que incluye campos para
     * ID del entrenamiento, ID del ejercicio y orden. Establece una clave primaria compuesta
     * por workout_id y exercise_id.
     */
    public function up(): void
    {
        Schema::create('exercises_workouts', function (Blueprint $table) {
            // ID del entrenamiento
            $table->unsignedBigInteger('workout_id');

            // ID del ejercicio
            $table->unsignedBigInteger('exercise_id');

            // Orden del ejercicio en el entrenamiento
            $table->integer('order');

            // Series que se deben realizar del ejercicio en el entrenamiento
            $table->integer('num_series')->default(3);

            // Clave primaria compuesta por workout_id y exercise_id
            $table->primary(['workout_id', 'exercise_id']);

            // Claves foraneas
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('exercise_id')->references('id')->on('exercises')->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'exercises_workouts' si es necesario, como cuando se ejecuta un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises_workouts');
    }
};
