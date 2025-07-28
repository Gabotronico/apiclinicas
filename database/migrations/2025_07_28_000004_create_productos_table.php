<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('IdProducto');
            $table->string('NombreProducto', 50);
            $table->float('Precio');
            $table->unsignedBigInteger('IdCategoria');
            $table->integer('Stock');
            $table->string('Imagen', 50)->nullable();
            $table->string('Archivo_RA', 50)->nullable();
            $table->timestamps();

            $table->foreign('IdCategoria')->references('IdCategoria')->on('categorias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
