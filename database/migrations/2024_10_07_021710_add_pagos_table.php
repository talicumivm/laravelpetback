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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id(); // ID_PAGO
            $table->date('fecha_de_pago');
            $table->decimal('monto', 8, 2);
            $table->string('metodo_de_pago');
            $table->foreignId('id_cita')->constrained('citas')->onDelete('cascade'); // FK con citas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
