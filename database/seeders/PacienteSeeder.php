<?php

// database/seeders/MetodoEntregaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run()
    {
        DB::table('pacientes')->insert([
            [
                'id_usuario' => 1,
                'direccion' => 'Av. Ejemplo 123',
                'telefono' => '72345678',
                'fecha_nacimiento' => '1995-07-10',
                'genero' => 'Masculino',
            ]
        ]);
    }
}
