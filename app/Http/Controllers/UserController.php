<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Routine;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use App\Models\Subscription;
use Spatie\Permission\Models\Role;



class UserController extends Controller
{
    /**
     * Muestra un listado paginado de los usuarios con sus roles asociados.
     *
     * Intenta recuperar todos los usuarios junto con sus roles de la base de datos,
     * paginando el resultado para mejorar la usabilidad en la interfaz de usuario.
     * En caso de que ocurra un error durante la recuperación de los datos (por ejemplo,
     * un problema de conexión a la base de datos), se captura la excepción, y se
     * redirige al usuario a una ruta segura con un mensaje de error.
     *
     * @return \Illuminate\Http\Response Retorna la vista 'users.manageUsers' con los usuarios
     *                                   y sus roles, o redirige con un mensaje de error si
     *                                   se produce una excepción.
     */
    public function index()
    {
        try {
            // Recupera todos los usuarios y sus roles, paginando el resultado.
            $users = User::with('roles')->paginate(10);

            // Retorna la vista con los usuarios y sus roles para su gestión.
            return view('users.manageUsers', compact('users'));
        } catch (Exception $e) {
            // Redirige al usuario a una ruta segura con un mensaje de error.
            return back()->with('error', 'Ocurrió un error al intentar mostrar la lista de usuarios.');
        }
    }
    /**
     * Muestra las rutinas creadas por el usuario autenticado.
     *
     * Este método verifica primero si el ID del usuario proporcionado coincide con el
     * ID del usuario autenticado para asegurar que los usuarios solo puedan ver sus propias rutinas.
     * Si el usuario intenta acceder a las rutinas de otro usuario, será redirigido al 'dashboard'
     * con un mensaje de error. Si el ID coincide, el método intenta recuperar y mostrar las rutinas
     * del usuario autenticado. En caso de error durante la consulta a la base de datos, se maneja
     * la excepción redirigiendo al usuario con un mensaje de error adecuado.
     *
     * @param  int|string  $userId  El identificador del usuario cuyas rutinas se quieren obtener.
     * @return \Illuminate\Http\Response  Retorna la vista con las rutinas del usuario o redirige
     *                                    con un mensaje de error en caso de intento de acceso no autorizado
     *                                    o error en la recuperación de datos.
     */
    public function obtainCreatedRoutines($userId)
    {
        // Verifica si el ID del usuario proporcionado coincide con el ID del usuario autenticado.
        if ($userId != Auth::id()) {
            // Redirige al 'dashboard' con un mensaje de error si el usuario intenta ver rutinas de otros entrenadores.
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para ver las rutinas de otros entrenadores.');
        } else {
            try {
                // Realiza la consulta para obtener las rutinas creadas por el usuario con paginación.
                $userRoutines = Routine::where('user_id', $userId)->paginate(10);
                // Retorna la vista correspondiente, pasando las rutinas obtenidas.
                return view('users.trainerRoutines', compact('userRoutines'));
            } catch (Exception $e) {
                // Redirige al usuario a una ruta segura (como el dashboard o la página anterior) con un mensaje de error.
                return redirect()->route('dashboard')->with('error', 'Ocurrió un error al intentar mostrar las rutinas creadas.');
            }
        }
    }

    /**
     * Suscribe un usuario a una rutina específica.
     *
     * Este método valida los datos entrantes para asegurarse de que tanto el ID del usuario
     * como el ID de la rutina sean enteros y existan en sus respectivas tablas. Adicionalmente,
     * verifica que el usuario autenticado esté intentando suscribirse a sí mismo y no a otro usuario,
     * asegurando que un usuario solo pueda suscribirse a su propia cuenta. Luego, comprueba que el
     * usuario no esté ya suscrito a alguna rutina y, finalmente, procede a suscribir al usuario a la
     * rutina deseada si pasa todas las verificaciones.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Retorna a la página anterior con un mensaje de éxito o de error,
     *                                   dependiendo del resultado de la operación.
     */
    public function subscribeUserToRoutine(Request $request)
    {
        try {
            // Validar el request
            $validatedData = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'routine_id' => 'required|integer|exists:routines,id',
            ]);

            // Comprobamos que no se manipuló el ID del usuario evitando que suscriba a otro usuario.
            if ($validatedData['user_id'] != Auth::id()) {
                return back()->with('error', 'No tiene permisos para suscribir a otro usuario.');
            }

            // Encontrar el usuario y la rutina usando los IDs proporcionados
            $user = User::findOrFail($validatedData['user_id']);
            $routine = Routine::findOrFail($validatedData['routine_id']);

            // Verificar si el usuario ya está suscrito a alguna rutina.
            if ($user->routine_id != null) {
                return back()->with('error', 'Ya está suscrito a una rutina.');
            }

            // Verificar si el usuario ya está suscrito a la rutina específica.
            if ($user->routine_id === $routine->id) {
                return back()->with('error', 'Ya está suscrito a esta rutina.');
            }

            // Suscribir al usuario a la rutina seleccionada.
            $user->routine_id = $routine->id;
            $user->save();

            // Retornar a la página anterior con un mensaje de éxito.
            return back()->with('success', 'Suscripción realizada con éxito.');
        } catch (Exception $e) {
            // Redirigir al usuario a la página anterior con un mensaje de error en caso de una excepción.
            return back()->with('error', 'Ocurrió un error al intentar suscribir al usuario a la rutina. Por favor, intente de nuevo.');
        }
    }

    /**
     * Desuscribe un usuario de una rutina específica.
     *
     * Este método valida los datos entrantes para asegurarse de que tanto el ID del usuario
     * como el ID de la rutina existan en sus respectivas tablas. Además, verifica que el usuario
     * autenticado esté intentando desuscribirse a sí mismo y no a otro usuario, asegurando que
     * un usuario solo pueda desuscribirse de su propia cuenta. Si el usuario está efectivamente
     * suscrito a la rutina especificada, procede a desuscribir al usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response Retorna a la página anterior con un mensaje de éxito o de error,
     *                                   dependiendo del resultado de la operación.
     */
    public function unSubscribeUserFromRoutine(Request $request)
    {
        try {
            // Validar el request
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'routine_id' => 'required|exists:routines,id',
            ]);

            // Comprobar que el usuario no está intentando desuscribir a otro usuario
            if ($validatedData['user_id'] != Auth::id()) {
                return back()->with('error', 'No tiene permisos para desuscribir a otro usuario.');
            }

            // Encontrar el usuario usando el ID proporcionado
            $user = User::findOrFail($validatedData['user_id']);

            // Verificar si el usuario está suscrito a la rutina especificada
            if ($user->routine_id != $validatedData['routine_id']) {
                return back()->with('error', 'No está suscrito a esta rutina.');
            }

            // Desuscribir al usuario de la rutina
            $user->routine_id = null;
            $user->save();

            // Retornar a la página anterior con un mensaje de éxito
            return back()->with('success', 'Ya no está suscrito a esta rutina.');
        } catch (Exception $e) {
            // Redirigir al usuario a la página anterior con un mensaje de error
            return back()->with('error', 'Ocurrió un error al intentar desuscribir al usuario de la rutina. Por favor, intente de nuevo.');
        }
    }


    /**
     * Elimina un usuario específico de la base de datos.
     *
     * Antes de proceder con la eliminación, verifica si el usuario autenticado tiene el rol de 'admin'.
     * Si no es así, impide la acción y devuelve un mensaje de error. Si el usuario tiene permisos y
     * el usuario objetivo existe, procede con la eliminación. Maneja las excepciones para los casos
     * en que el usuario no se encuentre o ocurran errores durante el proceso de eliminación.
     *
     * @param  string  $id  El ID del usuario a eliminar.
     * @return \Illuminate\Http\Response  Redirige al usuario a la página anterior con un mensaje
     *                                    de éxito o error, dependiendo del resultado de la operación.
     */
    public function destroy(string $id)
    {
        // Comprueba si el usuario autenticado tiene el rol 'admin'
        if (!Auth::user()->hasRole('admin')) {
            // Si el usuario autenticado no es un administrador, redirige con un mensaje de error
            return back()->with('error', 'No tiene permisos para eliminar usuarios.');
        }

        try {
            // Busca el usuario por su ID o falla con una excepción ModelNotFoundException
            $user = User::findOrFail($id);

            // Intenta eliminar el usuario
            $user->delete();

            // Si la eliminación fue exitosa, redirige con un mensaje de éxito
            return back()->with('success', 'Usuario eliminado correctamente.');
        } catch (ModelNotFoundException $e) {
            // Si no se encuentra el usuario, redirige con un mensaje de error
            return back()->with('error', 'El usuario no existe.');
        } catch (Exception $e) {
            // Captura otras excepciones y redirige con un mensaje de error general
            return back()->with('error', 'Ocurrió un error al intentar eliminar el usuario. Por favor, intente de nuevo.');
        }
    }

    /**
     * Obtiene los usuarios que tienen asignadas rutinas creadas por el usuario autenticado.
     *
     * Este método recupera y muestra los usuarios que están asignados a las rutinas creadas por
     * el usuario autenticado. Utiliza paginación para gestionar la visualización de los resultados.
     *
     * @return \Illuminate\Http\Response  Devuelve la vista con el listado de usuarios y sus rutinas asignadas.
     */
    public function getUsersWithTheirRoutines()
    {
        try {
            // Obtener los IDs de rutinas creadas por el usuario autenticado.
            $routineIdsCreatedByUser = Routine::where('user_id', Auth::id())->pluck('id');

            // Obtener usuarios que tienen una rutina creada por este usuario con paginación.
            $users = User::whereIn('routine_id', $routineIdsCreatedByUser)->paginate(10); // cantidad de items que deseas por página

            // Enviar el listado de usuarios a la vista.
            return view('users.trainerClients', compact('users'));
        } catch (Exception $e) {
            // Captura cualquier excepción que pueda ocurrir durante la operación y redirige al usuario
            // a una página segura (como el dashboard) con un mensaje de error.
            return redirect()->route('dashboard')->with('error', 'Ocurrió un error al intentar obtener los usuarios con sus rutinas. Por favor, intentelo de nuevo.');
        }
    }

    /**
     * REVISAR CUANDO SE MODIFIQUE LA BD Y SE DEJE BIEN EL TEMA DE LAS RUTINAS!!!!
     */
    public function listUserWorkouts($userId)
    {

        $trainings = User::with(['workouts.exercises.series' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->find($userId);

        if (!$trainings) {
            // Redirige a una ruta o vista con un mensaje de error si el usuario no se encuentra
            return redirect()->route('users.listUserTrainings')->withErrors('Usuario no encontrado');
        }

        // Pasa el usuario y sus entrenamientos a la vista
        return view('users.listUserTrainings', compact('trainings'));
    }
}
