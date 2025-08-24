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
        Schema::create('pest_detections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('predicted_pest_id')->nullable()->constrained('pests')->onDelete('set null');
            $table->foreignId('verified_pest_id')->nullable()->constrained('pests')->onDelete('set null');
            $table->string('image_path')->comment('Path to uploaded image');
            $table->decimal('latitude', 10, 8)->nullable()->comment('GPS latitude');
            $table->decimal('longitude', 11, 8)->nullable()->comment('GPS longitude');
            $table->decimal('confidence_score', 5, 4)->nullable()->comment('AI confidence score (0-1)');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->comment('Detection status');
            $table->text('notes')->nullable()->comment('Expert notes or user comments');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable()->comment('Verification timestamp');
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['district_id', 'created_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pest_detections');
    }
};