<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CarApprovalStatusMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $data = [
            'c_code' => $code,
            'c_user_id' => $request->c_user_id,
            'c_name' => $request->c_name,
            'c_type' => $request->c_type,
            'c_location' => $request->c_location,
            'c_price_per_day' => $request->c_price_per_day,
            'c_is_approved' => $request->c_is_approved,
            'status' => $request->c_status,
            'c_created_by' => Auth::id(),
            'created_at' => now(),
        ];

        if ($request->hasFile('c_image')) {
            $file = $request->file('c_image');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $path = $file->storeAs('cars', $filename, 'public');
            $data['c_image'] = $path;
        }
        Car::create($data);
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
        return redirect()->route('admin.cars.index')->with('success', 'Car updated.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return response()->json(['status'=>true,'message' => 'Car deleted successfully.']);
    }

    public function updateApproval(Request $request)
    {
        $car = Car::where('c_code', $request->c_code)->with('supplier')->first();
        if (!$car) {
            return response()->json(['status'=>false,'message' => 'Car not found'], 404);
        }
        $car->c_is_approved = $request->c_is_approved;
        $car->save();
        $statusText = $car->c_is_approved ? 'approved' : 'disapproved';
        try {
            if ($car->supplier && $car->supplier->email) {
                Mail::to($car->supplier->email)->send(new CarApprovalStatusMail($car, $statusText));
            }
            return response()->json(['status'=>true,'message' => "Car approval status updated and email sent successfully."]);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => "Status updated, but email could not be sent.",
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
