<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Ensure only suppliers can access
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'supplier') {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $user = auth()->user();

        return view('supplier.dashboard', [
            'myCars' => Car::where('c_user_id', $user->id)->count(),
            'myBookings' => Booking::whereHas('car', function($q) use ($user) {
                $q->where('c_user_id', $user->id);
            })->count(),
        ]);
    }
}
