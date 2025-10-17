<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SupplierController as AdminSupplier;
use App\Http\Controllers\Admin\CarController as AdminCar;
use App\Http\Controllers\Admin\AdminBookingController as AdminBooking;
use App\Http\Controllers\Supplier\BookingsController as SupplierBooking;
use App\Http\Controllers\Supplier\DashboardController as SupplierDashboard;
use App\Http\Controllers\Supplier\CarController as SupplierCar;
use App\Http\Controllers\Supplier\SupplierCarAvailabilityController as SupplierCarAvailability;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'dashboard'])->name('dashboard');
    Route::resource('suppliers', AdminSupplier::class)->parameters(['suppliers' => 'supplier:code']);
    Route::resource('cars', AdminCar::class)->parameters(['cars' => 'car:c_code']);
    Route::get('/bookings', [AdminBooking::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{b_code}', [AdminBooking::class, 'show'])->name('bookings.show');
    Route::post('/cars/update-approval', [AdminCar::class, 'updateApproval'])->name('cars.update-approval');
});

Route::prefix('supplier')->name('supplier.')->middleware(['auth', RoleMiddleware::class . ':supplier'])->group(function () {
    Route::get('dashboard', [SupplierDashboard::class, 'index'])->name('dashboard');
    Route::get('cars/bookings', [SupplierBooking::class, 'index'])->name('cars.bookings');
    Route::get('cars/availabilities/list', [SupplierCarAvailability::class, 'listAvailability'])->name('cars.availability.list');
    Route::get('cars/{car:c_code}/availability', [SupplierCarAvailability::class, 'showAvailability'])->name('cars.availability.show');
    Route::post('cars/{car:c_code}/availability', [SupplierCarAvailability::class, 'storeAvailability'])->name('cars.availability.store');
    Route::delete('cars/{car:c_code}/availability/{availability}', [SupplierCarAvailability::class, 'deleteAvailability'])->name('cars.availability.delete');
    Route::get('cars/{car:c_code}/availability/calendar', [SupplierCarAvailability::class, 'calendar'])->name('cars.availability.calendar');
    Route::resource('cars', SupplierCar::class)->parameters(['cars' => 'car:c_code']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
