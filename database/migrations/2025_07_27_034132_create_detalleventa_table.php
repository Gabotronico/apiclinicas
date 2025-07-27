<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalleventa', function (Blueprint $table) {
            $table->id('IdDetalleVenta');
            $table->unsignedBigInteger('IdProducto');
            $table->unsignedBigInteger('IdVenta');
            $table->integer('Cantidad');
            $table->float('PrecioUnitario');
            $table->float('SubTotal');
            $table->timestamps();

            $table->foreign('IdProducto')->references('IdProducto')->on('productos');
            $table->foreign('IdVenta')->references('IdVenta')->on('venta');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalleventa');
    }
};
