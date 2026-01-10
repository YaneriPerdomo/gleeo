<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class NewsBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('news_board')->insert([
            [
                'subject' => 'Matematicas',
                'description' => '¡A jugar y descubrir! Entra en un mundo lleno de colores y sorpresas diseñado especialmente para las manitos y mentes de 5 a 7 años. ¡La diversión comienza aquí!',

            ],

        ]);
    }
}
