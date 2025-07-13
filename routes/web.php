<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ExtortionReportController;
use App\Http\Controllers\PartyRepresentativeController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmergencyAlertController;

use App\Http\Middleware\CheckAdmin;

use Illuminate\Support\Facades\Route;

Route::get('/map', EmergencyAlertController::class)
    ->name('map');
    
// heatmap (testing)
use App\Http\Controllers\HeatmapController;
Route::get('/heatmap', [HeatmapController::class, 'index'])->name('heatmap');

Route::get('/emergency', EmergencyAlertController::class)
    ->name('emergency.index');

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

// Extortion reporting routes
Route::get('/report-extortion', [ExtortionReportController::class, 'showForm'])->name('extortion.report.form');
Route::post('/report-extortion', [ExtortionReportController::class, 'submitForm'])->name('extortion.report.submit');

Route::get('/search', [SearchController::class, 'results'])->name('search.results');

Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user:id}/edit', [AdminController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user:id}/update', [AdminController::class, 'update'])->name('user.update');
    
    Route::get('/offenders', [AdminController::class, 'offenders'])->name('offenders'); 
    Route::get('/offenders/{offender:id}/edit', [AdminController::class, 'offenderEdit'])->name('offender.edit'); 
    Route::put('/offenders/{offender:id}/update', [AdminController::class, 'offenderUpdate'])->name('offender.update'); 

    Route::get('/reports', [ReportController::class, 'index'])->name('reports'); 
    Route::get('/reports/{report:id}', [ReportController::class,'view'])->name('report.view'); 
    Route::get('/reports/{report:id}/edit', [ReportController::class, 'edit'])->name('report.edit'); 
    Route::put('/reports/{report:id}/update', [ReportController::class, 'update'])->name('report.update'); 
    
    // Extortion report admin routes
    Route::get('/extorters', [ExtortionReportController::class, 'adminIndex'])->name('extorters.index');
    Route::get('/extorters/{extortionReport}', [ExtortionReportController::class, 'adminShow'])->name('extorters.show');

    // Party Representative Management
    Route::get('/representatives', [AdminController::class, 'listRepresentatives'])->name('representatives.index');
    Route::put('/representatives/{representative}/approve', [AdminController::class, 'approveRepresentative'])->name('representatives.approve');
    Route::put('/representatives/{representative}/reject', [AdminController::class, 'rejectRepresentative'])->name('representatives.reject');
    Route::get('/representatives/{representative}/categories', [AdminController::class, 'assignCategories'])->name('representatives.categories');
    Route::post('/representatives/{representative}/categories', [AdminController::class, 'syncCategories'])->name('representatives.categories.sync');
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
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    // The vote endpoint expects a POST parameter 'vote' (1 for upvote, -1 for downvote)
    Route::post('/posts/{post}/vote', [VoteController::class, 'votePost'])->name('posts.vote');

    // Create a new comment or reply on a post
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Vote on a comment
    Route::post('/comments/{comment}/vote', [VoteController::class, 'voteComment'])->name('comments.vote');

    //Emergency Contact Routes
    Route::get('/emergency-contacts', EmergencyContactController::class)->name('emergency.contacts');
    Route::get('/emergency-contacts/create', [EmergencyContactController::class,'create'])->name('emergency_contacts.create');
    Route::post('/emergency-contacts/create', [EmergencyContactController::class,'store'])->name('emergency_contacts.store');
    Route::get('/emergency-contacts/{emergencyContact}/edit', [EmergencyContactController::class,'edit'])->name('emergency_contacts.edit');
    Route::put('/emergency-contacts/edit', [EmergencyContactController::class,'update'])->name('emergency_contacts.update');
    Route::delete('/emergency-contacts/{emergencyContact}/delete', [EmergencyContactController::class,'destroy'])->name('emergency_contacts.destroy');

});

Route::get('/forums',PostController::class)->name('forums.index');

Route::get('/resources', function () {
    return view('resources.index');
})->name('resources');

Route::get('resources/legal', function () {
    return view('resources.legal');
})->name('legal');

Route::get('/resources/medical', function () {
    return view('resources.medical');
})->name('medical');

Route::get('resources/psychological', function () {
    return view('resources.psychological');
})->name('psychological');

Route::get('resources/ngo', function () {
    return view('resources.ngo');
})->name('ngo');

// Party Representative Registration Routes
Route::get('/representative/register', [PartyRepresentativeController::class, 'create'])->name('representative.register');
Route::post('/representative/register', [PartyRepresentativeController::class, 'store']);

Route::middleware(['auth', \App\Http\Middleware\CheckRepresentative::class])->prefix('representative')->name('representative.')->group(function () {
    Route::get('/dashboard', [PartyRepresentativeController::class, 'dashboard'])->name('dashboard');
    Route::get('/reports/{extortionReport}', [PartyRepresentativeController::class, 'showReport'])->name('reports.show');
    Route::post('/reports/{report}/flag', [PartyRepresentativeController::class, 'flagReport'])->name('reports.flag');
});

require __DIR__.'/auth.php';


