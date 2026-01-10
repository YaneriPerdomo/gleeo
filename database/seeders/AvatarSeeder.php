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
                'slug' => 'default',
                'url' => 'default.png'
            ],
             [
                'name' => 'Niño',
                'slug' => 'boy',
                'url' => 'boy.png'
             ],
              [
                'name' => 'Niña',
                'slug' => 'nina',
                'url' => 'girl.png'
            ]
        ]);
    }
}
