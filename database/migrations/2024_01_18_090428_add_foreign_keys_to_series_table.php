<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Modifica la tabla 'series' para añadir restricciones de clave foránea en los campos
     * 'workout_id', 'user_id' y 'exercise_id', referenciando las tablas 'workouts', 'users'
     * y 'exercises' respectivamente. Establece la acción para 'on delete cascade'.
     */
    public function up(): void
    {
        Schema::table('series', function (Blueprint $table) {
            // Añade clave foránea 'workout_id' referenciando 'id' en la tabla 'workouts'
            $table->foreign('workout_id', 'fk_series_workouts')
                  ->references('id')
                  ->on('workouts')
                  ->onDelete('cascade');

            // Añade clave foránea 'user_id' referenciando 'id' en la tabla 'users'
            $table->foreign('user_id', 'fk_series_users')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Añade clave foránea 'exercise_id' referenciando 'id' en la tabla 'exercises'
            $table->foreign('exercise_id', 'fk_series_exercises')
                  ->references('id')
                  ->on('exercises')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina las restricciones de clave foránea de la tabla 'series' si es necesario.
     */
    public function down(): void
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropForeign('fk_series_workouts');
            $table->dropForeign('fk_series_users');
            $table->dropForeign('fk_series_exercises');
        });
    }
};

