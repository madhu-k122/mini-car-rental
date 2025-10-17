<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalCars = Car::count();
        $totalBookings = Booking::count();
        $totalSuppliers = User::where('role', 'supplier')->count();
        return view('admin.dashboard', compact('totalCars', 'totalBookings', 'totalSuppliers'));
    }
}
