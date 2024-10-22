<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    // Obtener todos los usuarios
    public function index(Request $request)
    {
        $users = User::all();
        
        return response()->json(['users' => $users], 200);  // Respuesta con código 200
    }
    
    // Ver un usuario específico
    public function view(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    // Crear un nuevo usuario (Registro)
    public function new(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'tipo' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            // Crear el nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),  // Encriptar la contraseña
                'tipo' => $request->tipo ?? 'usuario'
            ]);

            return response()->json(['user' => $user, 'message' => 'Usuario registrado exitosamente'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al registrar el usuario: ' . $th->getMessage()], 500);
        }
    }

    // Actualizar un usuario existente
    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'tipo' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Actualizar los datos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Solo actualizar la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);  // Encriptar la nueva contraseña
        }

        $user->tipo = $request->tipo ?? $user->tipo;
        $user->save();

        return response()->json(['user' => $user, 'message' => 'Usuario actualizado correctamente'], 200);
    }

}
