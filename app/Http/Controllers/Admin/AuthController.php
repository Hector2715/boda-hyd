<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        // Si ya está autenticado, lo redirige directamente al dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('admin.login');
    }

    /**
     * Procesa el intento de autenticación.
     */
    public function login(Request $request)
    {
        // 1. Validar los datos de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor introduce un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // 2. Intentar iniciar sesión (Laravel gestiona Hash y Cookies de sesión)
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        // 3. Si falla, regresar con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cierra la sesión del administrador.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar y borrar tokens de la sesión actual
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}