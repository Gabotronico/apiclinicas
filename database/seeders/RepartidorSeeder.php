<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repartidor;

class RepartidorSeeder extends Seeder
{
    public function run(): void
    {
        $repartidores = [
            ['Nombre' => 'Juan Perez', 'Telefono' => 78965412, 'IdVehiculo' => 1],
            ['Nombre' => 'Maria Lopez', 'Telefono' => 78932145, 'IdVehiculo' => 2],
        ];

        foreach ($repartidores as $repartidor) {
            Repartidor::create($repartidor);
        }
    }
}
