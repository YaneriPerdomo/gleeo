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
        Schema::create('practices', function (Blueprint $table) {
            $table->id('practice_id');
            $table->foreignId('lesson_id')->constrained('lessons', 'lesson_id');
            $table->foreignId('reinforcement_id')->constrained('reinforcements', 'reinforcement_id');
            $table->foreignId('practice_option_id')->constrained('practice_options', 'practice_option_id')->cascadeOnDelete();
            $table->foreignId('type_dynamic_id')->constrained('types_dynamics', 'type_dynamic_id');
            $table->string('screen', 150)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practices');
    }
};
