<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Controlador para gestionar rutinas.
 * 
 * Este controlador maneja las vistas, creación, actualización,
 * y eliminación de rutinas en la aplicación.
 */
class RoutineController extends Controller
{
    /**
     * Muestra una lista de todas las rutinas existentes junto con los datos del entrenador que la hizo.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Intenta obtener todas las rutinas con los datos del entrenador que la creo
            $routines = Routine::with('user')->get();
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
     * Muestra la vista con el formulario para crear una nueva rutina.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('routines.create');
    }

    /**
     * Almacena una nueva rutina en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Valida los datos del formulario.
        $request->validate([
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'description' => 'required|string|max:255|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'days' => 'integer|nullable|min:1|max:7',
            'duration' => 'integer|nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Crea y configura la nueva rutina.
            $routine = new Routine();
            $routine->name = $request->name;
            $routine->description = $request->description;
            $routine->user_id = Auth::id(); // Asigna el ID del usuario autenticado.
            $routine->days = $request->days;
            $routine->duration = $request->duration;

            if ($request->hasFile('img')) {
                $imageName = time() . '.' . $request->img->extension(); // se usa time() para generar un nombre de archivo único y evitar sobreescrituras
                $request->img->move(public_path('images'), $imageName); // Mueve la imagen al directorio público.
                $routine->img = $imageName; // Asigna el nombre de la imagen a la rutina.
            }

            $routine->save(); // Guarda la rutina en la base de datos.
            return redirect()->route('users.trainerRoutines', ['id' => Auth::id()])->with('success', 'Rutina creada'); // Redirige al usuario.
        } catch (\Exception $e) {
            return redirect()->route('rutinas.create')->with('error', 'Error al crear la rutina');
        }
    }

    /**
     * Muestra los detalles de una rutina específica.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Intenta encontrar la rutina por su ID.
            $routine = Routine::find($id);

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
     * Muestra los detalles de una rutina específica.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetails($id)
    {
        try {
            // Intenta buscar la rutina por su ID, incluyendo los datos del usuario (entrenador) que la crea.
            $routine = Routine::with('user')->find($id);

            // Verificar si la rutina existe.
            if (!$routine) {
                // Si no existe, se redirige a la lista de rutinas y se indica que no se encuentra.
                return redirect()->route('routines.index')->with('error', 'Rutina no encontrada.');
            } else {
                // Si la rutina existe, se devuelve una vista con los datos de la rutina.
                return view('routines.detail', compact('routine'));
            }
        } catch (\Exception $e) {
            // Maneja cualquier otra excepción que pueda ocurrir.
            // Redirige al usuario a una ruta segura (por ejemplo, la lista de rutinas)
            // con un mensaje de error general.
            return redirect()->route('routines.index')->with('error', 'Ocurrió un error al intentar mostrar los detalles de la rutina.');
        }
    }


    /**
     * Elimina una rutina específica de la base de datos.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        try {
            $routine = Routine::findOrFail($id); // Busca la rutina o lanza una excerpción si no la encuentra.
            $routine->delete(); // Elimina la rutina.
            // Redirige a la vista anterior con un mensaje de éxito.
            return back()->with('success', 'Rutina eliminada correctamente.');
        } catch (ModelNotFoundException   $e) {
            return back()->with('error', 'No se pudo eliminar esta rutina.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo eliminar esta rutina.');
        }
    }

    /**
     * Muestra el formulario de edición para una rutina específica.
     * 
     * @param  int|string  $id  El ID de la rutina a editar.
     * @return \Illuminate\View\View  La vista de edición de rutinas con los datos de la rutina especificada.
     */
    public function edit($id)
    {
        try {
            // Busca la rutina por su ID y lanza una excepción ModelNotFoundException si no la encuentra.
            $routine = Routine::findOrFail($id);
            // Devuelve la vista de edición de rutinas, pasando la rutina encontrada a la vista.
            return view('routines.edit', compact('routine'));
        } catch (ModelNotFoundException   $e) {
            return back()->with('error', 'No se pudo editar esta rutina.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo editar esta rutina.');
        }
    }

    /**
     * Actualiza una rutina específica en la base de datos.
     * 
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP que contiene los datos del formulario.
     * @param  int|string  $id  El ID de la rutina a actualizar.
     * @return \Illuminate\Http\RedirectResponse  Redirección a la lista de rutinas con un mensaje de éxito.
     */
    public function update(Request $request, $id)
    {
        // Valida los datos del formulario, asegurándose de que cumplen con los criterios especificados.
        $request->validate([
            'name' => 'required|string|min:3|max:50|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'description' => 'required|string|max:255|regex:/^[A-Za-z0-9\sáéíóúüñÁÉÍÓÚÜÑ.]+$/',
            'days' => 'integer|nullable|min:1|max:7',
            'duration' => 'integer|nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            // Busca la rutina por su ID y lanza una excepción ModelNotFoundException si no la encuentra.
            $routine = Routine::findOrFail($id);

            // Actualiza los atributos de la rutina con los valores recibidos del formulario.
            $routine->name = $request->name;
            $routine->description = $request->description;
            $routine->user_id = Auth::id(); // Asigna el ID del usuario autenticado como el usuario de la rutina.
            $routine->days = $request->days;
            $routine->duration = $request->duration;

            // Si se subió una imagen, la procesa y actualiza el nombre de la imagen en la rutina.
            if ($request->hasFile('img')) {
                $imageName = time() . '.' . $request->img->extension(); // Genera un nombre de archivo único.
                $request->img->move(public_path('images'), $imageName); // Mueve la imagen al directorio público.
                $routine->img = $imageName; // Actualiza el nombre de la imagen en la rutina.
            }

            // Guarda los cambios en la rutina en la base de datos.
            $routine->save();

            // Redirige al usuario a la lista de rutinas con un mensaje de éxito.
            return redirect()->route('routine.index')->with('success', 'Rutina actualizada correctamente');
        } catch (ModelNotFoundException   $e) {
            return back()->with('error', 'No se pudo editar esta rutina.');
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo editar esta rutina.');
        }
    }
}
