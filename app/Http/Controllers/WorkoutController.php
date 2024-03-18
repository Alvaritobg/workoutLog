<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\UserWorkout;
use App\Models\Series;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workout = Workout::all();
        return view('workout.index', compact('workout'));
    }

    /**
     * Muestra el formulario para registrar un nuevo entrenamiento.
     */
    public function create()
    {
        $user = Auth::user();
        // Asegúrate de obtener el objeto de la rutina, no solo el ID.
        $routine = $user->routine; // Esto asume que hay una relación 'routine' definida en el modelo User.

        if (!$routine) {
            return redirect()->route('routine.index')->with('error', 'No estás suscrito a ninguna rutina.');
        }

        // Obtener el último entrenamiento realizado por el usuario para una rutina específica
        $lastWorkout = $user->workouts()->where('routine_id', $routine->id)->latest('execution_date')->first();

        $nextWorkout = null;
        if ($lastWorkout) {
            // Buscar el siguiente entrenamiento en la rutina
            $nextWorkout = $routine->workouts()->where('order', '>', $lastWorkout->order)->orderBy('order', 'asc')->first();
        }

        if (!$nextWorkout) {
            // Si no hay un "siguiente" entrenamiento, toma el primero de la rutina
            $nextWorkout = $routine->workouts()->orderBy('order', 'asc')->first();
        }

        if (!$nextWorkout) {
            return redirect()->route('routine.index')->with('error', 'La rutina seleccionada no tiene entrenamientos.');
        }

        // Aquí suponemos que cada entrenamiento tiene ejercicios asociados correctamente en tu base de datos
        $exercises = $nextWorkout->exercises; // Asegúrate de que tu modelo Workout tenga definida la relación con Exercise

        return view('workouts.create', compact('exercises', 'nextWorkout'));
    }

    /**
     * Almacena un nuevo registro de entrenamiento en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar el request aquí según sea necesario
        // ...

        $user = Auth::user();
        $date = now()->format('Y-m-d');
        $exercisesInput = $request->input('exercises');

        if ($exercisesInput && is_array($exercisesInput)) {
            foreach ($exercisesInput as $exerciseId => $seriesData) {
                foreach ($seriesData['series'] as $seriesNumber => $data) {
                    Series::create([
                        'user_id' => $user->id,
                        // Suponiendo que 'workout_id' se pasa a través del formulario
                        'workout_id' => $request->input('workout_id'),
                        'exercise_id' => $exerciseId,
                        'number' => $seriesNumber,
                        'date' => $date,
                        'used_weight' => $data['used_weight'],
                        'repetitions' => $data['repetitions'],
                        // Otros campos necesarios...
                    ]);
                }
            }
        } else {
            // Manejar la ausencia de datos, por ejemplo, devolver un error o un mensaje al usuario.
            return back()->with('error', 'No se enviaron datos de ejercicios.');
        }

        return redirect()->route('routine.index')->with('success', 'Entrenamiento registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        //
    }

    // 
    public function showUserWorkout($userId, $workoutId)
    {
        $userId = 4;
        $workoutId = 4;

        $workout = Workout::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->where('id', $workoutId)
            ->first();


        return view('workouts.index', compact('workout'));
    }
}
