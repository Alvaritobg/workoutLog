<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * Crea la tabla 'series'
     */
    public function up(): void
    {
        Schema::create('series', function (Blueprint $table) {
            // Número de serie, autoincremental y único
            //$table->unsignedBigInteger('number') (Da error, debo sacar number de la clave primaria y declarar una clave unica compuesta)
            $table->BigInteger('number');

            // ID del entrenamiento asociado
            $table->unsignedBigInteger('workout_id');

            // ID del usuario asociado
            $table->unsignedBigInteger('user_id');

            // ID del ejercicio realizado
            $table->unsignedBigInteger('exercise_id');

            // Fecha y hora en que se realizó el ejercicio
            $table->dateTime('date');

            // Peso usado en el ejercicio
            $table->integer('used_weight');

            // Repeticiones obtenidas en el ejercicio
            $table->integer('repetitions');

            // Clave primaria compuesta
            //$table->primary(['number','workout_id', 'user_id', 'exercise_id', 'date']);// (Da error, debo sacar number de la clave primaria y declarar una clave unica compuesta)
            $table->unique(['number','workout_id', 'user_id', 'exercise_id', 'date']);
        });
    }

    /**
     * Revierte las migraciones.
     *
     * Elimina la tabla 'series' si es necesario. Por ejemplo, esto ocurre cuando se ejecuta un rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
