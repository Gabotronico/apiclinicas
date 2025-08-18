<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
        $table->id('id_medico');

    // Usa foreignId() directamente (más legible y claro en Laravel 8+)
        $table->foreignId('id_usuario')
        ->constrained('usuarios', 'id_usuario') // referencia explícita a la PK personalizada
        ->onDelete('cascade');

        $table->foreignId('id_especialidad')
        ->constrained('especialidades', 'id_especialidad')
        ->onDelete('cascade');

        $table->string('telefono', 20)->nullable();
        $table->string('email', 100)->nullable();
    
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
