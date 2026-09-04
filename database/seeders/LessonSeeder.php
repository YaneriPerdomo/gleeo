<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('lessons')->insert([

            [
                'topic_id'  => 1,
                'guide'     => 'Contar es poner los números en orden: 1, 2, 3... ¡Intentémoslo!',
                'title'     => 'Conteo hacia adelante',
                'order'     => 1,
                'slug'      => Str::slug('Conteo hacia adelante'),
                'is_active' => 1,
                'deleted_at'=> 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'topic_id'  => 1,
                'guide'     => 'Ahora contaremos hacia atrás como un cohete: 10, 9, 8... ¡Despegue!',
                'title'     => 'Conteo regresivo',
                'order'     => 2,
                'slug'      => Str::slug('Conteo regresivo'),
                'is_active' => 1,
                'deleted_at'=> 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],

            // --- TEMA 3: La suma (topic_id: 3) ---
            [
                'topic_id'  => 3,
                'guide'     => 'Sumar es unir dos grupos de cosas para saber cuántas hay en total.',
                'title'     => '¿Qué es sumar?',
                'order'     => 1,
                'slug'      => Str::slug('Que es sumar'),
                'is_active' => 1,
                'deleted_at'=> 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'topic_id'  => 3,
                'guide'     => 'Usa el símbolo + para representar la unión de cantidades.',
                'title'     => 'El signo de suma',
                'order'     => 2,
                'slug'      => Str::slug('El signo de suma'),
                'is_active' => 1,
                'deleted_at'=> 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],

            // --- TEMA 5: Multiplicar por 2 y 3 (topic_id: 5) ---
            [
                'topic_id'  => 5,
                'guide'     => 'Multiplicar por 2 es lo mismo que sumar el mismo número dos veces.',
                'title'     => 'El doble de un número',
                'order'     => 1,
                'slug'      => Str::slug('El doble de un numero'),
                'is_active' => 1,
                'deleted_at'=> 0,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
