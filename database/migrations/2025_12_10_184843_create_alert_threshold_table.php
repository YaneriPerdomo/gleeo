<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alert_threshold', function (Blueprint $table) {
            $table->id('alert_threshold_id');
            $table->foreignId('decision_pattern_id')
                ->constrained('decision_pattern', 'decision_pattern_id');
            $table->unsignedInteger('refuerzo_fail_limit')->nullable();
            $table->unsignedInteger('alert_ce_activations')->nullable();
            $table->enum(
                'time_window',
                [
                    '24 Horas',
                    '7 Dias',
                    '30 Dias',
                    'N/A'
                ]
            )->nullable();
            $table->enum('alert_recipient', ['Profesor(a)', 'Estudiante']);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('alert_threshold');
    }
};
