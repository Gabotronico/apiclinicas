<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('id_cita');

            $table->unsignedBigInteger('id_usuario'); // paciente
            $table->unsignedBigInteger('id_medico');

            $table->date('fecha')->nullable();
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();

            $table->string('estado', 20)->default('pendiente');
            $table->string('motivo', 255)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->string('consultorio', 100)->nullable();

            $table->timestamps(); // Agrega created_at y updated_at

            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_medico')->references('id_medico')->on('medicos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
