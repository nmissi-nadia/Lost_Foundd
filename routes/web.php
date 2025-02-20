<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnonceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/annonce/create', [AnnonceController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('publieAnnonce');
Route::post('/annonce/publier', [AnnonceController::class, 'store'])
    ->middleware(['auth', 'verified']);

Route::get('/api/annonces', [AnnonceController::class, 'index']);
Route::get('/dashboard', [AnnonceController::class, 'index'] 
)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
