<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analisislaboratorio', function (Blueprint $table) {
            $table->id('id_analisis');

            $table->unsignedBigInteger('id_consulta'); // FK a la consulta
            $table->string('tipo', 100);               // Tipo de análisis (ej. Sangre, Orina, etc.)
            $table->text('resultado')->nullable();     // Resultado del análisis
            $table->text('observaciones')->nullable(); // Observaciones del laboratorio
            $table->date('fecha')->nullable();         // Fecha en la que se realizó el análisis
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('id_consulta')->references('id_consulta')->on('consultas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analisislaboratorio');
    }
};
