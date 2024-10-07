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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id(); // ID_SERVICIO
            $table->string('tipo_de_servicio');
            $table->text('descripcion');
            $table->decimal('precio', 8, 2);
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade'); // FK con users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
