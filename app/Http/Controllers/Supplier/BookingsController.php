<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        $supplierId = auth()->id();
        $bookings = Booking::with(['car', 'user'])->whereHas('car', function ($query) use ($supplierId) {
                $query->where('c_user_id', $supplierId);
            })->orderByDesc('created_at')->get();
        return view('supplier.cars.bookings', compact('bookings'));
    }
}

