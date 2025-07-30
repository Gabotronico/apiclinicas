<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        $colores = [
            ['CodigoColor' => '#FF0000', 'NombreColor' => 'Rojo'],
            ['CodigoColor' => '#00FF00', 'NombreColor' => 'Verde'],
            ['CodigoColor' => '#0000FF', 'NombreColor' => 'Azul'],
            ['CodigoColor' => '#FFFF00', 'NombreColor' => 'Amarillo'],
        ];

        foreach ($colores as $color) {
            Color::create($color);
        }
    }
}
