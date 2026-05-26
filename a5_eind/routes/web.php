<?php

use App\Http\Controllers\BandController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BandController::class, 'index']);
Route::get('/bands/create', [BandController::class, 'create']);
Route::get('/bands/{id}', [BandController::class, 'show']);

Route::get('/dashboard', [BandController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/bands', [BandController::class, 'store']);

    Route::get('/bands/{id}/edit', [BandController::class, 'edit']);
Route::put('/bands/{id}', [BandController::class, 'update']);
});

require __DIR__.'/auth.php';