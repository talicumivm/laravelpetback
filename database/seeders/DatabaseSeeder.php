<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Servicio;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
                // Insertar datos directamente en la tabla `users`
                $user = User::create([
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                    'password' => bcrypt('password'),
                    'tipo'=> 'duenio'
                ]);
        
                // Insertar datos directamente en la tabla `servicios`
                $service = Servicio::create([
                    'tipo_de_servicio' => 'Consulta Veterinaria',
                    'descripcion' => 'Revisión general de la mascota',
                    'precio' => 5000,
                    'id_usuario' => 8, // Asignando el proveedor 1, que debe existir en la tabla users
                ]);
        
                // Insertar más datos en otras tablas como 'mascotas', 'citas', etc.
                $mascota = Mascota::create([
                    'nombre' => 'Max',
                    'especie' => 'Perro',
                    'raza' => 'Golden Retriever',
                    'peso' => 30.5,
                    'edad' => 3,
                    'id_usuario'=> 8
                ]);
    }
}
