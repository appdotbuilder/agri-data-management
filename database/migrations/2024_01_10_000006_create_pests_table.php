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
        Schema::create('pests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Pest/disease name');
            $table->enum('type', ['pest', 'disease'])->comment('Type: pest or disease');
            $table->string('target_plants')->nullable()->comment('Target plant species');
            $table->text('symptoms')->nullable()->comment('Symptoms description');
            $table->text('cultural_control')->nullable()->comment('Cultural/technical control methods');
            $table->text('physical_control')->nullable()->comment('Physical/mechanical control methods');
            $table->text('chemical_control')->nullable()->comment('Chemical control methods');
            $table->text('biological_control')->nullable()->comment('Biological control methods');
            $table->string('image_path')->nullable()->comment('Path to pest/disease image');
            $table->timestamps();
            
            $table->index(['name', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pests');
    }
};