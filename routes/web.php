<?php

use App\Http\Client\Controllers\PaimentController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Client\CategorieController;
use App\Http\Controllers\Client\ColocationController;
use App\Http\Controllers\Client\DepenceController;
use App\Http\Controllers\Client\InvitationController;
use App\Http\Controllers\Client\PaimentController as ClientPaimentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\clientMiddleware;
use App\Models\mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Admin space
Route::middleware(['auth', 'verified',adminMiddleware::class])->group(function () {
Route::get('/dashboard', [ManagementController::class,'index'])->name('dashboard');
Route::resource('admin',ManagementController::class);
Route::post('/Debanner/{$userid}', [ManagementController::class, 'Debanner'])->name('Debanner');

});

// Client space

Route::middleware(['auth', 'verified',clientMiddleware::class])->group(function () {
Route::get('/home', [ColocationController::class,'index'])->name('home');

// Colocation route
Route::resource('colocation',ColocationController::class);
Route::post('/extract', [ColocationController::class, 'extract'])->name('extract');
Route::delete('/leave/{colocation}', [ColocationController::class, 'leave'])->name('leave');

// Categorie route
Route::resource('categorie',CategorieController::class);

// Depence route
Route::resource('depence',DepenceController::class);

// Invitation route
Route::post('/join', [ManagementController::class, 'join'])->name('join');
Route::resource('invitation',InvitationController::class);
Route::get('/invitation/accept/{token}', [InvitationController::class, 'accept'])
->name('invitation.accept');

// Paiment route
Route::resource('paiment',ClientPaimentController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
