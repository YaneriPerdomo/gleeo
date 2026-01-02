<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('themes')->insert([
            [
                'name' => 'Defecto',
                'main_color' => '#7052c2',
                'secondary_color' => '#ef7440',
                'background_path' => null,
                'solid_background' => '#dbdbdb',
                'border_radius' => 1,
                'slug' => 'defecto',
                'topic_color' => 'white',
            ]
        ]);
    }
}
