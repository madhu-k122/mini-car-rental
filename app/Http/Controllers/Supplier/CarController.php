<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Auth::user()->cars()->paginate(15);
        return view('supplier.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('supplier.cars.create');
    }

    public function store(SupplierCarRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('c_image')) {
            $file = $request->file('c_image');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $path = $file->storeAs('cars', $filename, 'public');
            $data['c_image'] = $path;
        }
        $data['c_code'] = generateRandomStringCode(20);
        $data['c_user_id'] = Auth::id();
        $data['c_status'] = 1;
        Car::create($data);
        return redirect()->route('supplier.cars.index')->with('success', 'Car submitted successfully.');
    }

    public function edit(Car $car)
    {
        $this->authorizeCar($car);
        return view('supplier.cars.create', compact('car'));
    }

    public function update(SupplierCarRequest $request, Car $car)
    {
        $this->authorizeCar($car);
        $data = $request->validated();
        if ($request->hasFile('c_image')) {
            $file = $request->file('c_image');
            if ($car->c_image && Storage::disk('public')->exists($car->c_image)) {
                Storage::disk('public')->delete($car->c_image);
            }
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $path = $file->storeAs('cars', $filename, 'public');
            $data['c_image'] = $path;
        }
        $car->update($data);
        return redirect()->route('supplier.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $this->authorizeCar($car);
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully.']);
    }

    protected function authorizeCar(Car $car)
    {
        if ($car->c_user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
    }

    public function getAllCars()
    {
        return response()->json(Car::all());
    }

    public function getSingleCar($id)
    {
        $car = Car::with('bookings')->find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        return response()->json($car);
    }
}
