<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Este método se encarga de crear la tabla 'exercises' en la base de datos.
     * Define la estructura de la tabla con campos para el ID, repeticiones máximas y mínimas deseadas,
     * nombre del ejercicio, URL de la imagen y descripción del ejercicio. Además, incluye verificaciones
     * para asegurar que las repeticiones máximas y mínimas sean mayores que cero.
     */
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            // ID autoincremental
            $table->id();

            // Repeticiones máximas deseadas, con una verificación para asegurarse de que sea mayor que cero
            $table->integer('max_reps_desired')->check('max_reps_desired > 0');

            // Repeticiones mínimas deseadas, con una verificación para asegurarse de que sea mayor que cero
            $table->integer('min_reps_desired')->check('min_reps_desired > 0');

            // Nombre del ejercicio
            $table->string('name', 400);

            // URL de la imagen, opcional
            $table->string('info', 1000)->nullable();

            // Descripción del ejercicio, opcional
            $table->string('description', 2000)->nullable();

            // La clave primaria 'id' es definida automáticamente por el método 'id()'
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Este método elimina la tabla 'exercises' si es necesario, por ejemplo, cuando se realiza
     * un rollback de las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
