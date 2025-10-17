<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['car', 'supplier'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($b_code)
    {
        $booking = Booking::with(['car', 'supplier'])->where('b_code', $b_code)->firstOrFail();
        return view('admin.bookings.show', compact('booking'));
    }
}
