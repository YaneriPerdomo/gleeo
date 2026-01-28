<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players_lessons_history', function (Blueprint $table) {
            $table->id('player_lesson_history_id');

            // Relaciones
            $table->foreignId('player_id')
                ->constrained('players', 'player_id')
                ->cascadeOnDelete();
            $table->foreignId('lesson_id')
                ->constrained('lessons', 'lesson_id')
                ->cascadeOnDelete();

            // Datos de la sesión/intento
            $table->time('estimated_time')->nullable();
            $table->integer('success_rate')->default(0);
            $table->integer('reward_diamonds')->default(0);

            // Desglose de precisión
            $table->integer('number_incorrect')->default(0);
            $table->integer('number_correct')->default(0);

            // Estado final del intento
            $table->enum('status', ['Completada', 'Fallida'])->default('Completada');
            $table->boolean('en_uso')->default(0);
            // Metadatos
            $table->timestamp('completed_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_lesson_history');
    }
};
