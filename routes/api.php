<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Api\Customer\CarController as CustomerCarController;
use App\Http\Controllers\Api\Customer\BookingController as CustomerBookingController;

Route::prefix('customer')->group(function () {
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [CustomerAuthController::class, 'logout']);
        Route::get('cars', [CustomerCarController::class, 'index']);
        Route::get('cars/{c_code}', [CustomerCarController::class, 'show']);
        Route::get('bookings', [CustomerBookingController::class, 'index']);
        Route::post('bookings', [CustomerBookingController::class, 'store']);
    });
});
