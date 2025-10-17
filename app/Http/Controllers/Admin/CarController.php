<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('supplier')->orderBy('created_at', 'desc')->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $user = auth()->user();
        $suppliers = $user->role === 'admin' ? User::where('role', 'supplier')->get() : null;
        return view('admin.cars.create', compact('user', 'suppliers'));
    }

    public function store(AdminCarRequest $request)
    {
        $code = generateRandomStringCode(20);
        $car = Car::create([
            'c_code' => $code,
            'c_user_id' => $request->c_user_id,
            'c_name' => $request->c_name,
            'c_type' => $request->c_type,
            'c_location' => $request->c_location,
            'c_price_per_day' => $request->c_price_per_day,
            'c_is_approved' => $request->c_is_approved,
            'status' => $request->c_status,
            'c_created_by'=>Auth::id(),
            'created_at' => now(),
        ]);
        if ($request->hasFile('c_image')) {
            $car->c_image = $request->file('c_image')->store('cars', 'public');
            $car->save();
        }
        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
    }


    public function edit(Car $car)
    {
        $user = auth()->user();
        $suppliers = $user->role === 'admin' ? User::where('role', 'supplier')->get() : collect();
        return view('admin.cars.create', compact('car', 'suppliers'));
    }


    public function update(AdminCarRequest $request, Car $car)
    {
        $data = [
            'c_user_id' => $request->c_user_id,
            'c_name' => $request->c_name,
            'c_type' => $request->c_type,
            'c_location' => $request->c_location,
            'c_price_per_day' => $request->c_price_per_day,
            'c_is_approved' => $request->c_is_approved,
            'c_status' => $request->c_status,
            'c_updated_by' => Auth::id(),
            'updated_at' => now(),
        ];
        if ($request->hasFile('c_image')) {
            $data['c_image'] = $request->file('c_image')->store('cars', 'public');
        }
        $car->update($data);
        return redirect()->route('admin.cars.index')->with('success', 'Car updated.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully.']);
    }
}
