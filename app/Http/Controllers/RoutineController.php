<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $routines = Routine::all(); */
        $routines = Routine::with('user')->get();
        return view('routines.index', compact('routines'));
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
    public function show($id)
    {
        // Buscar la rutina por su ID
    $routine = Routine::find($id);
        $ret;
    // Verificar si la rutina existe
    if (!$routine) {
        // Si no se encuentra la rutina, puede devolver una respuesta de error o redirigir
        //return response()->json(['message' => 'Routine not found'], 404);
        // O alternativamente: 
        $ret = redirect()->route('routines.index');
    } else {
        // Si la rutina existe, devolver una vista con los datos de la rutina
        $ret = view('routines.detail', compact('routine'));
    }
        return  $ret;
    }


    /**
     * Display the specified resource.
     */
    public function showDetails($id)
    {
        // Buscar la rutina por su ID
        $routine = Routine::with('user')->find($id);
        $ret;
    // Verificar si la rutina existe
    if (!$routine) {
        // Si no se encuentra la rutina, puede devolver una respuesta de error o redirigir
        //return response()->json(['message' => 'Routine not found'], 404);
        // O alternativamente: 
        $ret = redirect()->route('routines.index');
    } else {
        // Si la rutina existe, devolver una vista con los datos de la rutina
        $ret = view('routines.detail', compact('routine'));
    }
        return  $ret;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Routine $routine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Routine $routine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routine $routine)
    {
        //
    }
}
