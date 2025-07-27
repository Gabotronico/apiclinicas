<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        Vehiculo::create(['Placa' => '123ABC', 'Marca' => 'Toyota', 'Modelo' => 'Corolla', 'Tipo' => 'Auto', 'Año' => 2021]);
        Vehiculo::create(['Placa' => '456DEF', 'Marca' => 'Nissan', 'Modelo' => 'Frontier', 'Tipo' => 'Camioneta', 'Año' => 2022]);
    }
}
