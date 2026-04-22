<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ctlProduct;
use App\Http\Controllers\ctlCategory;
use App\Http\Controllers\ctlDatos;
use App\Http\Controllers\ctlApiMia;
use App\Http\Controllers\ctlConsumirExterno;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/products', ctlProduct::class);
Route::resource('/categories', ctlCategory::class);

Route::get('/datoslink', [ctlDatos::class, 'index']);
Route::get('/apiMia', [ctlApiMia::class, 'index']);
Route::get('/consumir-externo', [ctlConsumirExterno::class, 'index']);


Route::get('/apiJson', function () {
    return response()->json([
        'proyecto' => 'Laravel en Render',
        'autor' => 'Pedro Samuel Rodriguez Caudillo',
        'estado' => 'Activo',
        'tecnologias' => ['PHP', 'Laravel', 'Docker'],
        'mensaje' => 'Este JSON se consume desde una ruta dinámica de Laravel en Render.'
    ]);
});

Route::get('/apiDatos', function () {
    return response()->json([
        'fuente' => 'Segunda API en Render',
        'mensaje' => 'Este es el segundo enlace disponible para consumir datos JSON.',
        'timestamp' => now()
    ]);
});

//Vista de detalle de registros.
Route::get('/detalleApi/{n1}', [ctlDatos::class, 'detalle'])->name('tj.detalle');

#Route::get('/Holiss', \App\Http\Controllers\ctlProduct::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
