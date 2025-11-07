<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\RateLimiter;

class Usuarios
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

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:30|min:2|regex:/^[A-Za-z+ÁÉÍÓÚáéíóúÑñ\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            'permisos' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente');
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'El usuario no existe.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:30|min:2|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|max:20',
            'permisos' => 'required|string|in:user,admin',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user)
            return response()->json(['message'=>'El usuario no existe'], 404);

        $user->delete();
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente');
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
            if($usuario['permisos'] == 'user' && $request->input('role') == 'admin')
                return redirect()->back()->withErrors(['email' => 'Este usuario no cuenta con permisos de administrador.']);
            else if($usuario['permisos'] == 'admin' && $request->input('role') == 'user')
                return redirect()->back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
            else if($usuario['permisos'] == 'admin')
                 return redirect()->intended(route('v_menu-admins'));
            else
            return redirect()->route('home');
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
