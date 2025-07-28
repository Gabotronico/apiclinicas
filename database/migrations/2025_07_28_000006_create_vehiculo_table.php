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
            $table->string('Placa', 50);
            $table->string('Marca', 50);
            $table->string('Modelo', 50);
            $table->string('Tipo', 50);
            $table->integer('Año');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
