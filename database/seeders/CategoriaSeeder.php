<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['NombreCategoria' => 'Camisas']);
        Categoria::create(['NombreCategoria' => 'Pantalones']);
        Categoria::create(['NombreCategoria' => 'Zapatos']);
    }
}
