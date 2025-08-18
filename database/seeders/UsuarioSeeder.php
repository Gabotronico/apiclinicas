<?php

// database/seeders/MetodoEntregaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'id_rol' => 1, // Administrador
                'nombre' => 'Admin',
                'apellido_paterno' => 'Principal',
                'apellido_materno' => 'Sistema',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'estado' => true
            ],
            [
                'id_rol' => 2, // Médico
                'nombre' => 'Luis',
                'apellido_paterno' => 'Medrano',
                'apellido_materno' => 'Flores',
                'email' => 'lmedrano@example.com',
                'password' => Hash::make('medico123'),
                'estado' => true
            ],
            [
                'id_rol' => 3, // Paciente
                'nombre' => 'Juan',
                'apellido_paterno' => 'Perez',
                'apellido_materno' => 'Gomez',
                'email' => 'jperez@example.com',
                'password' => Hash::make('paciente123'),
                'estado' => true
            ],
        ]);
    }
}
