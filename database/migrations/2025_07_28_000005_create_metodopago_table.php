<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metodopago', function (Blueprint $table) {
            $table->id('IdMetodoPago');
            $table->string('NombreMetodo', 50);
            $table->string('Descripcion', 250)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metodopago');
    }
};
