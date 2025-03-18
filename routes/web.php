<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;

use App\Http\Middleware\CheckAdmin;

use Illuminate\Support\Facades\Route;

Route::get('/', PrimaryController::class)->name('home');
Route::get('/how-it-works', [PrimaryController::class, 'explain'])->name('explain');
Route::get('/submit-report', [PrimaryController::class,'showForm'])->name('submit.report.form');
Route::post('/submit-report', [PrimaryController::class,'submitForm'])->name('submit.report');
Route::get('/search', [SearchController::class, 'results'])->name('search.results');

Route::group([
    'prefix' => 'admin',
    'middleware' => CheckAdmin::class,
], function () {
    Route::get('/dashboard', AdminController::class)->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{user:id}/edit', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('/users/{user:id}/update', [AdminController::class, 'update'])->name('admin.user.update');
    Route::get('/offenders', [AdminController::class, 'offenders'])->name('admin.offenders'); 
    Route::get('/offenders/{offender:id}/edit', [AdminController::class, 'offenderEdit'])->name('admin.offender.edit'); 
    Route::put('/offenders/{offender:id}/update', [AdminController::class, 'offenderUpdate'])->name('admin.offender.update'); 

    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports'); 
    
    Route::get('/reports/{report:id}/edit', [AdminController::class, 'reportEdit'])->name('admin.report.edit'); 
    Route::put('/reports/{report:id}/update', [AdminController::class, 'reportUpdate'])->name('admin.report.update'); 
    // Add more admin routes here
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/forums', function () {
    return view('forums');
})->name('forums');

require __DIR__.'/auth.php';
