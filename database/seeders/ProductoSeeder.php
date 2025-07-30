<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            [
                'NombreProducto' => 'Camisa Roja S',
                'Precio'         => 80.00,
                'IdCategoria'    => 1,
                'Stock'          => 10,
                'IdTalla'        => 1, // S
                'IdColor'        => 1, // Rojo
                'IdImagen'       => 1, // camisa_roja.jpg
                'Archivo_RA'     => null,
            ],
            [
                'NombreProducto' => 'Camisa Verde M',
                'Precio'         => 90.00,
                'IdCategoria'    => 1,
                'Stock'          => 5,
                'IdTalla'        => 2, // M
                'IdColor'        => 2, // Verde
                'IdImagen'       => 2, // camisa_verde.jpg
                'Archivo_RA'     => null,
            ],
            [
                'NombreProducto' => 'Camisa Azul L',
                'Precio'         => 95.00,
                'IdCategoria'    => 1,
                'Stock'          => 7,
                'IdTalla'        => 3, // L
                'IdColor'        => 3, // Azul
                'IdImagen'       => 3, // camisa_azul.jpg
                'Archivo_RA'     => null,
            ],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
