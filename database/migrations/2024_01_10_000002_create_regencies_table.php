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
        Schema::create('regencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('Regency/City name');
            $table->decimal('latitude', 10, 8)->nullable()->comment('Regency latitude coordinate');
            $table->decimal('longitude', 11, 8)->nullable()->comment('Regency longitude coordinate');
            $table->timestamps();
            
            $table->index(['province_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regencies');
    }
};