<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de la clase base Authenticatable para autenticación.
use Spatie\Permission\Traits\HasRoles; // Importa el trait HasRoles para manejar roles y permisos con el paquete spatie/laravel-permission.
use Illuminate\Support\Facades\Auth;

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

    
    public function create()
    {     
        return view('routines.create');
    }

   
    public function store(Request $request)
    {
         
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'days'=> 'integer|nullable|min:1|max:7',
            'duration'=> 'integer|nullable',
            //'img'=> 'string|nullable'
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $routine = new Routine();
        $routine->name = $request->name;
        $routine->description = $request->description;
        $routine->user_id = Auth::id(); 
        $routine->days = $request->days;
        $routine->duration = $request->duration;
        //$routine->img = $request->img;
        if ($request->hasFile('img')) {
            $imageName = time().'.'.$request->img->extension(); // se usa time() para generar un nombre de archivo único y evitar sobreescrituras
            $request->img->move(public_path('images'), $imageName);
            $routine->img = $imageName;
        }
       
        $routine->save();

        return redirect()->route('users.trainerRoutines', ['id' => Auth::id()]);
        //->with('success', 'Rutina creada exitosamente.');
    
    }

   
    public function show($id)
    {
        // Buscar la rutina por su ID
    $routine = Routine::find($id);
        $ret;
    // Verificar si la rutina existe
    if (!$routine) {
        // Si no se encuentra la rutina, redirigir a la lista de rutinas
        $ret = redirect()->route('routine.index');
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
     * Remove the specified resource from storage.
     */
   
        public function destroy(string $id)
        {
            $routine = Routine::findOrFail($id);
            $routine->delete();
        
            // Redirigir de vuelta a la vista con un mensaje de éxito
            return back()->with('success', 'Rutina eliminada correctamente.');
        }

        public function edit($id)
{
        $routine = Routine::findOrFail($id);
        return view('routines.edit', compact('routine'));
}

        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'days'=> 'integer|nullable|min:1|max:7',
                'duration'=> 'integer|nullable',
                //'img'=> 'string|nullable'
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $routine = Routine::findOrFail($id);
            $routine->name = $request->name;
            $routine->description = $request->description;
            $routine->user_id = Auth::id(); 
            $routine->days = $request->days;
            $routine->duration = $request->duration;

            if ($request->hasFile('img')) {
                $imageName = time().'.'.$request->img->extension();  // se usa time() para generar un nombre de archivo único y evitar sobreescrituras
                $request->img->move(public_path('images'), $imageName);
                $routine->img = $imageName;
            }

            //$routine->update($request->all());
            $routine->save(); 
        
            return redirect()->route('routine.index')->with('success', 'Rutina actualizada correctamente');
        }
  
}
