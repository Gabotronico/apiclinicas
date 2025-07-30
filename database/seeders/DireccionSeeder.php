<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Direccion;

class DireccionSeeder extends Seeder
{
    public function run(): void
    {
        $direcciones = [
            [
                'IdUsuario' => 1,
                'Direccion' => 'Calle Principal 123',
                'Ciudad' => 'Santa Cruz',
                'Latitud' => -17.7833,
                'Longitud' => -63.1821,
                'Referencia' => 'Casa azul'
            ],
            [
                'IdUsuario' => 2,
                'Direccion' => 'Av. Libertad 456',
                'Ciudad' => 'La Paz',
                'Latitud' => -16.5,
                'Longitud' => -68.15,
                'Referencia' => 'Edificio rojo'
            ],
        ];

        foreach ($direcciones as $dir) {
            Direccion::create($dir);
        }
    }
}
