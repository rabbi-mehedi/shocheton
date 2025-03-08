<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', PrimaryController::class)->name('home');
Route::get('/how-it-works', [PrimaryController::class, 'explain'])->name('explain');
Route::get('/submit-report', [PrimaryController::class,'showForm'])->name('submit.report.form');
Route::post('/submit-report', [PrimaryController::class,'submitForm'])->name('submit.report');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
