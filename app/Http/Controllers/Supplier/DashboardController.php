<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;

class DashboardController extends Controller
{   
    public function index()
    {
        $user = auth()->user();
        return view('supplier.dashboard', [
            'myCars' => Car::where('c_user_id', $user->id)->count(),
            'myBookings' => Booking::whereHas('car', function ($query) use ($user) {
                $query->where('c_user_id', $user->id);
            })->count(),
        ]);
    }
}
