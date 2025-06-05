<?php

use App\Http\Controllers\DelayController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/delay', [DelayController::class, 'index'])->middleware(['auth', 'verified'])->name('delay.index');
Route::post('/delay', [DelayController::class, 'store'])->middleware(['auth', 'verified'])->name('delay.store');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
