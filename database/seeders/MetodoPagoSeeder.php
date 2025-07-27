<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MetodoPago;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        MetodoPago::create(['NombreMetodo' => 'Efectivo', 'Descripcion' => 'Pago en efectivo al recibir']);
        MetodoPago::create(['NombreMetodo' => 'Tarjeta', 'Descripcion' => 'Pago con tarjeta de crédito o débito']);
        MetodoPago::create(['NombreMetodo' => 'Transferencia', 'Descripcion' => 'Pago mediante transferencia bancaria']);
    }
}
