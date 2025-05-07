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
        Schema::create('pedido_lineas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->integer('linea');
            $table->date('entrega');
            $table->string('almacen_chemical');
            $table->string('descripcion_chemical');
            $table->string('codigo_proveedor');
            $table->string('descripcion_proveedor');
            $table->string('codigo');
            $table->string('descripcion');
            $table->decimal('unidades', 10, 2);
            $table->timestamps(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_lineas');
    }
};
