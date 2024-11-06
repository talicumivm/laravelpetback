<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_de_servicio',
        'descripcion',
        'precio',
        'id_usuario'
    ];
    public function citas()
 {
    return $this->hasMany(Cita::class, 'id_servicio');
 }


}
