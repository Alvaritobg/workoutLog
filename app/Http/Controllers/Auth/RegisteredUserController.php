<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['string', 'max:255'],
            //'weight' => ['required', 'numeric', 'min:0', 'max:1000'],
            'weight' => ['nullable','numeric', 'min:0', 'max:1000'],
            'date_of_birth' => ['required', 'date'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'trainer' => ['required','in:true,false'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'weight' => $request->weight,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         // Asignar rol basado en el valor del campo 'entrenador'
        if ($request->trainer === 'true') {
        $user->assignRole('trainer');
        } else {
        $user->assignRole('user');
        }
        // Hace que los usuarios que se registren se les de el rol user en spatie
        //$user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
