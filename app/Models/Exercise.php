<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Exercise.
 *
 * Representa un ejercicio en la aplicación. Un ejercicio puede estar asociado a múltiples entrenamientos (Workouts)
 * a través de la tabla 'series', que actúa como tabla intermedia para esta relación muchos a muchos.
 */
class Exercise extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * Estos son los campos que se pueden llenar a través de la asignación masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'max_reps_desired',
        'min_reps_desired',
        'name',
        'img',
        'description',
    ];

    /**
     * Relación 'belongsToMany' con el modelo Workout.
     *
     * Representa la relación muchos a muchos entre Exercise y Workout.
     * Utiliza la tabla 'series' como tabla intermedia (pivot) para esta relación.
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'exercises_workouts', 'exercise_id', 'workout_id');
    }

    // Otros métodos y propiedades del modelo.
}

