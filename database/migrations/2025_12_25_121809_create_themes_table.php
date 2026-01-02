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
            $table->string('name', 20)->unique();
            $table->string('main_color', 10);
            $table->string('secondary_color', 10);
            $table->string('background_path', 60)->nullable()->default(null);
            $table->boolean('border_radius')->default(0);
            $table->string('solid_background', 10)->nullable()->default(null);
            $table->string('topic_color', 10);
            $table->string('slug', 20)->unique();
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
