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

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de perfil de usuario
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Método public que actualiza los datos del perfil de usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.regex' => 'El nombre contiene caracteres no permitidos.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'surname.regex' => 'El apellido contiene caracteres no permitidos.',
            'surname.min' => 'El apellido debe tener al menos 3 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email no tiene un formato válido.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.before_or_equal' => 'Debes ser mayor de 18 años.',
            'weight.numeric' => 'El peso debe ser un número.',
            'weight.min' => 'El peso debe ser mayor que cero.',
            'weight.max' => 'El peso no puede ser mayor que 999.',
           'current_password.required' => 'La contraseña actual es obligatoria.',
            'current_password.current_password' => 'La contraseña actual no es correcta.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.regex' => 'La nueva contraseña debe contener letras, números y al menos un carácter especial.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.', 
        ];
        $request->validate([
            'name' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3',
            'surname' => 'sometimes|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/|min:3',
            'email' => 'required|email',
            'date_of_birth' => 'required|date|before_or_equal:' . Carbon::now()->subYears(18)->toDateString(),
            'weight' => 'nullable|numeric|min:0.01|max:999',
            'current_password' => 'required|current_password',
            'update_password_password' => [
                'required',
                'max:50',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            "update_password_password_confirmation" => "required|min:8|max:50|same:password",
        ],$messages);
        
        //$request->user()->fill($request->all());
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        } 
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta de usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
