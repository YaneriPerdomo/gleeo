<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('modules')->insert([
            // --- NIVEL 1: BÁSICO (Primeros pasos) ---
            [
                'level_id'   => 1,
                'title'      => 'Los números y el conteo',
                'slug'       => Str::slug('Los números y el conteo'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id'   => 1,
                'title'      => 'Formas y figuras geométricas',
                'slug'       => Str::slug('Formas y figuras geométricas'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- NIVEL 2: INTERMEDIO (Operaciones básicas) ---
            [
                'level_id'   => 2,
                'title'      => 'Aprendiendo a sumar y restar',
                'slug'       => Str::slug('Aprendiendo a sumar y restar'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id'   => 2,
                'title'      => 'Unidades, decenas y centenas',
                'slug'       => Str::slug('Unidades, decenas y centenas'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- NIVEL 3: AVANZADO (Multiplicación y Problemas) ---
            [
                'level_id'   => 3,
                'title'      => 'Tablas de multiplicar',
                'slug'       => Str::slug('Tablas de multiplicar'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id'   => 3,
                'title'      => 'Resolución de problemas lógicos',
                'slug'       => Str::slug('Resolución de problemas lógicos'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
