<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\MediaClipController;
use App\Http\Controllers\Web\Settings\ApiCredentialController;
use App\Http\Controllers\Web\Settings\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Media Clips & Approvals
    Route::get('/live-events', [MediaClipController::class, 'index'])->name('clips.index');
    Route::get('/highlight-library', [MediaClipController::class, 'library'])->name('clips.library');
    Route::post('/clips/{clip}/approve', [MediaClipController::class, 'approve'])->name('clips.approve');
    Route::post('/clips/{clip}/reject', [MediaClipController::class, 'reject'])->name('clips.reject');
    Route::put('/clips/{clip}', [MediaClipController::class, 'update'])->name('clips.update');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::resource('apis', ApiCredentialController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);
    });
});
