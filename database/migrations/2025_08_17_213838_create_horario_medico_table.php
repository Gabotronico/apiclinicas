<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horario_medicos', function (Blueprint $table) {
    $table->id('id_horario');
    $table->unsignedBigInteger('id_medico');
    $table->string('dia_semana', 15); // Ej: 'Lunes', 'Martes'
    $table->time('hora_inicio');
    $table->time('hora_fin');
    $table->enum('estado', ['activo', 'inactivo'])->default('activo');
    $table->timestamps(); // Agrega created_at y updated_at automáticamente

    $table->foreign('id_medico')->references('id_medico')->on('medicos')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horario_medicos');
    }
};

