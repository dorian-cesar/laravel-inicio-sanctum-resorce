<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('AuthToken')->plainTextToken;
        return response()->json(['user' => $user, 'access_token' => $token]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}


    public function logout(Request $request)
    {
       // $request->user()->token()->revoke();
       auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function updatePassword(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si la contraseña actual proporcionada es correcta
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['message' => 'La contraseña actual es incorrecta'], 400);
        }

        // Actualizar la contraseña del usuario
        $user->password = bcrypt($request->new_password);
        $user->save();

        // Devolver una respuesta exitosa
        return response()->json(['message' => 'La contraseña se ha actualizado correctamente']);
    }
}