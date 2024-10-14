<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_de_pago',
        'monto',
        'metodo_de_pago',
        'id_cita'
    ];
}
