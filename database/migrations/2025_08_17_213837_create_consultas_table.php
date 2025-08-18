<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('id_consulta');

            $table->unsignedBigInteger('id_cita');
            $table->unsignedBigInteger('id_usuario');  // Médico
            $table->unsignedBigInteger('id_paciente'); // Paciente

            $table->string('motivo', 255)->nullable();
            $table->string('diagnostico', 255)->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('indicaciones')->nullable();
            $table->date('proxima_cita')->nullable();

            $table->timestamp('fecha_registro')->useCurrent(); // o $table->timestamps();

            // Foreign keys
            $table->foreign('id_cita')->references('id_cita')->on('citas')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_paciente')->references('id_paciente')->on('pacientes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
