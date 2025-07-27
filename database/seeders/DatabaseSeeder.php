<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            CategoriaSeeder::class,
            MetodoPagoSeeder::class,
            VehiculoSeeder::class,
        ]);
    }
}
