<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'Nombre' => 'Cliente Uno',
                'Email' => 'cliente1@email.com',
                'Password' => Hash::make('password'),
                'IdRol' => 2, // Cambia según tus roles
                'FechaRegistro' => now(),
            ],
            [
                'Nombre' => 'Admin',
                'Email' => 'admin@email.com',
                'Password' => Hash::make('admin123'),
                'IdRol' => 1,
                'FechaRegistro' => now(),
            ],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::create($usuario);
        }
    }
}
