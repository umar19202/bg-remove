<?php

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
