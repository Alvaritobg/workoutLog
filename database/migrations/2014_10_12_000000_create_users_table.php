<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migración para la creación de la tabla 'users'.
 *
 * Esta migración crea la tabla 'users' en la base de datos con todas las
 * columnas necesarias para almacenar la información de los usuarios.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Define la estructura de la tabla 'users' en la base de datos.
     */
    public function up(): void
    {
        // Creación de la tabla 'users' en la base de datos
        Schema::create('users', function (Blueprint $table) {
            // Columnas de la tabla
            $table->id(); // Columna para el ID del usuario, clave primaria autoincremental
            $table->string('name'); // Columna para el nombre del usuario
            $table->string('surname')->nullable(); // Columna para el apellido del usuario, puede ser nula
            $table->float('weight')->nullable(); // Columna para el peso del usuario, puede ser nula
            $table->date('date_of_birth'); // Columna para la fecha de nacimiento del usuario
            $table->string('email')->unique(); // Columna para el email del usuario, debe ser único
            $table->timestamp('email_verified_at')->nullable(); // Columna para la fecha de verificación del email, puede ser nula
            $table->string('password'); // Columna para la contraseña del usuario
            $table->unsignedBigInteger('routine_id'); // Columna para id de rutina
            // Los roles van a ser gestionados por spatie
            // $table->enum('role', ['admin', 'user', 'trainer'])->default('user');
            $table->rememberToken(); // Columna para el token de "recordar usuario" de la autenticación
            $table->timestamps(); // Columnas para las marcas de tiempo 'created_at' y 'updated_at'
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'users' de la base de datos.
     */
    public function down(): void
    {
        // Eliminación de la tabla 'users'
        Schema::dropIfExists('users');
    }
};

