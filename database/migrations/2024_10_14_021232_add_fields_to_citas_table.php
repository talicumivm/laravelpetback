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
        Schema::table('citas', function (Blueprint $table) {
            Schema::table('citas', function (Blueprint $table) {
                $table->foreignId('id_proveedor')->constrained('users')->onDelete('cascade'); // FK con users (proveedor)
                $table->foreignId('id_cliente')->constrained('users')->onDelete('cascade'); // FK con users (cliente)
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            Schema::table('citas', function (Blueprint $table) {
                $table->dropForeign(['id_proveedor']);
                $table->dropColumn('id_proveedor');
    
                $table->dropForeign(['id_cliente']);
                $table->dropColumn('id_cliente');
            });
        });
    }
};
