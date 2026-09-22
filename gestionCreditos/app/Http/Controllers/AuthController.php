<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar la pantalla de Login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('clientes.index');
        }
        return view('auth.login');
    }

    // Procesar el Inicio de Sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/clientes');
        }

        return back()->withErrors([
            'email' => 'El usuario o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    // Mostrar el formulario de Registro
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('clientes.index');
        }
        return view('auth.register');
    }

    // Procesar el Registro de Usuario
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.unique'       => 'Este correo electrónico ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min'       => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('clientes.index')->with('success', '¡Cuenta creada e inicio de sesión exitoso!');
    }

    // Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}