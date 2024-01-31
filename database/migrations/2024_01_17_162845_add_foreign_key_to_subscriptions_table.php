<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Modifica la tabla 'subscriptions' para añadir una restricción de clave foránea en el campo 'user_id',
     * referenciando el 'id' de la tabla 'users'. Establece la acción para 'on delete cascade'.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Añade la clave foránea 'user_id' referenciando 'id' en la tabla 'users'
            // con la acción de eliminación en cascada
            $table->foreign('user_id', 'fk_subscriptions')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la restricción de clave foránea de la tabla 'subscriptions' si es necesario.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Elimina la restricción de clave foránea 'fk_subscriptions'
            $table->dropForeign('fk_subscriptions');
        });
    }
};

