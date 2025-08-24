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
        Schema::create('commodity_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->decimal('productivity', 8, 2)->nullable()->comment('Productivity in tons/ha');
            $table->decimal('improvement_potential', 8, 2)->nullable()->comment('Potential yield improvement');
            $table->decimal('potential_value', 12, 2)->nullable()->comment('Economic potential value');
            $table->timestamps();
            
            $table->unique(['district_id', 'commodity_id']);
            $table->index('district_id');
            $table->index('commodity_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodity_recommendations');
    }
};