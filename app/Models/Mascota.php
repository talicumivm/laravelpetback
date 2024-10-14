<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', // Asegúrate de que el nombre coincide con el campo de la base de datos
        'especie',
        'raza',
        'peso',
        'edad',
        'id_usuario', // Asegúrate de que este campo coincide con tu clave foránea
    ];
}
