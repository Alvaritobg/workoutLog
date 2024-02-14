<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\BD;
use App\Models\User;
use App\Models\Routine;
use App\Models\Subscription;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * // Obtener todos los usuarios con sus roles asociados paginados de 10 en 10
     */
    public function index()
    {
          
          $users = User::with('roles')->paginate(4);

          // Retornar la vista con los usuarios y sus roles
          return view('users.manageUsers', compact('users'));
    }
    /**
     * Obtiene las rutinas creadas por un usuario específico.
     *
     * Este método recupera todas las rutinas asociadas a un usuario basado en su ID. Si el usuario existe,
     * devuelve una colección de rutinas; de lo contrario, devuelve una colección vacía. Los datos recuperados
     * se envían a una vista específica para su visualización.
     *
     * @param  int  $userId  El ID del usuario del cual obtener las rutinas creadas.
     * @return \Illuminate\View\View  Retorna una vista con las rutinas asociadas al usuario especificado.
     *                                La colección de rutinas se pasa a la vista con el nombre 'userRoutine'.
     */
    public function obtainCreatedRoutines($userId)
    {
        $userRoutine = User::where('id',$userId)->with('routines')->first();
        $userRoutine = $userRoutine ? $userRoutine->routines : collect([]);

        return view('users.trainerRoutines', compact('userRoutine'));     
    }

    /**
     * Suscribe un usuario a una rutina.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribeUserToRoutine(Request $request)
    {
        // Validar el request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'routine_id' => 'required|exists:routines,id',
        ]);
    
        // Encontrar el usuario y la rutina usando los IDs proporcionados
        $user = User::find($validatedData['user_id']);
        $routine = Routine::find($validatedData['routine_id']); // Asegúrate de que el nombre del modelo es 'Routine', no 'Routines'
    
        // Verificar si el usuario ya está suscrito a la rutina
        if ($user->routine_id === $routine->id) {
            return back()->with('error', 'Ya está suscrito a esta rutina.');
        }
    
        // Suscribir al usuario a la rutina
        $user->routine_id = $routine->id;
        $user->save();
    
        // Retornar a la página anterior con un mensaje de éxito
        return back()->with('success', 'Suscripción realizada con éxito.');
    }

     /**
     * Desuscribe un usuario de una rutina.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unSubscribeUserFromRoutine(Request $request)
    {
        // Validar el request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'routine_id' => 'required|exists:routines,id',
        ]);

        // Encontrar el usuario usando el ID proporcionado
        $user = User::find($validatedData['user_id']);

        // Verificar si el usuario está suscrito a la rutina especificada
        if ($user->routine_id != $validatedData['routine_id']) {
            return back()->with('error', 'No está suscrito a esta rutina.');
        }

        // Desuscribir al usuario de la rutina
        $user->routine_id = null; // Lo deja a null, es decir sin rutina asociada
        $user->save();

        // Retornar a la página anterior con un mensaje de éxito
        return back()->with('success', 'Ya no está suscrito a esta rutina.');
    }

    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Elimina el usuario con el id especificado
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    
        // Redirigir de vuelta a la vista con un mensaje de éxito
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
