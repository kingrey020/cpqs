<?php

use App\Http\Controllers\PublicQueueController;
use App\Http\Controllers\AdminQueueController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

// ------------------------
// ADMIN AUTH
// ------------------------
Route::prefix('admin')->group(function () {

    // Guest routes
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register']);

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected routes
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [AdminQueueController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/queue', [AdminQueueController::class, 'index'])->name('admin.queue.index');

        // Queue Actions
        Route::post('/queue/call-next', [AdminQueueController::class, 'callNext'])->name('admin.queue.callNext');
        Route::post('/queue/{id}/serve', [AdminQueueController::class, 'serve'])->name('admin.queue.serve');
        Route::post('/queue/{id}/skip', [AdminQueueController::class, 'skip'])->name('admin.queue.skip');
        Route::post('/queue/{id}/cancel', [AdminQueueController::class, 'cancel'])->name('admin.queue.cancel');
        
        // NEW: Delete Route
        Route::delete('/queue/{id}', [AdminQueueController::class, 'destroy'])->name('admin.queue.destroy');

        // Reports
        Route::get('/reports/daily', [AdminQueueController::class, 'dailyReport'])->name('admin.reports.daily');
    });
});

// ------------------------
// PUBLIC QUEUE ROUTES
// ------------------------
Route::get('/', [PublicQueueController::class, 'showRegistrationForm'])->name('queue.register.form');
Route::post('/register', [PublicQueueController::class, 'store'])->name('queue.register.store');
Route::get('/status/{queue_number}', [PublicQueueController::class, 'status'])->name('queue.status');
Route::get('/edit/{queue_number}', [PublicQueueController::class, 'edit'])->name('queue.edit');
Route::post('/update/{queue_number}', [PublicQueueController::class, 'update'])->name('queue.update');
Route::post('/cancel/{queue_number}', [PublicQueueController::class, 'cancel'])->name('queue.cancel');

// Display screen
Route::get('/display', [PublicQueueController::class, 'display'])->name('queue.display');