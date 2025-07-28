<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repartidor', function (Blueprint $table) {
            $table->id('IdRepartidor');
            $table->string('Nombre', 50);
            $table->integer('Telefono');
            $table->unsignedBigInteger('IdVehiculo');
            $table->timestamps();

            $table->foreign('IdVehiculo')->references('IdVehiculo')->on('vehiculo')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repartidor');
    }
};
