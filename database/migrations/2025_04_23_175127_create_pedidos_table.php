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
    // 1) Eliminamos la tabla si existía
    Schema::dropIfExists('pedidos');

    // 2) Creamos la tabla con la estructura correcta
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->string('numero')->unique();
        $table->date('fecha');
        $table->enum('estado_qr', ['pendiente','ejecutado','no_ejecutado'])
              ->default('pendiente');
        $table->foreignId('empresa_id')
              ->constrained('empresas')
              ->onDelete('cascade');
        $table->timestamps(3);

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
