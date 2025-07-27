<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('IdUsuario');
            $table->string('Nombre', 50);
            $table->string('Email', 50)->unique();
            $table->string('password');
            $table->unsignedBigInteger('IdRol');
            $table->dateTime('FechaRegistro')->nullable();
            $table->timestamps();

            $table->foreign('IdRol')->references('IdRol')->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
