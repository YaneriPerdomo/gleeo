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
        Schema::create('sufficiency_validations', function (Blueprint $table) {
            $table->id('validation_sufficiency_id');
            $table->foreignId('player_id')
                ->constrained('players', 'player_id')->cascadeOnDelete();
            $table->foreignId('level_id')
                ->nullable()
                ->constrained('levels', 'level_id')->nullOnDelete();
            $table->boolean('filled')->default(0);
            $table->integer('attempts')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sufficiency_validations');
    }
};
