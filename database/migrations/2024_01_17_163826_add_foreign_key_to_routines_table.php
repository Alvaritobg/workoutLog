<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Modifica la tabla 'routines' para añadir una restricción de clave foránea en el campo 'user_id',
     * referenciando el 'id' de la tabla 'users'. Establece la acción para 'on delete cascade'.
     */
    public function up(): void
    {
        Schema::table('routines', function (Blueprint $table) {
            // Añade la clave foránea 'user_id' referenciando 'id' en la tabla 'users'
            // con la acción de eliminación en cascada
            $table->foreign('user_id', 'fk_routines')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la restricción de clave foránea de la tabla 'routines' si es necesario.
     */
    public function down(): void
    {
        Schema::table('routines', function (Blueprint $table) {
            // Elimina la restricción de clave foránea 'fk_routines'
            $table->dropForeign('fk_routines');
        });
    }
};

