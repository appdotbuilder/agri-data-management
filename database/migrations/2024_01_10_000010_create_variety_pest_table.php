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
        Schema::create('variety_pest', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variety_id')->constrained()->onDelete('cascade');
            $table->foreignId('pest_id')->constrained()->onDelete('cascade');
            $table->enum('susceptibility', ['low', 'medium', 'high'])->default('medium')->comment('Susceptibility level');
            $table->timestamps();
            
            $table->unique(['variety_id', 'pest_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variety_pest');
    }
};