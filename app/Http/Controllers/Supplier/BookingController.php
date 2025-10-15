<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $supplier = Auth::user();
        $bookings = Booking::where('user_id', $supplier->id)->with('car')->orderBy('from_date','desc')->paginate(20);
        return view('supplier.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorizeBooking($booking);
        return view('supplier.bookings.show', compact('booking'));
    }

    protected function authorizeBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
