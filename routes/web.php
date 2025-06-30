<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MoodController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mood routes
    Route::resource('moods', MoodController::class);
    Route::get('/history', [MoodController::class, 'history'])->name('moods.history');
    Route::get('/summary', [MoodController::class, 'summary'])->name('moods.summary');
    Route::post('/moods/{id}/restore', [MoodController::class, 'restore'])->name('moods.restore');
    Route::get('/moods/export/pdf', [MoodController::class, 'exportPdf'])->name('moods.export.pdf');
    Route::get('/moods/monthly-top', [MoodController::class, 'moodOfTheMonth'])->name('moods.monthly-top');
    Route::resource('moods', MoodController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
