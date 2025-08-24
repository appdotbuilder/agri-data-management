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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regency_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('District name');
            $table->decimal('latitude', 10, 8)->nullable()->comment('District latitude coordinate');
            $table->decimal('longitude', 11, 8)->nullable()->comment('District longitude coordinate');
            $table->decimal('cropping_index', 5, 2)->nullable()->comment('Land cropping index');
            $table->integer('rainy_months')->nullable()->comment('Number of rainy months');
            $table->decimal('k_nutrient', 5, 2)->nullable()->comment('K nutrient content');
            $table->decimal('p_nutrient', 5, 2)->nullable()->comment('P nutrient content');
            $table->decimal('c_nutrient', 5, 2)->nullable()->comment('C nutrient content');
            $table->decimal('cation_exchange_capacity', 5, 2)->nullable()->comment('Cation exchange capacity');
            $table->timestamps();
            
            $table->index(['regency_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};