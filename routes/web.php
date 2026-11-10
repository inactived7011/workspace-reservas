<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


// Ruta puente que soluciona el error 404 de Breeze
Route::get('/dashboard', function () {
    if(auth()->user()->email === 'admin@admin.com') {
        return redirect('/admin/dashboard');
    }
    return redirect('/cliente/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para Administrador
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Rutas para Cliente
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cliente/dashboard', [ClienteController::class, 'index'])->name('cliente.dashboard');
    Route::post('/cliente/reservas', [ClienteController::class, 'storeReserva'])->name('cliente.reservas.store');
    Route::delete('/cliente/reservas/{id}', [ClienteController::class, 'cancelReserva'])->name('cliente.reservas.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';