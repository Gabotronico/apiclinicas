<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id('IdDireccion');
            $table->unsignedBigInteger('IdUsuario');
            $table->string('Direccion', 50);
            $table->string('Ciudad', 50);
            $table->float('Latitud')->nullable();
            $table->float('Longitud')->nullable();
            $table->string('Referencia')->nullable();
            $table->timestamps();

            $table->foreign('IdUsuario')->references('IdUsuario')->on('usuarios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
