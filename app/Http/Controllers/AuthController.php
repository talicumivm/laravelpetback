<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validar los datos enviados desde el front-end
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|string',
            'tipo' => 'required|string'
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Crear el nuevo usuario
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Hashear la contraseña
            $user->tipo = $request->tipo; // Asignar el rol
            $user->save();

            // Devolver una respuesta exitosa con los datos del usuario (sin contraseña)
            return response()->json([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'tipo' => $user->tipo,
                ],
                'message' => 'Usuario registrado exitosamente'
            ], 201);

        } catch (\Exception $e) {
            // Manejar errores inesperados
            return response()->json(['error' => 'Error al registrar el usuario: ' . $e->getMessage()], 500);
        }
    }
}
