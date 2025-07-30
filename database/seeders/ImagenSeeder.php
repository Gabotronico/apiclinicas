<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Imagen;

class ImagenSeeder extends Seeder
{
    public function run(): void
    {
        $imagenes = [
            ['UrlImagen' => 'camisa_roja.jpg'],
            ['UrlImagen' => 'camisa_verde.jpg'],
            ['UrlImagen' => 'camisa_azul.jpg'],
            ['UrlImagen' => 'camisa_amarilla.jpg'],
        ];

        foreach ($imagenes as $img) {
            Imagen::create($img);
        }
    }
}
