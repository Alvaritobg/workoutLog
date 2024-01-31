<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
    * Controlador para manejar el perfil del usuario.
    *
    * Este controlador se encarga de la visualización, actualización y eliminación
    * de la información del perfil del usuario autenticado.
    */

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición del perfil de usuario.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return View Vista de edición del perfil del usuario.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Actualiza los datos del perfil del usuario.
     *
     * Este método valida y actualiza los datos del perfil del usuario autenticado.
     * Incluye validaciones personalizadas para cada campo del formulario.
     *
     * @param ProfileUpdateRequest $request La solicitud HTTP con los datos del perfil.
     * @return RedirectResponse Redirige a la vista de edición del perfil con un mensaje de estado.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Mensajes personalizados para las validaciones
        $messages = [
            // Mensajes para validaciones del campo 'name'
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            
            // Mensajes para validaciones del campo 'surname'
            'surname.regex' => 'El apellido contiene caracteres no permitidos.',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres.',
            
            // Mensajes para validaciones del campo 'email'
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email no tiene un formato válido.',
            
            // Mensajes para validaciones del campo 'date_of_birth'
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.before_or_equal' => 'Debes ser mayor de 18 años.',
            
            // Mensajes para validaciones del campo 'weight'
            'weight.numeric' => 'El peso debe ser un número.',
            'weight.min' => 'El peso debe ser mayor que cero.',
            'weight.max' => 'El peso no puede ser mayor que 999.',

            // Mensajes para validaciones de la contraseña actual
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'current_password.current_password' => 'La contraseña actual no es correcta.',

            // Mensajes para validaciones de la nueva contraseña
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La nueva contraseña debe contener letras, números y al menos un carácter especial.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];

        // Validación de los campos del formulario con los mensajes personalizados
        $request->validate([
            'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3',
            'surname' => 'sometimes|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3',
            'email' => 'required|email',
            'date_of_birth' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->toDateString(),
            'weight' => 'nullable|numeric|min:0.01|max:999',
        ], $messages);

        // Actualización de los datos del usuario
        if ($request->user()->isDirty('email')) {
            // Si el email ha cambiado, se resetea la verificación del email
            $request->user()->email_verified_at = null;
        }

        // Rellena y guarda los datos del usuario con los datos validados
        $request->user()->fill($request->all());
        $request->user()->save();

        // Redirige al usuario de vuelta a la vista de edición del perfil con un mensaje de estado
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

   /**
     * Elimina la cuenta del usuario autenticado.
     *
     * Este método valida la contraseña actual del usuario y procede a eliminar
     * la cuenta del usuario. También realiza el cierre de sesión y regeneración
     * del token de la sesión.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return RedirectResponse Redirige a la página principal después de eliminar la cuenta.
     */
    public function destroy(Request $request): RedirectResponse
{
    // Valida que la contraseña proporcionada por el usuario sea correcta
    // 'userDeletion' es el nombre de la "bolsa" de errores, lo que permite manejar
    // los errores de validación específicos de esta acción de manera aislada
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    // Obtiene el usuario autenticado
    $user = $request->user();

    // Cierra la sesión del usuario
    Auth::logout();

    // Elimina el usuario de la base de datos
    $user->delete();

    // Invalida la sesión actual y regenera el token de la sesión
    // Esto es importante por razones de seguridad, especialmente después de una eliminación de cuenta
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirige al usuario a la página de inicio
    return Redirect::to('/');
}
}
