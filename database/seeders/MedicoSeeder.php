<?php

// database/seeders/MetodoEntregaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicoSeeder extends Seeder
{
    public function run()
    {
        DB::table('medicos')->insert([
            [
                'id_usuario' => 2, // usuario médico
                'id_especialidad' => 1, // cardiología
                'telefono' => '76543210',
                
            ]
        ]);
    }
}
