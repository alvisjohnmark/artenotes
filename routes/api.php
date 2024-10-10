<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ClientController;

// Admin routes
Route::prefix('admin')->group(function () {
    Route::post('login', [AdminController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::get('name', [AdminController::class, 'getAdminName']);
    });
});

// Client routes
Route::prefix('client')->group(function () {
    Route::post('register', [ClientController::class, 'register']);
    Route::post('login', [ClientController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard', [ClientController::class, 'dashboard']);
        Route::get('name', [ClientController::class, 'getClientName']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
