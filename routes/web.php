<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/* use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WorkoutController; */
use App\Http\Controllers\RoutineController;

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

/* --  Rutas controlador Exercise, este incluye todos los métodos */
/* Route::resource('/ejercicios', ExerciseController::class);  */
/* Route::get('/ejercicios', [ExerciseController::class, 'index']); */

/* Route::get('/users/{userId}/workouts/{workoutId}', [WorkoutController::class, 'showUserWorkout']); */
/* En la ruta /rutinas usa el método index de RoutineController (retorna una vista con las rutinas disponibles) */
Route::get('/rutinas', [RoutineController::class, 'index']); 


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
