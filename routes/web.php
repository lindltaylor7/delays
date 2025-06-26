<?php

use App\Http\Controllers\DelayController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/migrate', function () {
    try {
        $exitCode = Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'exitCode' => $exitCode,
            'output' => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/delay', [DelayController::class, 'index'])->middleware(['auth', 'verified'])->name('delay.index');
Route::post('/delay', [DelayController::class, 'store'])->middleware(['auth', 'verified'])->name('delay.store');
Route::get('/delay/{id}', [DelayController::class, 'update'])->middleware(['auth', 'verified'])->name('delay.update');
Route::get('/delay-export', [DelayController::class, 'export'])->middleware(['auth', 'verified'])->name('delay.export');

Route::get('/admin', [DelayController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin.index');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
