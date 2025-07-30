<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleVenta;

class DetalleVentaSeeder extends Seeder
{
    public function run(): void
    {
        $detalles = [
            [
                'IdProducto' => 1,
                'IdVenta' => 1,
                'Cantidad' => 2,
                'PrecioUnitario' => 80.00,
                'SubTotal' => 160.00,
            ],
            [
                'IdProducto' => 2,
                'IdVenta' => 1,
                'Cantidad' => 1,
                'PrecioUnitario' => 90.00,
                'SubTotal' => 90.00,
            ],
        ];

        foreach ($detalles as $detalle) {
            DetalleVenta::create($detalle);
        }
    }
}
