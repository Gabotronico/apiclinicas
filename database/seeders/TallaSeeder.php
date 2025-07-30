<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Talla;

class TallaSeeder extends Seeder
{
    public function run(): void
    {
        $tallas = [
            ['NombreTalla' => 'S'],
            ['NombreTalla' => 'M'],
            ['NombreTalla' => 'L'],
            ['NombreTalla' => 'XL'],
        ];

        foreach ($tallas as $talla) {
            Talla::create($talla);
        }
    }
}
