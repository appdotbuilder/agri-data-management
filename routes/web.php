<?php

use App\Http\Controllers\AgricultureController;
use App\Http\Controllers\PestDetectionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [AgricultureController::class, 'index'])->name('dashboard');

    // Agriculture routes (main functionality)
    Route::get('/agriculture', [AgricultureController::class, 'index'])->name('agriculture.index');
    
    // Pest Detection routes
    Route::resource('pest-detections', PestDetectionController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
