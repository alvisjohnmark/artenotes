<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\adminController;
use App\Http\Controllers\Auth\clientController;
use App\Http\Controllers\appController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\PaymentController;

//home routes
Route::get('/getProducts', [appController::class, 'getProducts']);
Route::get('/getServices', [appController::class, 'getServices']);
Route::post('/payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/confirm-payment/{id}', [PaymentController::class, 'confirmPayment']);
Route::post('/update-order-status', [PaymentController::class, 'updateOrderStatus']);
Route::put('orderStatus/{id}', [PaymentController::class, 'updateOrderStatus']);

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
        Route::get('getClientDetails', [clientController::class, 'getClientDetails']);
        Route::put('saveAddress/{id}', [clientController::class, 'saveAddress']);
        Route::post('checkoutOrder/{id}', [cartController::class, 'checkoutOrder']);
        Route::put('saveOrderItems', [cartController::class, 'saveOrderItems']);
        Route::put('updateChecked/{id}', [cartController::class, 'updateChecked']);
        Route::get('getOrderItems', [cartController::class, 'getOrderItems']);
        Route::delete('removeFromOrder/{id}', [cartController::class, 'removeFromOrder']);
        
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
