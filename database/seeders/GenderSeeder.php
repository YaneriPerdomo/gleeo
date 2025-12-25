<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('genders')->insert([
            [
                'name' => 'Masculino',
            ],
            [
                'name' => 'Femenina',
            ],
        ]);
    }
}
