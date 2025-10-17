<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierCarAvailabilityController extends Controller
{
    public function calendar(Car $car)
    {
        $this->authorize('manageAvailability', $car);
        $availabilities = $car->availabilities()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->a_is_available ? 'Available' : 'Unavailable',
                'start' => $item->a_date,
                'color' => $item->a_is_available ? '#10B981' : '#EF4444',
            ];
        });

        return view('supplier.cars.availability_calendar', compact('car', 'availabilities'));
    }

   public function storeAvailability(Request $request, Car $car)
    {
        $this->authorize('manageAvailability', $car);
        $data = $request->isJson() ? $request->json()->all() : $request->all();
        $start = $data['start_date'];
        $end = $data['end_date'];
        $isAvailable = $data['is_available'];
        for ($date = strtotime($start); $date <= strtotime($end); $date = strtotime('+1 day', $date)) {
            $d = date('Y-m-d', $date);
            $car->availabilities()->updateOrCreate(
                ['a_car_id' => $car->id, 'a_date' => $d],
                ['a_is_available' => $isAvailable, 'a_status' => 1, 'a_updated_by' => auth()->id()]
            );
        }
        return response()->json(['success' => true]);
    }

    public function deleteAvailability(Car $car, CarAvailability $availability)
    {
        $this->authorize('update', $car);
        $availability->delete();
        return response()->json(['success' => true]);
    }

    protected function authorizeCar(Car $car)
    {
        if ($car->c_user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
    }
}
