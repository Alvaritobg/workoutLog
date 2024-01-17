<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la creación de la tabla 'password_reset_tokens'.
 *
 * Esta migración crea una tabla dedicada a almacenar los tokens de restablecimiento
 * de contraseña, asociados a las direcciones de correo electrónico de los usuarios.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'password_reset_tokens' con las columnas necesarias para almacenar
     * los tokens de restablecimiento de contraseña y las direcciones de email asociadas.
     */
    public function up(): void
    {
        // Creación de la tabla 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Columna para el email, establecida como clave primaria
            $table->string('token');           // Columna para el token de restablecimiento de contraseña
            $table->timestamp('created_at')->nullable(); // Columna para la marca de tiempo de creación, puede ser nula
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'password_reset_tokens' de la base de datos.
     */
    public function down(): void
    {
        // Eliminación de la tabla 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');
    }
};
