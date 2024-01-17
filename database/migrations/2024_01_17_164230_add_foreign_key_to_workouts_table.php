<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Modifica la tabla 'workouts' para añadir una restricción de clave foránea en el campo 'routines_id',
     * referenciando el 'id' de la tabla 'routines'. Establece la acción para 'on delete cascade'.
     */
    public function up(): void
    {
        Schema::table('workouts', function (Blueprint $table) {
            // Añade la clave foránea 'routines_id' referenciando 'id' en la tabla 'routines'
            // con la acción de eliminación en cascada
            $table->foreign('routine_id', 'fk_workouts')
                  ->references('id')
                  ->on('routines')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la restricción de clave foránea de la tabla 'workouts' si es necesario.
     */
    public function down(): void
    {
        Schema::table('workouts', function (Blueprint $table) {
            // Elimina la restricción de clave foránea 'fk_workouts'
            $table->dropForeign('fk_workouts');
        });
    }
};
