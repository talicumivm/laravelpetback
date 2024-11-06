<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha', 
        'hora', 
        'id_mascota', 
        'id_servicio', 
        'id_proveedor', 
        'id_cliente'
    ];
    public function mascota()
{
    return $this->belongsTo(Mascota::class, 'id_mascota');
}

public function servicio()
{
    return $this->belongsTo(Servicio::class, 'id_servicio');
}

}
