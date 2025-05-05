<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'name' => 'Laptop Dell',
                'precio' => 1200.00,
                'descripcion' => 'Laptop potente para desarrollo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Mouse Inalámbrico',
                'precio' => 25.50,
                'descripcion' => 'Mouse con conexión Bluetooth',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
