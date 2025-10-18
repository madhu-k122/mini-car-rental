<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerBookingRequest;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('car')->get();
        return response()->json($bookings);
    }

    public function store(CustomerBookingRequest $request)
    {
        $booking = Booking::create([
            'b_code'=>Str::upper(Str::random(10)),
            'b_car_id'=>$request->b_car_id,
            'b_user_id'=>auth()->id(),
            'b_start_date'=>$request->b_start_date,
            'b_end_date'=>$request->b_end_date,
            'b_from_location' => $request->b_from_location,
            'b_to_location' => $request->b_to_location,
            'b_status'=>'pending',
        ]);
        return response()->json($booking,201);
    }
}
