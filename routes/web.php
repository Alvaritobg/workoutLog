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


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/rutinas', [RoutineController::class, 'index']);
    Route::get('/rutina/{id}', [RoutineController::class, 'show']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Spatie
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('users', UserController::class);
    //Route::resource('roles', HomeController::class);
});
//-----


require __DIR__ . '/auth.php';
