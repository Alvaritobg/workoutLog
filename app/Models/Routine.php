<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Routine.
 *
 * Representa una rutina en la aplicación. Cada rutina está asociada a un usuario.
 * Este modelo utiliza la tabla 'routines' de la base de datos.
 */
class Routine extends Model
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
        'user_id',
        'name',
        'description',
    ];


    /**
     * Relación 'belongsTo' con el modelo User.
     *
     * Indica que cada Routine (rutina) está asociada a un User (usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Otros métodos y propiedades del modelo.
}

