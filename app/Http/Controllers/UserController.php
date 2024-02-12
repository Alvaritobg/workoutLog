<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\BD;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
