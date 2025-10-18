<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request): RedirectResponse
    {
        $code = generateRandomStringCode(20);
        $user = User::create([
            'code'     => $code,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => 1,
            'created_at' => now(),
        ]);
        event(new Registered($user));
        return redirect()->route('login')->with('success', 'Registered successfully, please login.');
    }
}
