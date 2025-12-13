<?php
namespace Database\Seeders;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;
class DecisionPatternSeeder extends Seeder
{
    public function run(): void
    {
        FacadesDB::table('decision_pattern')->insert([
            [
                'name' => 'Activación del Contenido de Esfuerzo',
                'description' => ' Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.',
                'is_active' => 1
            ],
            [
                'name' => 'Alerta Intervención Requerida, PreNumérico',
                'description' => 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.',
                'is_active' => 1
            ],
            [
                'name' => 'Alerta Intervención Requerida, Numérico Emergente',
                'description' => 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.',
                'is_active' => 1
            ],
            [
                'name' => 'Alerta Intervención Requerida, Desarrollo Emergente',
                'description' => 'Este módulo configura los umbrales de alerta escalonada. Cuando el estudiante activa el Contenido de Esfuerzo (CE) un número predefinido de veces (ej., 3) dentro de un periodo específico (Día, Semana o Mes), el sistema genera una notificación de Intervención Requerida para el profesor.',
                'is_active' => 1
            ],
        ]);
    }
}
