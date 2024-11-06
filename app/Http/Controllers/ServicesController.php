<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function index()
    {
        try {
            //code...
            $services = Servicio::all();

            return response()->json(["servicios" => $services]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }

    }
    public function view()
    {

    }
    public function new(Request $request)
    {
        try {
            //code...
            $service = Servicio::create([
                'tipo_de_servicio' => $request->tipo,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'id_usuario' => $request->id_usuario
            ]);
            return response()->json(["new service: " => $service]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["error: " => $th->getMessage()]);
        }
    }
}
