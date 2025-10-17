<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Supplier\CarController as SupplierCar;
use App\Http\Controllers\Customer\BookingController;

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->group(function () {

    // // 🔹 Register & Login (Public)
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/login', [AuthController::class, 'login']);

    // // 🔒 Protected routes (need Sanctum token)
    // Route::middleware('auth:sanctum')->group(function () {

    //     // 🔹 Logout
    //     Route::post('/logout', [AuthController::class, 'logout']);

    // 🔹 Cars API
    // Route::get('/cars', [SupplierCar::class, 'getAllCars']);
    // Route::get('/cars/{c_code}', [SupplierCar::class, 'getSingleCar']);

    // 🔹 Booking API
    // Route::get('/bookings', [BookingController::class, 'index']); // All bookings for customer
    // Route::post('/bookings', [BookingController::class, 'store']); // Create a new booking
});
