<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/admin/dashboard', function () {
    if(auth()->user()->email !== 'admin@admin.com') {
        abort(403, 'ACCESO DENEGADO: Solo para Administradores');
    }
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

// Rutas para Cliente
Route::get('/cliente/dashboard', function () {
    if(auth()->user()->email === 'admin@admin.com') {
         abort(403, 'ACCESO DENEGADO: Solo para Clientes');
    }
    return view('cliente.dashboard');
})->middleware(['auth', 'verified'])->name('cliente.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';