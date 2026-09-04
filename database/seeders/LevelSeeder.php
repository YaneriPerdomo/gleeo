<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            [
                'level_id' => 1,
                'name' => 'Básico',
                'slug' => 'nivel-1-basico',
                'number' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id' => 2,
                'name' => 'Intermedio',
                'slug' => 'nivel-2-intermedio',
                'number' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_id' => 3,
                'number' => 3,
                'name' => 'Avanzado',
                'slug' => 'nivel-3-avanzado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
