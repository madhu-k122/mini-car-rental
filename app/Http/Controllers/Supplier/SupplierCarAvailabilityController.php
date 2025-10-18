<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SupplierCarAvailabilityController extends Controller
{
    public function index()
    {
        $availabilities = CarAvailability::with('car')->orderBy('a_from_date', 'desc')->get();
        return view('supplier.cars.car-availabilities', compact('availabilities'));
    }

    public function getAvailability($c_code)
    {
        $car = Car::where('c_code', $c_code)->firstOrFail();
        $availabilities = CarAvailability::where('a_car_id', $car->id)->get();
        return response()->json([
            'car' => $car,
            'availabilities' => $availabilities
        ]);
    }

    public function updateAvailability(Request $request, $c_code)
    {
        $request->validate([
            'a_from_date' => 'required|date|after_or_equal:' . Carbon::today()->format('Y-m-d'),
            'a_to_date'   => 'required|date|after_or_equal:a_from_date',
        ]);
        $car = Car::where('c_code', $c_code)->first();
        if (!$car) {
            return response()->json(['message' => 'Car not found.'], 404);
        }
        $from_date = Carbon::parse($request->a_from_date);
        $to_date   = Carbon::parse($request->a_to_date);
        CarAvailability::create([
            'a_car_id'      => $car->id,
            'a_from_date'   => $from_date,
            'a_to_date'     => $to_date,
            'a_code'        => generateRandomStringCode(20),
            'a_is_available' => 1,
            'a_status'      => 1,
            'a_created_by'  => Auth::id(),
        ]);
        return response()->json(['message' => 'Availability added successfully']);
    }

    public function updateAvailableStatus(Request $request, $c_code)
    {
        $car = Car::where('c_code', $c_code)->firstOrFail();
        $availability = CarAvailability::where('a_car_id', $car->id)->latest()->first();
        if (!$availability) {
            return response()->json(['success' => false, 'message' => 'No availability found for this car.']);
        }
        $availability->a_is_available = $request->a_is_available;
        $availability->save();
        return response()->json(['success' => true]);
    }
}
