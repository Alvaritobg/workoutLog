<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Subscription.
 *
 * Representa una suscripción en la aplicación, asociada a un usuario y con un rango de fechas definido.
 * Este modelo tiene una clave primaria compuesta por 'user_id', 'start_date', y 'end_date'.
 */
class Subscription extends Model
{
    use HasFactory;

    // Desactiva los campos de timestamp por defecto de Eloquent
    public $timestamps = false;

    // Define la clave primaria compuesta
    protected $primaryKey = ['user_id', 'start_date', 'end_date'];
    public $incrementing = false; // Indica que el modelo no utiliza un incremento automático en su clave primaria

    // Define el modelo como no incrementable y sin clave primaria autoincremental
    protected $keyType = 'string'; // Ajusta esto según el tipo de tus claves primarias

    /**
     * Relación 'belongsTo' con el modelo User.
     *
     * Cada suscripción está asociada a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definir otros métodos y relaciones aquí según sea necesario
    // ...

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'paid',
        'renew',
    ];

    /**
     * Los atributos que deben estar ocultos en las representaciones de array y JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}

