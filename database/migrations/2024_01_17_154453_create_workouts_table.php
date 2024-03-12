<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'workouts'
     */
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            // ID del entrenamiento, autoincremental y único
            $table->id();

            // ID de la rutina asociada
            $table->unsignedBigInteger('routine_id')->nullable();

            // Nombre del entrenamiento
            $table->string('name', 400);

            // Orden del entrenamiento en la rutina
            $table->integer('order');

            $table->timestamps();

        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'workouts' si es necesario, como cuando se ejecuta un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};

