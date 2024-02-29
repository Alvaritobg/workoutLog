<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        return view('routines.create');
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
     * 
     * Este metodo no es necesario, BORRAR!!
     * 
     * Muestra los detalles de una rutina específica.
     * 
     * Intenta recuperar los detalles de una rutina específica por su ID, incluyendo información
     * del usuario (entrenador) asociado. Si la rutina no se encuentra, redirige al usuario
     * a la lista general de rutinas con un mensaje indicando que la rutina especificada
     * no fue encontrada. En caso de éxito, muestra una vista con los detalles de la rutina.
     * Este método también maneja cualquier excepción general que pueda ocurrir durante
     * el proceso de búsqueda y muestra, redirigiendo al usuario con un mensaje de error
     * genérico en caso de un error inesperado.
     * 
     * @param  string  $id  El ID de la rutina que se desea mostrar.
     * @return \Illuminate\Http\Response  Redirige a una vista con los detalles de la rutina o con un mensaje de error.
     */
    /*   public function showDetails($id)
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
    } */


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
