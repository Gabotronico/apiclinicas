<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta', function (Blueprint $table) {
            $table->id('IdVenta');
            $table->unsignedBigInteger('IdUsuario');
            $table->string('TipoVenta', 50);
            $table->dateTime('Fecha');
            $table->decimal('Total', 18, 2);
            $table->unsignedBigInteger('IdMetodoPago');
            $table->string('EstadoPedido', 50);
            $table->unsignedBigInteger('IdDireccion');
            $table->unsignedBigInteger('IdRepartidor');
            $table->timestamps();

            $table->foreign('IdUsuario')->references('IdUsuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('IdMetodoPago')->references('IdMetodoPago')->on('metodopago')->onDelete('cascade');
            $table->foreign('IdDireccion')->references('IdDireccion')->on('direcciones')->onDelete('cascade');
            $table->foreign('IdRepartidor')->references('IdRepartidor')->on('repartidor')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta');
    }
};
