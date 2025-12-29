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
        Schema::create('progress', function (Blueprint $table) {
            $table->id('progress_id');
            $table->foreignId('player_id')
                ->constrained('players', 'player_id')->cascadeOnDelete();
            $table->foreignId('level_id')
                ->constrained('levels', 'level_id')->cascadeOnDelete();
            $table->decimal('percentage_bar', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
