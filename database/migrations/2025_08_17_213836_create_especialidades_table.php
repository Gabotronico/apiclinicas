<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('especialidades', function (Blueprint $table) {
            $table->id('id_especialidad');
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->timestamps(); // Opcional pero útil
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('especialidades');
    }
};
