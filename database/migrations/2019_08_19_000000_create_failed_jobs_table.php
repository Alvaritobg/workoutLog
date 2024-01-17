<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la creación de la tabla 'failed_jobs'.
 *
 * Esta migración crea una tabla que se utiliza para registrar los trabajos 
 * de cola que han fallado en su ejecución, permitiendo una posterior revisión
 * y manejo de estos errores.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Define la estructura de la tabla 'failed_jobs', que incluye campos para
     * almacenar información detallada sobre los trabajos fallidos.
     */
    public function up(): void
    {
        // Creación de la tabla 'failed_jobs'
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id(); // Columna para el ID del registro, clave primaria autoincremental
            $table->string('uuid')->unique(); // Columna para UUID único del trabajo fallido
            $table->text('connection'); // Columna para almacenar el nombre de la conexión de cola
            $table->text('queue'); // Columna para almacenar el nombre de la cola donde falló el trabajo
            $table->longText('payload'); // Columna para almacenar la carga útil del trabajo
            $table->longText('exception'); // Columna para almacenar la excepción generada cuando el trabajo falló
            $table->timestamp('failed_at')->useCurrent(); // Columna para la marca de tiempo de cuándo falló el trabajo
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'failed_jobs' de la base de datos.
     */
    public function down(): void
    {
        // Eliminación de la tabla 'failed_jobs'
        Schema::dropIfExists('failed_jobs');
    }
};

