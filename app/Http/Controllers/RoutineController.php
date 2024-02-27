<?php

namespace App\Http\Controllers;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de la clase base Authenticatable para autenticación.
use Spatie\Permission\Traits\HasRoles; // Importa el trait HasRoles para manejar roles y permisos con el paquete spatie/laravel-permission.
use Illuminate\Support\Facades\Auth;
/**
 * Controlador para gestionar rutinas.
 * 
 * Este controlador maneja las vistas, creación, actualización,
 * y eliminación de rutinas en la aplicación.
 */
class RoutineController extends Controller
{
 /**
     * Muestra una lista de todas las rutinas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $routines = Routine::with('user')->get();// Obtiene todas las rutinas con su usuario relacionado.
        return view('routines.index', compact('routines'));// Devuelve la vista con las rutinas.
    }

    /**
     * Muestra el formulario para crear una nueva rutina.
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
            'name' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
            'description' => 'required|string|regex:/^[A-Za-z\s]+$/',
            'days'=> 'integer|nullable|min:1|max:7',
            'duration'=> 'integer|nullable|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    // Crea y configura la nueva rutina.
        $routine = new Routine();
        $routine->name = $request->name;
        $routine->description = $request->description;
        $routine->user_id = Auth::id(); // Asigna el ID del usuario autenticado.
        $routine->days = $request->days;
        $routine->duration = $request->duration;

        if ($request->hasFile('img')) {
            $imageName = time().'.'.$request->img->extension(); // se usa time() para generar un nombre de archivo único y evitar sobreescrituras
            $request->img->move(public_path('images'), $imageName);// Mueve la imagen al directorio público.
            $routine->img = $imageName; // Asigna el nombre de la imagen a la rutina.
        }
       
        $routine->save();// Guarda la rutina en la base de datos.
        return redirect()->route('users.trainerRoutines', ['id' => Auth::id()]); // Redirige al usuario.
    }

   /**
     * Muestra los detalles de una rutina específica.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    // Intenta encontrar la rutina por su ID.
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
     * Muestra los detalles de una rutina específica relacionada con un usuario en concreto indicado por el id de usuario.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetails($id)
    {
        // Buscar la rutina por su ID
        $routine = Routine::with('user')->find($id);
        $ret;
    // Verificar si la rutina existe
    if (!$routine) {
        $ret = redirect()->route('routines.index');
    } else {
        // Si la rutina existe, devolver una vista con los datos de la rutina
        $ret = view('routines.detail', compact('routine'));
    }
        return  $ret;
    }


    /**
     * Elimina una rutina específica de la base de datos.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $routine = Routine::findOrFail($id); // Busca la rutina o falla si no la encuentra.
        $routine->delete(); // Elimina la rutina.
        // Redirige a la vista anterior con un mensaje de éxito.
        return back()->with('success', 'Rutina eliminada correctamente.');
    }

        /**
     * Muestra el formulario de edición para una rutina específica.
     * 
     * @param  int|string  $id  El ID de la rutina a editar.
     * @return \Illuminate\View\View  La vista de edición de rutinas con los datos de la rutina especificada.
     */
    public function edit($id)
    {
        // Busca la rutina por su ID y lanza una excepción ModelNotFoundException si no la encuentra.
        $routine = Routine::findOrFail($id);    
        // Devuelve la vista de edición de rutinas, pasando la rutina encontrada a la vista.
        return view('routines.edit', compact('routine'));
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
        'name' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        'description' => 'required|string|regex:/^[A-Za-z\s]+$/',
        'days' => 'integer|nullable|min:1|max:7',
        'duration' => 'integer|nullable|min:1',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

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
        $imageName = time().'.'.$request->img->extension(); // Genera un nombre de archivo único.
        $request->img->move(public_path('images'), $imageName); // Mueve la imagen al directorio público.
        $routine->img = $imageName; // Actualiza el nombre de la imagen en la rutina.
    }

    // Guarda los cambios en la rutina en la base de datos.
    $routine->save(); 

    // Redirige al usuario a la lista de rutinas con un mensaje de éxito.
    return redirect()->route('routine.index')->with('success', 'Rutina actualizada correctamente');
    }
}