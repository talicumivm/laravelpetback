<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        try {
            //code...
            $payments = Pago::all();

            return response()->json(["pagos: " => $payments]);

        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(["error: " => $th->getMessage()]);
        }
    }

    public function new(Request $request)
    {
        try {
            // Inserción de los datos recibidos en la tabla 'pagos'
            $pago = Pago::create([
                'fecha_de_pago' => $request->fecha_de_pago,
                'monto' => $request->monto,
                'metodo_de_pago' => $request->metodo_de_pago,
                'id_cita' => $request->id_cita
            ]);

            return response()->json(["nuevo pago" => $pago]);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
    }



}
