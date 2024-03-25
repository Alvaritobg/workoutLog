<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Controlador RoutineController
 *
 * Este controlador gestiona las operaciones CRUD para las rutinas en la aplicación.
 * Permite a los usuarios crear, visualizar, actualizar y eliminar rutinas, así como
 * ver un listado de todas las rutinas disponibles. Cada método dentro de este controlador
 * está diseñado para manejar una operación específica relacionada con las rutinas.
 *
 * @package App\Http\Controllers
 */
class RoutineController extends Controller
{
    /**
     * Muestra un listado de todas las rutinas disponibles.
     *
     * Este método responde a una solicitud GET y se encarga de recuperar todas las rutinas
     * almacenadas en la base de datos, incluyendo información relacional importante como
     * los datos del entrenador (usuario) que creó cada rutina.
     *
     * Si la operación se realiza con éxito, se devuelve una vista con un listado de las rutinas.
     * En caso de que ocurra un error inesperado durante la operación, se captura la excepción
     * y se redirige al usuario a una ruta segura, mostrando un mensaje de error para informar
     * al usuario sobre el problema.
     *
     * @return \Illuminate\Http\Response Devuelve una vista con todas las rutinas si la operación
     * es exitosa, o redirige al usuario con un mensaje de error si se produce una excepción.
     */
    public function index()
    {
        try {
            // Intenta obtener las rutinas con paginación, incluyendo los datos del entrenador que la creó.
            // El método paginate() recibe como parámetro el número de items por página.
            // Por ejemplo, para paginar de 10 en 10, usa paginate(10).
            $routines = Routine::with('user')->paginate(10);
            // Devuelve la vista con las rutinas.
            return view('routines.index', compact('routines')); // Devuelve la vista con las rutinas.
        } catch (\Exception $e) {
            // Si algo sale mal
            // Redirige al usuario a y muestra un error
            // Asegúrate de tener una vista o ruta de 'error' definida.
            return back()->with('error', 'Ocurrió un error al intentar obtener las rutinas.');
        }
    }

    /**
     * Muestra el formulario para crear una nueva rutina.
     *
     * Este método responde a una solicitud GET y devuelve la vista que contiene
     * el formulario necesario para capturar la información de una nueva rutina.
     *
     * @return \Illuminate\View\View Retorna la vista `routines.create` que contiene
     * el formulario para introducir los datos de la nueva rutina.
     */
    public function create()
    {
        if (!auth()->user()->hasActivePaidSubscription()) {
            return redirect()->back()->with('error', 'Necesitas tener una suscripción activa para crear nuevas rutinas')->withInput();
        }
        try {
            // Obtener todos los ejercicios disponibles
            $exercises = Exercise::all();

            // Verificar si $exercises es null o vacío
            if (!$exercises || $exercises->isEmpty()) {
                throw new \Exception("No hay ejercicios disponibles");
            }

            return view('routines.create', compact('exercises'));
        } catch (\Exception $e) {
            return redirect()->route('routines.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Almacena una nueva rutina en la base de datos.
     *
     * Este método valida primero los datos enviados a través del formulario utilizando reglas específicas,
     * incluyendo una validación de formato para algunos campos como 'name' y 'description', y luego intenta crear
     * y guardar una nueva instancia de Rutina en la base de datos con esos datos. También maneja la carga de imágenes,
     * asegurando que el archivo se mueva al directorio público y que su nombre se asigne correctamente a la nueva rutina.
     * Si todo es exitoso, redirige al usuario a una ruta especificada con un mensaje de éxito. En caso de error,
     * redirige al usuario de vuelta al formulario de creación con un mensaje de error.
     *
     * @param  \Illuminate\Http\Request  $request  Datos enviados desde el formulario.
     * @return \Illuminate\Http\Response  Redirige al usuario a una ruta específica dependiendo del resultado de la operación.
     */
    public function store(Request $request)
    {
        //dd($request);
        // Valida los datos del formulario.
        $request->validate([
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'description' => 'required|string|max:255|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'days' => 'integer|nullable|min:1|max:7',
            'duration' => 'integer|nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'workouts.*.*' => 'integer|exists:exercises,id', // Verifica que cada ejercicio exista en la base de datos
        ]);

        // Verificación manual de duplicados en workouts
        $noDuplicateExercises = true;
        foreach ($request->workouts as $day => $exercises) {
            if (count($exercises) !== count(array_unique($exercises))) {
                $noDuplicateExercises = false;
                break;
            }
        }

        if (!$noDuplicateExercises) {
            return redirect()->back()->with('error', 'Hay ejercicios duplicados en los entrenamientos introducidos')->withInput();
        }

        try {
            // Crea y configura la nueva rutina.
            $routine = new Routine();
            $routine->name = $request->name;
            $routine->description = $request->description;
            $routine->user_id = Auth::id(); // Asigna el ID del usuario autenticado.
            $routine->days = $request->days;
            $routine->duration = $request->duration;

            if ($request->hasFile('img')) {
                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('images'), $imageName);
                $routine->img = $imageName;
            }

            $routine->save();

            foreach ($request->workouts as $indice => $workoutExercises) {
                $exerciseOrder = 0; // Inicia el orden del ejercicio para este workout.
                $workout =  Workout::create([
                    'name' => "Entrenamiento $indice | $routine->name",
                    'routine_id' => $routine->id,
                    'order' => $indice,
                ]);
                $newWorkoutId = $workout->id;
                foreach ($workoutExercises as $exerciseId) {
                    $exerciseOrder++;  // Incrementa el orden para el próximo ejercicio.
                    // guarda en la tabla intermedia exercises_workouts
                    $workout->exercises()->attach($exerciseId, ['order' => $exerciseOrder]);
                }
            }
            return redirect()->route('users.trainerRoutines', ['id' => Auth::id()])->with('success', 'Rutina creada');
        } catch (\Exception $e) {
            return redirect()->route('users.trainerRoutines', ['id' => Auth::id()])->with('error', 'Error al crear la rutina: ' . $e);
        }
    }

    /**
     * Muestra los detalles de una rutina específica.
     *
     * Este método intenta recuperar una rutina específica por su ID. Si la rutina
     * se encuentra, muestra una vista con los detalles de dicha rutina. En caso
     * contrario, si la rutina no existe, redirige al usuario a la lista general
     * de rutinas con un mensaje de error indicando que la rutina solicitada
     * no fue encontrada. Además, este método está preparado para manejar
     * excepciones inesperadas que puedan ocurrir durante la búsqueda de la rutina,
     * asegurando que el usuario sea redirigido de forma segura con un mensaje
     * de error adecuado.
     *
     * @param  string  $id  El ID de la rutina que se desea mostrar.
     * @return \Illuminate\Http\Response  Redirige a una vista con los detalles de la rutina o con un mensaje de error.
     */
    public function show($id)
    {
        try {
            // Intenta encontrar la rutina por su ID.
            // vieja consulta $routine = Routine::find($id);
            // Intenta encontrar la rutina por su ID con sus entrenamientos y los ejercicios de cada entrenamiento.
            $routine = Routine::with(['workouts.exercises'])->find($id);

            // Verificar si la rutina existe
            if (!$routine) {
                // Si no se encuentra la rutina, redirigir a la lista de rutinas
                // con un mensaje de error.
                return redirect()->route('routine.index')->with('error', 'No existe ninguna rutina con ese identificador.');
            } else {
                // Si la rutina existe, devolver una vista con los datos de la rutina
                return view('routines.detail', compact('routine'));
            }
        } catch (\Exception $e) {
            // Maneja cualquier otra excepción que pueda ocurrir
            //  y redirige al usuario a  la lista de rutinas
            // con un mensaje de error general.
            return redirect()->route('routine.index')->with('error', 'Ocurrió un error al intentar mostrar la rutina.');
        }
    }

    /**
     * Elimina una rutina específica de la base de datos.
     *
     * Este método intenta encontrar la rutina especificada por el ID proporcionado utilizando el método `findOrFail`.
     * Si la rutina se encuentra, se elimina. Si la eliminación es exitosa, redirige al usuario
     * a la vista anterior con un mensaje indicando que la rutina ha sido eliminada correctamente.
     *
     * Si la rutina no se encuentra (es decir, `findOrFail` lanza una `ModelNotFoundException`), o si ocurre algún otro error
     * durante el proceso de eliminación (capturado por el bloque `catch` general para `\Exception`), se captura la excepción
     * y se redirige al usuario a la vista anterior con un mensaje de error.
     *
     * @param  string  $id  El ID de la rutina que se desea eliminar.
     * @return \Illuminate\Http\Response  Redirige a la vista anterior con un mensaje de éxito o error.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->hasActivePaidSubscription()) {
            return redirect()->back()->with('error', 'Necesitas tener una suscripción activa para eliminar rutinas')->withInput();
        }
        try {
            $routine = Routine::findOrFail($id); // Busca la rutina o lanza una excerpción si no la encuentra.
            $routine->delete(); // Elimina la rutina.
            // Redirige a la vista anterior con un mensaje de éxito.
            return redirect()->route('users.trainerRoutines', ['id' => Auth::user()->id])->with('success', 'Rutina eliminada correctamente.');
        } catch (ModelNotFoundException   $e) {
            return redirect()->route('users.trainerRoutines', ['id' => Auth::user()->id])->with('error', 'No se pudo eliminar esta rutina.');
        } catch (\Exception $e) {
            return redirect()->route('users.trainerRoutines', ['id' => Auth::user()->id])->with('error', 'No se pudo eliminar esta rutina.');
        }
    }

    /**
     * Muestra el formulario de edición para una rutina específica.
     *
     * Intenta buscar la rutina por su ID utilizando `findOrFail`, lo que garantiza que
     * se lance una excepción `ModelNotFoundException` si la rutina no se encuentra.
     * Si la rutina se encuentra, se devuelve
     * la vista de edición con los datos de la rutina para que el usuario pueda editarlos.
     *
     * @param  int|string  $id  El ID de la rutina a editar.
     * @return \Illuminate\View\View  La vista de edición de rutinas con los datos de la rutina especificada.
     * @throws ModelNotFoundException Si no se encuentra la rutina con el ID proporcionado.
     */
    public function edit($id)
    {
        if (!auth()->user()->hasActivePaidSubscription()) {
            return redirect()->back()->with('error', 'Necesitas tener una suscripción activa para editar rutinas')->withInput();
        }
        try {
            // Busca la rutina por su ID y lanza una excepción ModelNotFoundException si no la encuentra.
            // Además, carga ansiosamente los entrenamientos y los ejercicios de esos entrenamientos.
            $routine = Routine::with(['workouts', 'workouts.exercises'])->findOrFail($id);

            $exercises = Exercise::all(); // Obtener todos los ejercicios

            // Devuelve la vista de edición de rutinas, pasando la rutina y los ejercicios encontrados a la vista.
            return view('routines.edit', compact('routine', 'exercises'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'No se pudo encontrar esta rutina.');
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al intentar editar esta rutina.');
        }
    }


    /**
     * Actualiza una rutina específica en la base de datos.
     *
     * Primero, valida los datos recibidos del formulario.
     * Luego, intenta buscar la rutina por su ID con `findOrFail`,
     * asegurando así que se lance una excepción `ModelNotFoundException` si no se encuentra
     * la rutina. Si la rutina existe, se actualizan sus atributos con los datos recibidos
     * y se guarda en la base de datos. Si se subió una imagen nueva, se procesa y actualiza
     * el nombre de la imagen en la rutina. Finalmente, redirige al usuario a la lista de
     * rutinas con un mensaje de éxito.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP con los datos del formulario.
     * @param  int|string  $id  El ID de la rutina a actualizar.
     * @return \Illuminate\Http\RedirectResponse  Redirección a la lista de rutinas con un mensaje de éxito.
     * @throws ModelNotFoundException Si no se encuentra la rutina con el ID proporcionado.
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        // Valida los datos del formulario.
        $request->validate([
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'description' => 'required|string|max:255|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'days' => 'integer|nullable|min:1|max:7',
            'duration' => 'integer|nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'workouts.*.*' => 'integer|exists:exercises,id', // Verifica que cada ejercicio exista en la base de datos
        ]);

        // Verificación manual de duplicados en workouts
        $noDuplicateExercises = true;
        foreach ($request->workouts as $day => $exercises) {
            if (count($exercises) !== count(array_unique($exercises))) {
                $noDuplicateExercises = false;
                break;
            }
        }

        if (!$noDuplicateExercises) {
            return redirect()->back()->with('error', 'Hay ejercicios duplicados en los entrenamientos introducidos')->withInput();
        }

        try {
            // Busca  la nueva rutina.
            // Busca la rutina existente por su ID.
            $routine = Routine::findOrFail($id);
            $routine->name = $request->name;
            $routine->description = $request->description;
            // No es necesario reasignar user_id durante la actualización.
            $routine->days = $request->days;
            $routine->duration = $request->duration;

            if ($request->hasFile('img')) {
                $imageName = time() . '.' . $request->img->extension();
                $request->img->move(public_path('images'), $imageName);
                $routine->img = $imageName;
            }

            $routine->save();

            // Para cada workout en el request
            foreach ($request->workouts as $day => $workoutExercises) {
                // Aquí, actualiza o crea el workout según necesites
                // Ejemplo simplificado, ajusta según tus necesidades
                $workout = Workout::firstOrCreate([
                    'routine_id' => $routine->id,
                    'name' => "Entrenamiento $day | $routine->name",
                    'order' => $day,
                ]);

                // Antes de adjuntar nuevos ejercicios, puedes querer limpiar los existentes
                $workout->exercises()->detach();

                $order = 1; // Inicializa un contador de orden para los ejercicios
                foreach ($workoutExercises as $exerciseId) {
                    // Adjunta el ejercicio al workout con el valor de 'order'
                    $workout->exercises()->attach($exerciseId, ['order' => $order]);
                    $order++; // Incrementa el contador de orden para el próximo ejercicio
                }
            }
            return redirect()->route('users.trainerRoutines', ['id' => Auth::id()])->with('success', 'Rutina creada');
        } catch (\Exception $e) {
            return redirect()->route('users.trainerRoutines', ['id' => Auth::id()])->with('error', 'Error al crear la rutina: ' . $e);
        }
    }
}
