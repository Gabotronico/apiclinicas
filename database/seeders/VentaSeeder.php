<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        $ventas = [
            [
                'IdUsuario'     => 1,
                'TipoVenta'     => 'Online',
                'Fecha'         => now(),
                'Total'         => 250.00,
                'IdMetodoPago'  => 1,
                'EstadoPedido'  => 'Entregado',
                'IdDireccion'   => 1,
                'IdRepartidor'  => 1,
            ],
            [
                'IdUsuario'     => 2,
                'TipoVenta'     => 'Presencial',
                'Fecha'         => now(),
                'Total'         => 90.00,
                'IdMetodoPago'  => 2,
                'EstadoPedido'  => 'En proceso',
                'IdDireccion'   => 2,
                'IdRepartidor'  => 2,
            ],
        ];

        foreach ($ventas as $venta) {
            Venta::create($venta);
        }
    }
}
