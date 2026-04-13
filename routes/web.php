<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ctlProduct;
use App\Http\Controllers\ctlDatos;
use App\Http\Controllers\ctlApiMia;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/product', [ctlProduct::class, 'index']);
Route::get('/datoslink', [ctlDatos::class, 'index']);
Route::get('/apiMia', [ctlApiMia::class, 'index']);
#Route::get('/Holiss', \App\Http\Controllers\ctlProduct::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
