<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\Workout;
use App\Models\UserWorkout;
use App\Models\Serie;
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
        // dd($lastUserWorkout);
        // exit;
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
            $query->select('*');
        }])
            ->find($nextWorkoutId);

        if ($workoutExercises && $workoutExercises->exercises->isNotEmpty()) {
            return view('workouts.create', compact('workoutExercises', 'nextWorkoutId', 'routineId'));
        } else {
            return redirect()->route('routine.index')->with('error', 'No se pudieron recuperar los ejercicios de este entrenamiento.');
        }
    }

    /**
     * Almacena un nuevo registro de entrenamiento en la base de datos.
     *
     * Este método valida la solicitud entrante para asegurarse de que contiene todos los datos necesarios
     * y en el formato esperado. Si la validación es exitosa, procede a registrar los detalles de los ejercicios
     * realizados por el usuario, incluyendo las series de cada ejercicio. Finalmente, registra un nuevo 
     * entrenamiento realizado por el usuario.
     *
     * @param  \Illuminate\Http\Request  $request Datos de la solicitud, incluidos ID de entrenamiento, ID de rutina y detalles de los ejercicios.
     * @return \Illuminate\Http\RedirectResponse Redirección hacia la vista de la rutina con un mensaje de éxito o error.
     */
    public function store(Request $request)
    {
        // Validación del request para asegurar datos correctos y completos.
        $validatedData = $request->validate([
            'workoutId' => 'required|integer|exists:workouts,id', // Asegura que el ID del entrenamiento exista y sea entero.
            'routineId' => 'required|integer|exists:routines,id', // Asegura que el ID de la rutina exista y sea entero.
            'exercises' => 'required|array', // Asegura que se envíen ejercicios en formato de array.
            'exercises.*.series' => 'required|array', // Asegura que cada ejercicio tenga series definidas.
            'exercises.*.series.*.used_weight' => 'required|numeric|min:1', // Valida el peso usado en cada serie.
            'exercises.*.series.*.repetitions' => 'required|integer|min:1', // Valida las repeticiones en cada serie.
        ]);
        try {
            $user = Auth::user(); // Obtiene el usuario autenticado.
            // Procesa cada ejercicio y sus series.
            if ($validatedData['exercises'] && is_array($validatedData['exercises'])) {
                foreach ($validatedData['exercises'] as $exerciseId => $seriesData) {
                    foreach ($seriesData['series'] as $seriesNumber => $data) {
                        // Crea un nuevo registro para cada serie de ejercicio realizada.
                        Serie::create([
                            'user_id' => $user->id,
                            'workout_id' => $validatedData['workoutId'],
                            'exercise_id' => $exerciseId,
                            'number' => $seriesNumber,
                            'used_weight' => $data['used_weight'],
                            'repetitions' => $data['repetitions'],
                            'date' => now()->format("Y-m-d H:i:s"), // Registra la fecha y hora actual.
                        ]);
                    }
                }

                // Registra el entrenamiento completado por el usuario.
                UserWorkout::create([
                    'workout_id' => $validatedData['workoutId'],
                    'user_id' =>  $user->id,
                    'execution_date' => now()->format("Y-m-d H:i:s"), // Registra la fecha y hora de ejecución del entrenamiento.
                ]);
            } else {
                // Si no se recibieron datos de ejercicios, devuelve un error.
                return back()->with('error', 'No se enviaron datos de ejercicios.');
            }

            // Redirecciona a la vista de la rutina con un mensaje de éxito.
            return redirect()->route('routine.show', ['id' => $validatedData['routineId']])->with('success', 'Entrenamiento registrado correctamente.');
        } catch (\Exception $e) {
            // En caso de error durante el proceso, redirecciona atrás con el mensaje de error.
            return back()->withInput()->with('error', 'Ocurrió un error al registrar el entrenamiento. Por favor, inténtalo de nuevo.');
        }
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