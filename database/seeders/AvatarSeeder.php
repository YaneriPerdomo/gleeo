<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvatarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('avatars')->insert([
            [
                'name' => 'Defecto',
                'url' => 'default'
            ]
        ]);
    }
}
