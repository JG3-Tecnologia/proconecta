<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemandController;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

// Rotas autenticadas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    Route::post('/demands', [DemandController::class, 'createDemand']);
    Route::get('/demands/{id}', [DemandController::class, 'showDemand']);
    Route::post('/demands/{id}/interactions', [DemandController::class, 'addInteraction']);
});