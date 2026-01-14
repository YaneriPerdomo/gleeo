<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('reinforcement_failure_limit', function (Blueprint $table) {
            $table->id('reinforcement_failure_limit_id');
            $table->unsignedInteger('refuerzo_fail_limit')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reinforcement_failure_limit');
    }

};
