<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class PetsController extends Controller
{
    public function index()
    {
        try {
            //code...
            $mascotas = Mascota::all();

            return response()->json(["mascotitas" => $mascotas]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['error' => $th->getMessage()]);
        }

    }

    public function view($id)
    {
        try {
            //code...
            $user = Mascota::findOrFail($id);


            return response()->json(['user' => $user]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["mascota no encontrada:" => $th->getMessage()]);
        }

    }

    public function new(Request $request)
    {
        try {
            //code...

            $mascota = Mascota::create([
                'nombre' => $request->nombre,
                'especie' => $request->especie,
                'raza' => $request->raza,
                'peso' => $request->peso,
                'edad' => $request->edad,
                'id_usuario' => $request->id_usuario,
            ]);

            return response()->json(["new mascota: " => $mascota]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            //code...
            $pet = Mascota::findOrFail($id);
            // Actualizar los campos de la cita
            $pet->update([
                'nombre' => $request->nombre,
                'especie' => $request->especie,
                'raza' => $request->raza,
                'peso' => $request->peso,
                'edad' => $request->edad,
                'id_usuario' => $request->id_usuario
            ]);
        
            return response()->json(["mascota editada" => $pet]);
        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            //code...
            $pet = Mascota::findOrFail($id);

            $pet->delete();

            return response()->json(["mascota eliminada: " => $pet]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }
}
