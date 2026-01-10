<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('representatives')->insert([
            [
                'gender_id' => 1,
                'country_id' => 2,
                'user_id' => 2,
                'names' => 'Maikol Perdomo',
                'surnames' => 'Jose Barrios',
                'educational_center' => 'Josefina de Acosta',
                'type' => 'Profesional',
                'slug' => 'Mario-test',
                'deleted_at' => 0
            ],

        ]);
    }
}
