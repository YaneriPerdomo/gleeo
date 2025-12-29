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
        Schema::create('player_lessons', function (Blueprint $table) {
            $table->id('player_lesson_id');
            $table->foreignId('player_id')
                ->constrained('players', 'player_id')->cascadeOnDelete();
             $table->foreignId('lesson_id')
                ->constrained('lessons', 'lesson_id')->cascadeOnDelete();
            $table->time('duration')->nullable()->default(NULL);
            $table->integer('diamonds')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_lessons');
    }
};
