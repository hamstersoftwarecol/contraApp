<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('public.search');
Route::get('/buscar', [PublicController::class, 'search'])->name('public.search.results');

// Rutas públicas para firmar y descargar PDF
Route::get('/contracts/{contract}/pdf', [ContractController::class, 'downloadPdf'])->name('contracts.pdf');
Route::get('/contracts/{contract}/firmar', [ContractController::class, 'firmar'])->name('contracts.firmar');
Route::post('/contracts/{contract}/firmar', [ContractController::class, 'guardarFirma'])->name('contracts.guardarFirma');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de clientes
    Route::resource('clients', ClientController::class);
    
    // Rutas de pagos
    Route::resource('payments', PaymentController::class);
    
    // Rutas de contratos
    Route::resource('contracts', ContractController::class);
});

require __DIR__.'/auth.php';
