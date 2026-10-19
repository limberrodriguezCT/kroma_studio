<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Procesa la petición de registro con mensajes personalizados en español.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ], [
            'name.required'      => 'Debes ingresar tu nombre completo o rol en el estudio.',
            'name.min'           => 'El nombre debe tener al menos :min caracteres.',
            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.email'        => 'Ingresa una dirección de correo electrónico válida.',
            'email.lowercase'    => 'El correo electrónico debe escribirse en minúsculas.',
            'email.unique'       => 'Este correo electrónico ya está registrado en Kroma Studio.',
            'password.required'  => 'Debes definir una contraseña de acceso.',
            'password.min'       => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('projects.index', absolute: false))
            ->with('success', '¡Cuenta de autor creada y sesión iniciada en Kroma Studio!');
    }
}