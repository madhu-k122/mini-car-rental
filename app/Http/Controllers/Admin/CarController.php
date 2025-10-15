<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('supplier')->paginate(20);
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $req)
    {
        $req->validate([
            'supplier_id' => 'required|exists:users,id',
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $req->only('supplier_id','name','type','location','price_per_day');
        if ($req->hasFile('image')) {
            $path = $req->file('image')->store('cars', 'public');
            $data['image'] = $path;
        }
        $data['is_approved'] = true;
        Car::create($data);
        return redirect()->route('admin.cars.index')->with('success','Car added.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $req, Car $car)
    {
        $req->validate([
            'name' => 'required',
            'type' => 'required',
            'location' => 'required',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = $req->only('name','type','location','price_per_day');
        if ($req->hasFile('image')) {
            $data['image'] = $req->file('image')->store('cars', 'public');
        }
        $car->update($data);
        return redirect()->route('admin.cars.index')->with('success','Car updated.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success','Car removed.');
    }
}
