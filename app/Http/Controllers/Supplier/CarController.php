<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierCarRequest;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

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
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        $data['user_id'] = Auth::id();
        $data['available'] = true; // default availability
        Car::create($data);
        return redirect()->route('supplier.cars.index')->with('success', 'Car submitted successfully.');
    }

    public function edit(Car $car)
    {
        $this->authorizeCar($car);
        return view('supplier.cars.edit', compact('car'));
    }

    public function update(SupplierCarRequest $request, Car $car)
    {
        $this->authorizeCar($car);

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('supplier.cars.index')->with('success', 'Car updated successfully.');
    }

    public function destroy(Car $car)
    {
        $this->authorizeCar($car);
        $car->delete();
        return redirect()->route('supplier.cars.index')->with('success', 'Car deleted successfully.');
    }

    protected function authorizeCar(Car $car)
    {
        if ($car->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }
    }
}
