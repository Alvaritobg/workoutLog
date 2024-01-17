<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la creación de la tabla 'personal_access_tokens'.
 *
 * Esta migración crea una tabla destinada a almacenar tokens de acceso personal,
 * utilizados generalmente para autenticación de API y otorgamiento de permisos.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Define la estructura de la tabla 'personal_access_tokens' en la base de datos,
     * que incluye información sobre los tokens de acceso personal.
     */
    public function up(): void
    {
        // Creación de la tabla 'personal_access_tokens'
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Columna para el ID del token, clave primaria autoincremental
            $table->morphs('tokenable'); // Polimorfismo para asociar el token a diferentes tipos de modelos
            $table->string('name'); // Columna para el nombre del token
            $table->string('token', 64)->unique(); // Columna para el token, con longitud fija y único
            $table->text('abilities')->nullable(); // Columna para las habilidades/permisos del token, puede ser nula
            $table->timestamp('last_used_at')->nullable(); // Columna para la última vez que se usó el token, puede ser nula
            $table->timestamp('expires_at')->nullable(); // Columna para la fecha de expiración del token, puede ser nula
            $table->timestamps(); // Columnas para las marcas de tiempo 'created_at' y 'updated_at'
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'personal_access_tokens' de la base de datos.
     */
    public function down(): void
    {
        // Eliminación de la tabla 'personal_access_tokens'
        Schema::dropIfExists('personal_access_tokens');
    }
};
