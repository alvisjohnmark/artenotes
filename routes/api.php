<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\adminController;
use App\Http\Controllers\Auth\clientController;
use App\Http\Controllers\appController;
use App\Http\Controllers\cartController;

//home routes
Route::get('/getProducts', [appController::class, 'getProducts']);
Route::get('/getServices', [appController::class, 'getServices']);

// Admin routes
Route::prefix('admin')->group(function () {
    Route::post('register', [adminController::class, 'register']);
    Route::post('login', [adminController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard', [adminController::class, 'dashboard']);
        Route::get('name', [adminController::class, 'getAdminName']);
        Route::post('addProduct', [adminController::class, 'addProduct']);
        Route::get('getProducts', [adminController::class, 'getProducts']); 
        Route::put('updateProduct/{id}', [adminController::class, 'updateProduct']);
        Route::delete('deleteProduct/{id}', [adminController::class, 'deleteProduct']);
        Route::post('addPicture/{id}/image', [adminController::class, 'addPicture']);
        Route::post('addService', [adminController::class, 'addService']);
        Route::get('getServices', [adminController::class, 'getServices']); 
        Route::delete('deleteService/{id}', [adminController::class, 'deleteService']);
        Route::put('updateService/{id}', [adminController::class, 'updateService']);
    });
});

// Client routes
Route::prefix('client')->group(function () {
    Route::post('register', [clientController::class, 'register']);
    Route::post('login', [clientController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('addToCart', [cartController::class, 'addToCart']);
        Route::get('getCartItems', [cartController::class, 'getCartItems']);
        Route::put('updateQuantity/{id}', [cartController::class, 'updateQuantity']);
        Route::delete('removeFromCart/{id}', [cartController::class, 'removeFromCart']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
