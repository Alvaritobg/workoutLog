<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'users_workouts' con una estructura específica que incluye campos para
     * ID de entrenamiento, ID de usuario y fecha de ejecución. Establece una clave primaria compuesta.
     */
    public function up(): void
    {
        Schema::create('users_workouts', function (Blueprint $table) {
            // ID del entrenamiento
            $table->unsignedBigInteger('workout_id');

            // ID del usuario
            $table->unsignedBigInteger('user_id');

            // Fecha de ejecución del entrenamiento
            $table->dateTime('execution_date');

            // Clave primaria compuesta por workout_id, user_id y execution_date
            $table->primary(['workout_id', 'user_id', 'execution_date']);

            // Restricciones de clave foránea
            $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'users_workouts' si es necesario, como cuando se ejecuta un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_workouts');
    }
};

