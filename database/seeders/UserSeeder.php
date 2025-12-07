<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacadesDB::table("users")->insert([
            [
                "user" => 'admin',
                "rol_id" => 1,
                "email" => "admin@gmail.com",
                'password' => FacadesHash::make('123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                "user" => 'Maikol',
                "rol_id" => 2,
                "email" => "maikolcomputacion@gmail.com",
                'password' => FacadesHash::make('123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
