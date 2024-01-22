<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Modelo Series.
 *
 * Representa una serie de ejercicios dentro de un entrenamiento. Cada serie está asociada a un
 * Workout específico, un User y un Exercise.
 */
class Serie extends Model
{
    use HasFactory;
    /**
     * Relación 'belongsTo' con el modelo Workout.
     *
     * Indica que cada Series está asociada a un Workout (entrenamiento).
     */
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    /**
     * Relación 'belongsTo' con el modelo User.
     *
     * Indica que cada Series está asociada a un User (usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación 'belongsTo' con el modelo Exercise.
     *
     * Indica que cada Series está asociada a un Exercise (ejercicio).
     */
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * Estos son los campos que se pueden llenar a través de la asignación masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'workout_id',
        'user_id',
        'exercise_id',
        'number',
        'date',
        'used_weight',
        'repetitions',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime', 
    ];
  
    // Otros métodos y propiedades del modelo.

}
