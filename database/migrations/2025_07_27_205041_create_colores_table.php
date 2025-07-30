<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colores', function (Blueprint $table) {
        $table->id('IdColor');
        $table->string('CodigoColor', 10); // #FF5733
        $table->string('NombreColor', 30)->nullable();
        $table->timestamps();
     });

    }

    public function down(): void
    {
        Schema::dropIfExists('colores');
    }
};
