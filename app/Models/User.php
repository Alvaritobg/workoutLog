<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Comentar para desactivar validación por email
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo de Usuario.
 *
 * Representa un usuario autenticable dentro de la aplicación, con soporte para
 * verificación de correo electrónico, roles y permisos, notificaciones y tokens API.
 */
class User extends Authenticatable implements MustVerifyEmail // Con este implements indicamos que el cliente tiene que validar el email en su correo
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array<int, string> Atributos que se pueden llenar de forma masiva.
     */
    protected $fillable = [
        'name',
        'surname',
        'date_of_birth',
        'weight',
        /* 'role', */
        'email',
        'password',
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * Estos atributos no serán visibles cuando el modelo se convierta en un array o un JSON.
     *
     * @var array<int, string> Atributos ocultos en la serialización.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string> Tipos de datos a los que se deben convertir los atributos.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
