<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\UserWorkout;
use App\Models\Series;
use App\Models\Routine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        // Asumiendo que tienes un modelo Routine y que el usuario está asociado con una rutina.
        $routine = Routine::find($user->routine_id);

        if (!$routine) {
            // Si no se encuentra una rutina, redirigir con un mensaje de error.
            return redirect()->route('routine.index')->with('error', 'No estás suscrito a ninguna rutina.');
        }

        // Intentar obtener el último entrenamiento realizado por el usuario para la rutina especificada.
        $lastWorkoutDate = UserWorkout::where('user_id', $user->id)
            ->join('workouts', 'user_workouts.workout_id', '=', 'workouts.id')
            ->where('workouts.routine_id', $routine->id)
            ->latest('user_workouts.execution_date')
            ->first();

        if ($lastWorkoutDate) {
            // Lógica para manejar el último entrenamiento encontrado.
            // Asegúrate de que este bloque de código use correctamente el resultado de la consulta.
            // Por ejemplo, $lastWorkoutDate->workout_id para obtener el ID del último workout.
        } else {
            // Si no hay entrenamientos previos, toma el primer entrenamiento de la rutina
            $nextWorkout = $routine->workouts()->orderBy('order', 'asc')->first();
        }

        if (!$nextWorkout) {
            return redirect()->route('routine.index')->with('error', 'La rutina seleccionada no tiene entrenamientos.');
        }

        $exercises = $nextWorkout->exercises;

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
