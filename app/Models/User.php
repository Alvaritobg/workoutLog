<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail; // Habilita la verificación de correo electrónico para el usuario.
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importa el trait HasFactory para la creación de fábricas de modelos.
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de la clase base Authenticatable para autenticación.
use Spatie\Permission\Traits\HasRoles; // Importa el trait HasRoles para manejar roles y permisos con el paquete spatie/laravel-permission.
use Illuminate\Notifications\Notifiable; // Habilita las notificaciones para el modelo User.
use Laravel\Sanctum\HasApiTokens; // Habilita el uso de API Tokens con Sanctum para autenticación API.
use Carbon\Carbon; // Biblioteca para fechas
use App\Models\Subscription;

/**
 * Clase User que representa el modelo de usuario en la aplicación.
 *
 * Esta clase extiende de Authenticatable e implementa MustVerifyEmail para requerir la verificación de correo
 * electrónico de los usuarios. Utiliza varios traits para habilitar funcionalidades como notificaciones, API tokens,
 * y manejo de roles y permisos.
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles; // Traits utilizados para funcionalidades adicionales.

    /**
     * Relación uno a muchos con el modelo Routine. 
     * Cada usuario puede crear y tener asociadas múltiples rutinas.
     */
    public function routines()
    {

        return $this->belongsTo(Routine::class, 'routine_id');
    }

    /**
     * Relación uno a muchos con el modelo Subscription.
     * Cada usuario puede tener múltiples suscripciones.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class); // Define la relación con el modelo Subscription.
    }

    /**
     * Comprueba si el usuario tiene una suscripción activa y pagada.
     *
     * @return bool Verdadero si existe una suscripción activa y pagada, falso en caso contrario.
     */
    public function hasActivePaidSubscription()
    {
        return $this->subscriptions()->where('paid', true)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->exists(); // Utiliza condiciones para filtrar suscripciones activas y pagadas.
    }

    /**
     * Relación muchos a muchos con el modelo Workout.
     * Un usuario puede tener asociados muchos entrenamientos y participar en ellos.
     */
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'users_workouts', 'user_id', 'workout_id')->withPivot('execution_date')->withTimestamps(); // Define la relación y especifica las claves foráneas.

        //return $this->belongsToMany(Workout::class, 'users_workouts')->withPivot('execution_date');
    }

    /**
     * Relación uno a muchos con el modelo Serie.
     * Cada usuario puede registrar múltiples series de ejercicios en sus entrenamientos.
     */
    public function series()
    {
        return $this->hasMany(Serie::class); // Define la relación con el modelo Serie.
    }

    /**
     * Obtiene el nombre del rol del usuario.
     *
     * @return string Nombre del rol del usuario.
     */
    public function getRoleName()
    {
        // Obtiene el primer rol asignado al usuario
        $role = $this->roles->first();

        // Verifica el nombre del rol y retorna el nombre correspondiente
        switch ($role->name) {
            case 'admin':
                return 'Administrador';
            case 'user':
                return 'Usuario';
            case 'trainer':
                return 'Entrenador';
            default:
                return 'Sin rol';
        }
    }

    /**
     * Calcula y retorna la edad del usuario.
     *
     * @return int Edad del usuario.
     */
    public function getAge()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }



    /**
     * Atributos asignables en masa.
     *
     * @var array Lista de atributos que se pueden asignar masivamente.
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
     * Atributos ocultos en la serialización.
     *
     * @var array Lista de atributos que no se incluirán en la serialización (array/JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos que deben ser convertidos a tipos nativos.
     *
     * @var array Mapeo de atributos a sus tipos nativos en PHP.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
