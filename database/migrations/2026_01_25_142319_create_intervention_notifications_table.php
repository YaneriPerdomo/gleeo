<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up(): void
    {
        Schema::create('intervention_notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->foreignId('player_id')->constrained('players', 'player_id')->cascadeOnDelete();
            $table->foreignId('representative_id')->constrained('representatives', 'representative_id')->cascadeOnDelete();
            $table->text('reason');
            $table->integer('total_errors_detected');
            $table->integer('distinct_lessons_failed');
            $table->boolean('is_read')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_notifications');
    }
};
