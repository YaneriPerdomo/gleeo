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
        Schema::create('types_dynamics', function (Blueprint $table) {
            $table->id('type_dynamic_id');
            $table->string('type', 60);
            /*
             $table->enum('type', ['Opción múltiple', 'Verdadero/Falso', 'Autocompletar']);
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_dynamics');
    }
};
