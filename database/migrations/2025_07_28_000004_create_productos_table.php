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
            $table->unsignedBigInteger('IdTalla')->nullable();    // FK a tallas
            $table->unsignedBigInteger('IdColor')->nullable();    // FK a colores
            $table->unsignedBigInteger('IdImagen')->nullable();   // FK a imagenes
            $table->string('Archivo_RA', 50)->nullable();
            $table->timestamps();

            $table->foreign('IdCategoria')->references('IdCategoria')->on('categorias')->onDelete('cascade');
            $table->foreign('IdTalla')->references('IdTalla')->on('tallas')->onDelete('set null');
            $table->foreign('IdColor')->references('IdColor')->on('colores')->onDelete('set null');
            $table->foreign('IdImagen')->references('IdImagen')->on('imagenes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
