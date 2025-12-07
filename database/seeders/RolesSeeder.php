<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table('roles')->insert([
            [
                'name' => 'Administrador(a)',
            ],
            [
                'name' => 'Profesor(a)',
            ],
            [
                'name' => 'Jugador(a)',
            ],
        ]);
    }
}
