<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class DatesController extends Controller
{
    public function index()
    {
        try {
            //code...
            $citas = Cita::all();
            return response()->json(["citas: " => $citas]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function view($id)
    {
        try {
            //code...
            $cita = Cita::findOrFail($id);

            return response()->json(["cita encontrada: " => $cita]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }
    public function new(Request $request)
    {
        try {
            // Verificar si el proveedor ya tiene una cita en la misma fecha y hora
            $citaExistente = Cita::where('id_proveedor', $request->id_proveedor)
                ->where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->first();

            if ($citaExistente) {
                return response()->json(["error" => "El proveedor ya tiene una cita en esa fecha y hora."],400);
            }
            // Si no existe cita, crear la nueva cita
            $cita = Cita::create([
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'id_mascota' => $request->id_mascota,
                'id_servicio' => $request->id_servicio,
                'id_proveedor' => $request->id_proveedor,
                'id_cliente' => $request->id_cliente
            ]);

            return response()->json(["nueva cita" => $cita]);

        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            //code...
            $cita = Cita::findOrFail($id);

            // Actualizar los campos de la cita
            $cita->update([
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'id_mascota' => $request->id_mascota,
                'id_servicio' => $request->id_servicio,
                'id_proveedor' => $request->id_proveedor,
                'id_cliente' => $request->id_cliente
            ]);
            
            return response()->json(["cita actualizada" => $cita]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            //code...
            $cita = Cita::findOrFail($id);

            $cita->delete();

            return response()->json(["cita eliminada" => $cita]);


        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function getPerUSer($id)
{
    try {
        // Buscar citas que tengan el id_cliente igual al $id del parámetro
        $citas = Cita::where('id_cliente', $id)->get();

        if ($citas->isEmpty()) {
            return response()->json(["mensaje" => "No se encontraron citas para este cliente."]);
        }

        return response()->json(["citas encontradas" => $citas]);

    } catch (\Throwable $th) {
        return response()->json(["error" => $th->getMessage()]);
    }
}
}
