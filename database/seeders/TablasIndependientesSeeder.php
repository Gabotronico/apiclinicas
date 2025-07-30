<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TablasIndependientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
        TallaSeeder::class,
        ColorSeeder::class,
        ImagenSeeder::class,
        CategoriaSeeder::class, // Si tienes esta tabla
        VehiculoSeeder::class,
        RepartidorSeeder::class
       
    ]);
    }
}
