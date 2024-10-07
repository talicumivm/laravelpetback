<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id(); // ID_MASCOTA
            $table->string('nombre');
            $table->string('especie');
            $table->string('raza');
            $table->decimal('peso', 5, 2);
            $table->integer('edad');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade'); // FK con users (dueño de la mascota)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};
