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
        Schema::create('varieties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('Variety name');
            $table->year('release_year')->nullable()->comment('Year of release');
            $table->decimal('potential_yield', 8, 2)->nullable()->comment('Potential yield (tons/ha)');
            $table->decimal('average_yield', 8, 2)->nullable()->comment('Average yield (tons/ha)');
            $table->integer('maturity_days')->nullable()->comment('Days to maturity');
            $table->integer('plant_height')->nullable()->comment('Plant height in cm');
            $table->string('seed_color')->nullable()->comment('Seed color');
            $table->decimal('seed_weight', 8, 2)->nullable()->comment('100-seed weight in grams');
            $table->decimal('protein_content', 5, 2)->nullable()->comment('Protein content percentage');
            $table->decimal('fat_content', 5, 2)->nullable()->comment('Fat content percentage');
            $table->string('breeder')->nullable()->comment('Variety breeder/developer');
            $table->string('proposer')->nullable()->comment('Variety proposer');
            $table->string('image_path')->nullable()->comment('Path to variety image');
            $table->timestamps();
            
            $table->index(['commodity_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varieties');
    }
};