<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\API\Customer\RegisterCustomerRequest;
use App\Http\Requests\API\Customer\LoginCustomerRequest;

class AuthController extends Controller
{
    public function register(RegisterCustomerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'code'=>generateRandomStringCode(20),
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);
        $token = $user->createToken('customer-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(LoginCustomerRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $user->createToken('customer-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
