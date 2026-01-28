<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alert_configurations', function (Blueprint $table) {
            $table->id('alert_config_id');
            $table->foreignId('level_id')->constrained('levels', 'level_id')->cascadeOnDelete();
            $table->integer('max_errors_allowed')->default(5);
            $table->enum('time_frame', ['1 dia', '1 semana', '1 mes'])->default('1 semana');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alert_configurations');
    }
};
