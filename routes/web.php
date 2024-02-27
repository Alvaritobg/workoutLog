<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Spatie
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
//Fin spatie
/* use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutController; */
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas rutina
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/rutinas', [RoutineController::class, 'index'])->name('routine.index');
    Route::get('/rutina/{id}', [RoutineController::class, 'show'])->name('routine.show');
    /*Route::get('/prueba/{id}',[UserController::class,'getUserRoutine'])->name('index');  */
    Route::delete('/rutinas/eliminar/{id}', [RoutineController::class, 'destroy'])->name('routines.destroy')->middleware('role:trainer');
    // Ruta para el metodo que muestra la vista para crear una rutina nueva, solo pueden acceder usuarios autenticados con rol trainer
    Route::get('/rutinas/crear-rutina', [RoutineController::class, 'create'])->middleware('role:trainer')->name('rutinas.create');
    // Ruta para guardar una nueva rutina
    Route::post('/rutinas', [RoutineController::class, 'store'])->middleware('role:triner')->name('rutinas.store');
    // ruta para update de rutinas
    Route::get('/rutinas/editar/{id}', [RoutineController::class, 'edit'])->name('rutinas.edit');
    Route::put('/rutinas/editar/{id}', [RoutineController::class, 'update'])->middleware('role:trainer|admin')->name('rutinas.update');
});

// Rutas usuario
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/entrenador/{id}/rutinas', [UserController::class, 'obtainCreatedRoutines'])->name('users.trainerRoutines');
    Route::post('/suscribir-usuario/{user_id}/rutina/{routine_id}', [UserController::Class, 'subscribeUserToRoutine']);
    Route::post('/des-suscribir-usuario/{user_id}/rutina/{routine_id}', [UserController::Class, 'unSubscribeUserFromRoutine']);
    
    // Middleware de role admin  (solo pueden entrar administradores)
    Route::get('administrar-usuarios/', [UserController::class, 'index'])
         ->name('users.manageUsers')
         ->middleware('role:admin'); // Asegúrate de que el rol sea exactamente 'admin'
    // Ruta para eliminar usuarios
    Route::delete('/administrar-usuarios/eliminar/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('role:admin');
    // Administracion de clientes y sus entrenamientos
    Route::get('administrar-clientes/', [UserController::class, 'getUsersWithTheirRoutines'])->name('users.trainerClients')->middleware(['role:trainer','auth','verified']);
    Route::get('administrar-clientes/ver-entrenamientos/{userId}', [UserController::class, 'listUserWorkouts'])->name('users.listUserTrainigs')->middleware('role:trainer');
});
// SUBSCRIPCIONES
Route::post('/subscripcion/guardar', [SubscriptionController::class, 'store'])->name('subscriptions.store')->middleware(['role:admin|trainer','auth','verified']);
Route::post('/subscription/disable-renew', [SubscriptionController::class, 'disableRenew'])->name('subscription.disableRenew')->middleware(['role:admin|trainer','auth','verified']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Spatie
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('users', UserController::class);
    //Route::resource('roles', HomeController::class);
});
//-----


require __DIR__ . '/auth.php';
