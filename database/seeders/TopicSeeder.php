<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('topics')->insert([
            // --- MÓDULO 1: Los números y el conteo (module_id: 1) ---
            [
                'module_id'  => 1,
                'title'      => 'Aprender a contar del 1 al 10',
                'slug'       => Str::slug('Aprender a contar del 1 al 10'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id'  => 1,
                'title'      => 'Reconociendo los números naturales',
                'slug'       => Str::slug('Reconociendo los números naturales'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- MÓDULO 3: Aprendiendo a sumar y restar (module_id: 3) ---
            [
                'module_id'  => 3,
                'title'      => 'La suma y el concepto de agrupar',
                'slug'       => Str::slug('La suma y el concepto de agrupar'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id'  => 3,
                'title'      => 'La resta como quitar elementos',
                'slug'       => Str::slug('La resta como quitar elementos'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --- MÓDULO 5: Tablas de multiplicar (module_id: 5) ---
            [
                'module_id'  => 5,
                'title'      => 'Multiplicar por 2 y por 3',
                'slug'       => Str::slug('Multiplicar por 2 y por 3'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'module_id'  => 5,
                'title'      => 'Propiedades de la multiplicación',
                'slug'       => Str::slug('Propiedades de la multiplicación'),
                'deleted_at' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
