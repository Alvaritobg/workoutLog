<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Modifica la tabla 'users' para añadir una restricción de clave foránea en el campo 'routine_id',
     * referenciando el 'id' de la tabla 'routines'. Establece la acción para 'on delete cascade'.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Añade la clave foránea 'routine_id' referenciando 'id' en la tabla 'routines'
            // con la acción de eliminación en cascada
            $table->foreign('routine_id', 'fk_users')
                  ->references('id')
                  ->on('routines')
                  ->onDelete('cascade')
                  ->nullable()
                  ->default(null)
                  ->change();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la restricción de clave foránea de la tabla 'users' si es necesario.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la restricción de clave foránea 'fk_users'
            $table->dropForeign('fk_users');
        });
    }
};

