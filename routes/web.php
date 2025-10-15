<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SupplierController as AdminSupplier;
use App\Http\Controllers\Admin\CarController as AdminCar;
use App\Http\Controllers\Admin\BookingController as AdminBooking;
use App\Http\Controllers\Supplier\DashboardController as SupplierDashboard;
use App\Http\Controllers\Supplier\CarController as SupplierCar;
use App\Http\Controllers\Supplier\BookingController as SupplierBooking;
use App\Http\Controllers\Supplier\AvailabilityController as SupplierAvailability;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('suppliers', AdminSupplier::class);
    Route::resource('cars', AdminCar::class);
    Route::get('bookings', [AdminBooking::class, 'index'])->name('bookings');
});

Route::prefix('supplier')->name('supplier.')->middleware(['auth', RoleMiddleware::class . ':supplier'])->group(function () {
    Route::get('dashboard', [SupplierDashboard::class, 'index'])->name('dashboard');
    Route::resource('cars', SupplierCar::class);
    Route::resource('bookings', SupplierBooking::class);
    Route::resource('availabilities', SupplierAvailability::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
