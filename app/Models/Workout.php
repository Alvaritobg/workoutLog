<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Workout.
 *
 * Representa un entrenamiento en la aplicación. Cada entrenamiento está asociado a un usuario y 
 * puede incluir múltiples ejercicios.
 */
class Workout extends Model
{
    use HasFactory;

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    /**
     * Relación 'belongsTo' con el modelo User.
     *
     * Indica que cada Workout (entrenamiento) pertenece a un User (usuario).
     * Esto establece una relación inversa de uno a muchos.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_workouts', 'workout_id', 'user_id')
                ->withPivot('execution_date');
                //->withTimestamps();
    }

    /**
     * Relación 'belongsToMany' con el modelo Exercise.
     *
     * Representa la relación muchos a muchos entre Workout y Exercise.
     * Utiliza la tabla 'exercises_workouts' como tabla intermedia (pivot) para esta relación.
     */
    public function exercises()
    {
       // return $this->belongsToMany(Exercise::class, 'exercises_workouts', 'exercise_id', 'workout_id');
       return $this->belongsToMany(Exercise::class, 'exercises_workouts', 'workout_id', 'exercise_id')
                ->withPivot('order')->orderBy('pivot_order'); // Si tienes una columna 'order' en la tabla pivot
    }

    /**
     * Relación 'hasMany' con el modelo Series.
     *
     * Indica que cada Workout puede tener múltiples instancias de Series.
     * Esta relación ayuda a manejar los detalles de cada ejercicio dentro de un entrenamiento.
     */
    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * Estos son los campos que se pueden llenar a través de la asignación masiva para evitar
     * asignaciones accidentales o no deseadas de atributos.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Añade aquí los campos que son seguros para la asignación masiva.
        'routine_id',
        'name',
        'order',
    ];
}
