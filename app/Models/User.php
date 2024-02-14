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
     * Define la relación 'one-to-many' con Routine.
     *
     * Cada usuario puede tener muchas rutinas.
     */
    public function routines()
    {
        //return $this->hasMany(Routine::class)->withDefault(); // withDefault proporciona un valor por defecto para evitar valores nulos.
        return $this->hasMany(Routine::class, 'user_id');
    }

    public function subscriptions()
    {
        //dd($this->hasMany(Subscription::class)->orderByDesc('end_date'));
        //return $this->hasMany(Subscription::class)->orderByDesc('end_date');
        return $this->hasMany(Subscription::class);
    }

    public function hasPaidSubscription()
    {
        return $this->subscriptions()->where('paid', true)
                                      ->where('start_date', '<=', now())
                                      ->where('end_date', '>=', now())
                                      ->exists();
    }

    /**
     * Define la relación 'one-to-many' con Workout.
     *
     * Cada usuario puede tener muchos entrenamientos (workouts).
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'users_workouts', 'workout_id', 'user_id');
    }

    /**
     * Define la relación 'one-to-many' con Series.
     *
     * Cada usuario puede tener muchas series de ejercicios.
     */
    public function series()
    {
        return $this->hasMany(Serie::class);
    }


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
        'email',
        'password',
        'routine_id',
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
