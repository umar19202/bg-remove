<?php

use App\Http\Controllers\Auth\AuthenticatedController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ToolUsageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing');
});

Route::get('/remove-background', function () {
    return Inertia::render('Tools/RemoveBackground');
})->name('tools.remove-background');

Route::get('/change-background', function () {
    return Inertia::render('Tools/ChangeBackground');
})->name('tools.change-background');

Route::get('/bulk-remove', function () {
    return Inertia::render('Tools/BulkRemove');
})->name('tools.bulk-remove');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/privacy', function () {
    return Inertia::render('Privacy');
})->name('privacy');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/terms', function () {
    return Inertia::render('Terms');
})->name('terms');

// Auth Routes
Route::get('/login', [AuthenticatedController::class, 'show'])->name('login');
Route::post('/login', [AuthenticatedController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'show'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedController::class, 'destroy'])->middleware('auth')->name('logout');

// Contact Form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Tool Usage (API)
Route::post('/api/tool-usage', [ToolUsageController::class, 'store'])->name('tool-usage.store');
