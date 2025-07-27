<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id('IdVehiculo');
            $table->string('Placa');
            $table->string('Marca');
            $table->string('Modelo');
            $table->string('Tipo');
            $table->integer('Año');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
