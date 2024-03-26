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
        // buscamos el último entrenamiento (si lo hay) para calcular el siguiente 
        $lastUserWorkout = $user->getLastWorkoutFromCurrentRoutine();
        $nextWorkout = null;
        // -  si es null, quiere decir que no realizo ningun entrenamiento aun
        if ($lastUserWorkout == null) {
            $routineId = $user->routine_id ?? null;
            // si el usuario no esta suscrito a ninguna rutina lo sacamos 
            if (!$routineId) {
                return redirect()->route('routine.index')->with('error', 'No estás suscrito a ninguna rutina.');
            }
            // si lo esta buscamos el primer ejercicio de la rutina
            $nextWorkout = Workout::where('routine_id', $routineId)
                ->where('order', 1)
                ->first();
        } else {
            // -  si llega aqui ya realizo algun entrenamiento
            $lastWorkout = Workout::find($lastUserWorkout->workout_id); // obtenemos el objeto Workout de el ultimo entrenamiento.
            // obtenemos el order del ultimo entrenamiento
            $order = $lastWorkout->order;
            // obtenemos el numero de days de la rutina
            $routine = Routine::find($lastWorkout->routine_id);
            $days = $routine->days; // obtenemos los días (en una semana) que dura esta rutina 
            // if ($order < $days) {
            // realizamos el entrenamiento de esa rutina con el order +1
            $nextWorkout = Workout::where('routine_id', $routine->id)
                ->where('order', $order < $days ? $order + 1 : 1)
                ->first();
        }

        $nextWorkoutId = $nextWorkout->id;
        $routineId = $nextWorkout->routine_id;
        $workoutExercises = Workout::with(['exercises' => function ($query) {
            $query->select('exercises.id', 'exercises.name', 'exercises.max_reps_desired', 'exercises.min_reps_desired', 'exercises_workouts.num_series');
        }])
            ->find($nextWorkoutId);

        if ($workoutExercises && $workoutExercises->exercises->isNotEmpty()) {
            return view('workouts.create', compact('workoutExercises'));
        } else {
            return redirect()->route('routine.index')->with('error', 'No se pudieron recuperar los ejercicios de este entrenamiento.');
        }
        //return view('workouts.create', compact('exercises', 'nextWorkout', 'workoutExercises'));
        return view('workouts.create', compact('workoutExercises'));
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
        dd($request->input('exercises'));
        exit;
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
