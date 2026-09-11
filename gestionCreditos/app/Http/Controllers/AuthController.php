<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}