<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmergencyAlertController;

use App\Http\Middleware\CheckAdmin;

use Illuminate\Support\Facades\Route;

Route::get('/map', EmergencyAlertController::class)
    ->name('map');

Route::post('/emergency', [EmergencyAlertController::class, 'store'])
->middleware(['auth', 'verified'])
->name('emergency.store');

Route::get('/emergency/locate', [EmergencyAlertController::class, 'locate'])
->name('emergency.locate');


Route::delete('/emergency/{id}', [EmergencyAlertController::class, 'destroy'])
->name('emergency.destroy')
->middleware('auth'); // Ensure only authenticated (and possibly admin) can delete


Route::get('/', PrimaryController::class)->name('home');
Route::get('/how-it-works', [PrimaryController::class, 'explain'])->name('explain');
Route::get('/registration/verify-email/{user:id}', [PrimaryController::class, 'sentToMail'])->name('verification.to.mail');
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

    Route::get('/reports', ReportController::class)->name('admin.reports'); 
    Route::get('/reports/{report:id}', [ReportController::class,'view'])->name('admin.report.view'); 
    Route::get('/reports/{report:id}/edit', [ReportController::class, 'edit'])->name('admin.report.edit'); 
    Route::put('/reports/{report:id}/update', [ReportController::class, 'update'])->name('admin.report.update'); 
    // Add more admin routes here
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Create a new post (thread)
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // The vote endpoint expects a POST parameter 'vote' (1 for upvote, -1 for downvote)
    Route::post('/posts/{post}/vote', [VoteController::class, 'vote'])->name('posts.vote');

    // Create a new comment or reply on a post
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Vote on a comment
    Route::post('/comments/{comment}/vote', [CommentController::class, 'vote'])->name('comments.vote');

    //Emergency Contact Routes
    Route::get('/emergency-contacts', EmergencyContactController::class)->name('emergency.contacts');
    Route::get('/emergency-contacts/create', [EmergencyContactController::class,'create'])->name('emergency_contacts.create');
    Route::post('/emergency-contacts/create', [EmergencyContactController::class,'store'])->name('emergency_contacts.store');
    Route::get('/emergency-contacts/{emergencyContact}/edit', [EmergencyContactController::class,'edit'])->name('emergency_contacts.edit');
    Route::put('/emergency-contacts/edit', [EmergencyContactController::class,'update'])->name('emergency_contacts.update');
    Route::delete('/emergency-contacts/{emergencyContact}/delete', [EmergencyContactController::class,'destroy'])->name('emergency_contacts.destroy');

});

Route::get('/forums',PostController::class)->name('forums.index');

require __DIR__.'/auth.php';
