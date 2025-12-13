<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AlertThresholdSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alert_threshold')->insert([
            [
                'decision_pattern_id' => 1,
                'refuerzo_fail_limit' => 0,
                'alert_ce_activations' => 2,
                'time_window' => 'N/A',
                'alert_recipient' => 'Profesor(a)'
            ],
            [
                'refuerzo_fail_limit' => 0,
                'decision_pattern_id' => 2,
                'alert_ce_activations' => 2,
                'time_window' => '24 Horas',
                'alert_recipient' => 'Estudiante'
            ],
            [
                'refuerzo_fail_limit' => 0,
                'decision_pattern_id' => 3,
                'alert_ce_activations' => 4,
                'time_window' => '7 Dias',
                'alert_recipient' => 'Estudiante'
            ],
            [
                'refuerzo_fail_limit' => 0,
                'decision_pattern_id' => 4,
                'alert_ce_activations' => 2,
                'time_window' => '30 Dias',
                'alert_recipient' => 'Estudiante'
            ],
        ]);
    }
}
