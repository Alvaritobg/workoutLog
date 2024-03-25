<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent para la tabla 'users_workouts'.
 *
 * Este modelo representa la relación entre usuarios y entrenamientos (workouts),
 * permitiendo acceder a la información de los entrenamientos realizados por los usuarios,
 * incluyendo la fecha de ejecución de cada entrenamiento.
 */
class UserWorkout extends Model
{
    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'users_workouts';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'workout_id', 'execution_date'];

    /**
     * Indica si el modelo debería gestionar las marcas de tiempo ('timestamps').
     *
     * Desactivado en este modelo ya que la tabla 'users_workouts' no incluye
     * las columnas 'created_at' y 'updated_at'.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define la relación entre UserWorkout y User.
     *
     * Cada entrada en 'users_workouts' pertenece a un usuario específico.
     * Esta función permite acceder al modelo User que realizó el Workout.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define la relación entre UserWorkout y Workout.
     *
     * Cada entrada en 'users_workouts' pertenece a un entrenamiento (workout) específico.
     * Esta función permite acceder al modelo Workout que fue realizado por el User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
