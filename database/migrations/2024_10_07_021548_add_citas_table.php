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
        Schema::create('citas', function (Blueprint $table) {
            $table->id(); // ID_CITA
            $table->date('fecha');
            $table->time('hora');
            $table->foreignId('id_mascota')->constrained('mascotas')->onDelete('cascade'); // FK con mascotas
            $table->foreignId('id_servicio')->constrained('servicios')->onDelete('cascade'); // FK con servicios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
