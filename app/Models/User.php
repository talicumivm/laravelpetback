<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo'
    ];

    /**
     * Los atributos que deben ser ocultados al serializar.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a otros tipos de datos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Función para encriptar la contraseña automáticamente.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relación hasMany para las citas donde el usuario es el proveedor (por ejemplo, un veterinario)
     */
    public function citasComoProveedor()
    {
        return $this->hasMany(Cita::class, 'id_proveedor');
    }

    /**
     * Relación hasMany para las citas donde el usuario es el cliente (dueño de la mascota)
     */
    public function citasComoCliente()
    {
        return $this->hasMany(Cita::class, 'id_cliente');
    }
}
