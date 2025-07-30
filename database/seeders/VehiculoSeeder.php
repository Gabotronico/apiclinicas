<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        $vehiculos = [
            ['Placa' => '1234ABC', 'Marca' => 'Toyota', 'Modelo' => 'Corolla', 'Tipo' => 'Auto', 'Año' => 2020],
            ['Placa' => '5678XYZ', 'Marca' => 'Suzuki', 'Modelo' => 'Vitara', 'Tipo' => 'Camioneta', 'Año' => 2022],
        ];

        foreach ($vehiculos as $vehiculo) {
            Vehiculo::create($vehiculo);
        }
    }
}
