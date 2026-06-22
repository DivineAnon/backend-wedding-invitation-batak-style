<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GiftController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\PhotoBoothController;
use App\Http\Controllers\Api\RsvpController;
use App\Http\Controllers\Api\ScannerController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\WeddingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Wedding Invitation API Routes
|--------------------------------------------------------------------------
*/

// ─── PUBLIC ROUTES ─────────────────────────────────────────────────────────
Route::prefix('v1')->group(function () {
    Route::get('/wedding', [WeddingController::class, 'show']);
    Route::get('/stories', [StoryController::class, 'index']);
    Route::get('/gallery', [GalleryController::class, 'index']);
    Route::get('/gifts', [GiftController::class, 'index']);
    Route::get('/photobooth', [PhotoBoothController::class, 'index']);

    Route::get('/guests/{slug}', [GuestController::class, 'findBySlug']);
    Route::post('/rsvp', [RsvpController::class, 'store']);
    Route::post('/photobooth', [PhotoBoothController::class, 'store']);
});

// ─── ADMIN AUTH ─────────────────────────────────────────────────────────────
Route::prefix('v1/admin')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// ─── ADMIN PROTECTED ROUTES ──────────────────────────────────────────────────
Route::prefix('v1/admin')->middleware('admin.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Wedding settings
    Route::post('/wedding', [WeddingController::class, 'update']);

    // Guests
    Route::get('/guests', [GuestController::class, 'index']);
    Route::post('/guests', [GuestController::class, 'store']);
    Route::put('/guests/{guest}', [GuestController::class, 'update']);
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy']);
    Route::post('/guests/import', [GuestController::class, 'import']);
    Route::get('/guests/{guest}/qr', [GuestController::class, 'qrLink']);
    Route::post('/guests/{guest}/resend', [GuestController::class, 'resendNotification']);

    // Gallery
    Route::post('/gallery', [GalleryController::class, 'store']);
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy']);

    // PhotoBooth moderation
    Route::get('/photobooth', [PhotoBoothController::class, 'adminIndex']);
    Route::patch('/photobooth/{photoBooth}/toggle', [PhotoBoothController::class, 'toggleApproval']);
    Route::delete('/photobooth/{photoBooth}', [PhotoBoothController::class, 'destroy']);

    // Gifts
    Route::post('/gifts', [GiftController::class, 'store']);
    Route::put('/gifts/{gift}', [GiftController::class, 'update']);
    Route::delete('/gifts/{gift}', [GiftController::class, 'destroy']);

    // Stories
    Route::post('/stories', [StoryController::class, 'store']);
    Route::put('/stories/{story}', [StoryController::class, 'update']);
    Route::delete('/stories/{story}', [StoryController::class, 'destroy']);

    // Scanner
    Route::post('/scanner/scan', [ScannerController::class, 'scan']);
});
