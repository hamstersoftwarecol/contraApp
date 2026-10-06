<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiClientController;
use App\Http\Controllers\Api\ApiContractController;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiDashboardController;
use App\Http\Controllers\Api\ApiSearchController;
use App\Http\Controllers\Api\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas
Route::post('/login', [ApiAuthController::class, 'login']);
Route::post('/register', [ApiAuthController::class, 'register']);

// Búsqueda pública de contratos
Route::get('/search/contracts', [ApiSearchController::class, 'searchContracts']);

// Firma pública de contratos (requiere cédula para validación)
Route::post('/contracts/{contract}/sign', [ApiContractController::class, 'signPublic']);

// Rutas protegidas con Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [ApiAuthController::class, 'logout']);
    Route::get('/user', [ApiAuthController::class, 'user']);

    // Dashboard
    Route::get('/dashboard/stats', [ApiDashboardController::class, 'stats']);
    Route::get('/dashboard/recent-payments', [ApiDashboardController::class, 'recentPayments']);
    Route::get('/dashboard/contracts-status', [ApiDashboardController::class, 'contractsStatus']);
    Route::get('/dashboard/monthly-income', [ApiDashboardController::class, 'monthlyIncome']);

    // Clients
    Route::apiResource('clients', ApiClientController::class);
    Route::get('clients/{client}/contracts', [ApiClientController::class, 'contracts']);

    // Contracts
    Route::apiResource('contracts', ApiContractController::class);
    Route::get('contracts/{contract}/payments', [ApiContractController::class, 'payments']);
    Route::post('contracts/{contract}/sign-admin', [ApiContractController::class, 'sign']);
    Route::get('contracts/{contract}/pdf', [ApiContractController::class, 'downloadPdf']);

    // Payments
    Route::apiResource('payments', ApiPaymentController::class);
    Route::get('payments/contract/{contract}', [ApiPaymentController::class, 'byContract']);
});

