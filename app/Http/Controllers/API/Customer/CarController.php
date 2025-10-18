<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::where('c_status',1)->get();
        return response()->json($cars);
    }

    public function show($c_code)
    {
        $car = Car::where('c_code',$c_code)->where('c_is_approved',1)->first();
        if(!$car){
            return response()->json(['message'=>'Car not found'],404);
        }
        return response()->json($car);
    }
}
