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
    Route::get('/rutinas', [RoutineController::class, 'index']);
    Route::get('/rutina/{id}', [RoutineController::class, 'show'])->name('routine.show');
    Route::get('/rutina/{id}/editar', [RoutineController::class, 'edit'])->name('routine.edit');
    /*Route::get('/prueba/{id}',[UserController::class,'getUserRoutine'])->name('index');  */
});

// Rutas usuario
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/trainer/{id}', [UserController::class, 'obtainCreatedRoutines'])->name('users.trainerRoutines');
    Route::post('/suscribir-usuario/{user_id}/rutina/{routine_id}', [UserController::Class, 'subscribeUserToRoutine']);
    Route::post('/des-suscribir-usuario/{user_id}/rutina/{routine_id}', [UserController::Class, 'unSubscribeUserFromRoutine']);
    
    // Middleware de role admin  (solo pueden entrar administradores)
    Route::get('administrar-usuarios/', [UserController::class, 'index'])
         ->name('users.manageUsers')
         ->middleware('role:admin'); // Asegúrate de que el rol sea exactamente 'admin'
    // Ruta para eliminar usuarios
    Route::delete('/administrar-usuarios/eliminar/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('role:admin');
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
