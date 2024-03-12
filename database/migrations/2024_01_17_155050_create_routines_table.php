<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'routines' con una estructura específica que incluye campos para
     * ID, ID de usuario, nombre de la rutina y descripción. Establece 'id' como clave primaria.
     */
    public function up(): void
    {
        Schema::create('routines', function (Blueprint $table) {
            // ID de la rutina, autoincremental y único
            $table->id();

            // ID del usuario asociado
            $table->unsignedBigInteger('user_id')->nullable();

            // Nombre de la rutina
            $table->string('name', 400);

            // Descripción de la rutina
            $table->string('description', 2000)->nullable();

            // Días de entrenamiento por semana
            $table->integer('days')->nullable();

            // Duración en semanas
            $table->integer('duration')->nullable();

            $table->string('img')->nullable();

            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'routines' si es necesario, como cuando se ejecuta un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('routines');
    }
};
