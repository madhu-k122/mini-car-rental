<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingsController extends Controller
{
    public function index()
    {
        return view('supplier.cars.bookings');
    }

    public function bookingsList()
    {
        $bookings = Booking::with(['car', 'user'])->get();
        $data = $bookings->map(function ($b) {
            return [
                'car_name'   => $b->car->c_name ?? '-',
                'user_name'  => $b->user->name ?? '-',
                'start_date' => $b->b_start_date ?? '-',
                'end_date'   => $b->b_end_date ?? '-',
                'status'     => ucfirst($b->b_status ?? '-'),
            ];
        });
        return response()->json(['data' => $data]);
    }
}

