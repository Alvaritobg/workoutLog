<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;

/**
 * Controlador de manejo de contraseña del usuario.
 *
 * Este controlador se encarga de actualizar la contraseña del usuario.
 * Implementa validaciones robustas para garantizar la seguridad de la contraseña.
 */
class PasswordController extends Controller
{
    /**
     * Actualiza la contraseña del usuario autenticado.
     *
     * Este método valida la solicitud de cambio de contraseña, asegurándose de que
     * la contraseña actual sea correcta, y que la nueva contraseña cumpla con los
     * criterios establecidos (longitud mínima, inclusión de mayúsculas, minúsculas,
     * números y símbolos) y que la confirmación de la contraseña coincida.
     *
     * @param Request $request Datos de la solicitud, incluyendo la contraseña actual
     *                         y la nueva contraseña con su confirmación.
     * @return RedirectResponse Redirige al usuario a la página anterior con un mensaje
     *                          de estado indicando que la contraseña ha sido actualizada.
     */
    public function update(Request $request): RedirectResponse
    {
        // Valida la contraseña actual y la nueva contraseña con sus criterios.
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                PasswordRule::min(8) // Puedes cambiar el mínimo si lo deseas
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ],
        ]);

        // Actualiza la contraseña del usuario autenticado.
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Redirige al usuario a la página anterior con un mensaje de éxito.
        return back()->with('status', 'password-updated');
    }
}

