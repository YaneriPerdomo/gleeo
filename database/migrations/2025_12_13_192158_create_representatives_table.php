<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->id('representative_id');
            $table->foreignId('gender_id')->constrained('genders', 'gender_id');
            $table->foreignId('country_id')->nullable()
                ->constrained('countries', 'country_id')->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'user_id')
                ->onDelete('cascade');
            /* $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');*/
            $table->string('names', 200);
            $table->string('surnames', 200);
            $table->string('educational_center', 200)->nullable();
            $table->enum('type', ['Profesional', 'Representante']);
            $table->string('slug', 90)->unique();
            $table->boolean('deleted_at')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
