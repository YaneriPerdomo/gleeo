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
        Schema::create('themes', function (Blueprint $table) {
            $table->id('theme_id');
            $table->string('name')->unique();
            $table->string('main_color', 20);
            $table->string('secondary_color', 20);
            $table->string('background_path', 70);
            $table->boolean('border_radius')->default(0);
            $table->boolean('for_sale')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
