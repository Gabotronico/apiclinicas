<?php

// database/seeders/MetodoEntregaSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EspecialidadSeeder extends Seeder
{
    public function run()
    {
        DB::table('especialidades')->insert([
            ['nombre' => 'Cardiología'],
            ['nombre' => 'Pediatría'],
            ['nombre' => 'Dermatología'],
            ['nombre' => 'Neurología'],
        ]);
    }
}
