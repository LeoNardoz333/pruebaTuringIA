<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class Usuarios extends Controller
{
    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user)
            return response()->json(['mensaje' => 'El usuario no existe'], 404);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:30|min:2|regex:/^[A-Za-z+ÁÉÍÓÚáéíóúÑñ\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            'permisos' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('home')->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(!$user)
            return response()->json(['message' => 'El usuario no existe'],404);

       $validated = $request->validate([
            'nombre' => 'required|string|max:30|min:2|regex:/^[A-Za-z+ÁÉÍÓÚáéíóúÑñ\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            'permisos' => 'required|string',
            'confirm-password' => 'required|string|min:6|max:20',
        ]);

        if(isset($validated['contrasena']))
            $validated['contrasena'] = bcrypt($validated['contrasena']);

        $user->update($validated);
        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user)
            return response()->json(['message'=>'El usuario no existe'], 404);

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    public function validarLogin(Request $request)
    {
        #dd($request->all());
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        
        $key = 'login-attemps-' . $request->ip();
        if(RateLimiter::tooManyAttempts($key, 5)){
            throw ValidationException::withMessages([
                'password' => ['Demasiados intentos. Inténtalo de nuevo en unos minutos.'],
            ]);
        }

        if(Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ], $request->filled('remember'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();
            $usuario = User::where('email', $validated['email'])->first();
            if($usuario['permisos'] == 'admin')
                 return redirect()->intended(route('v_menu-admins'));
            else
            return redirect()->intended(route('v_menu-usuarios'));
        }

        RateLimiter::hit($key, 60);
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
