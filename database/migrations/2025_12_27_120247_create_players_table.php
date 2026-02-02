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
        Schema::create('players', function (Blueprint $table) {
            $table->id('player_id');
            $table->foreignId('representative_id')
                ->constrained('representatives', 'representative_id')->cascadeOnDelete();
            $table->foreignId('gender_id')->constrained('genders', 'gender_id');
            $table->foreignId('avatar_id')
                ->nullable()
                ->constrained('avatars', 'avatar_id')->nullOnDelete();
            $table->foreignId('theme_id')
                ->nullable()
                ->constrained('themes', 'theme_id')->nullOnDelete();
            $table->foreignId('level_assigned_id')
                ->nullable()
                ->constrained('levels', 'level_id')->nullOnDelete();
            $table->foreignId('current_level_id')
                ->nullable()
                ->constrained('levels', 'level_id')->nullOnDelete();
            $table->boolean('validated')->default(0);
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->string('names', 200);
            $table->string('surnames', 200);
            $table->date('date_of_birth');

            $table->string('slug', 150)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
