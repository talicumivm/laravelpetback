<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $users = User::all();

        return response()->json(['users' => $users]);
    }
    
    public function view(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
    }

    public function new(Request $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $tipo = $request->tipo ?? "usuario";
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'tipo' => $tipo
            ]);

            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully.',
            'user' => $user
        ], 200);

    }

}
