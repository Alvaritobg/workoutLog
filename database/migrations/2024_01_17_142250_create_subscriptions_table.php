<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     * 
     * Este método se encarga de crear la tabla 'subscriptions' con las columnas especificadas.
     * Incluye campos para la fecha de start_date, end_date, user_id, y booleanos para 'paid' y 'renew'.
     * Se establece una clave primaria compuesta por ['user_id', 'start_date', 'end_date'].
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            // Fecha de inicio de la subscripción
            $table->date('start_date');

            // Fecha de fin de la subscripción
            $table->date('end_date');

            // Identificador único del usuario
            $table->unsignedBigInteger('user_id');

            // Indica si la subscripción ha sido pagada
            $table->boolean('paid')->default(false);

            // Indica si la subscripción debe ser renovada
            $table->boolean('renew')->default(false);

            // Define una clave primaria compuesta
            $table->primary(['user_id', 'start_date', 'end_date']);
        });
    }

    /**
     * Revierte las migraciones.
     * 
     * Este método se encarga de eliminar la tabla 'subscriptions' si es necesario.
     * Se ejecuta cuando se realiza un rollback de las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

