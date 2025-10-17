@extends('layouts.auth')

@section('title', 'Register - Mini Car Rental')

@section('content')
<div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8">
    @include('components.errors')
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('images/logo.PNG') }}" alt="Mini Car Rental Logo" class="w-24 h-24 rounded-full shadow-md">
        <h1 class="text-2xl font-bold mt-4 text-gray-800">Create an Account</h1>
        <p class="text-sm text-gray-500 mt-1">Join Mini Car Rental as a supplier.</p>
    </div>

    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5 validate_form">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="John Doe"
                required
                maxlength="100"
                class="common-input-field" allow_characters="a-zA-Z " data-msg-allowcharacters="Only letters and spaces are allowed."/>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="you@example.com"
                required
                maxlength="100"
                class="common-input-field" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                maxlength="191"
                class="common-input-field" />
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
            <select
                id="role"
                name="role"
                required
                class="common-input-field">
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Choose Role --</option>
                <option value="supplier" {{ old('role') == 'supplier' ? 'selected' : '' }}>Supplier</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button
            type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition">
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Log in</a>
    </p>
</div>
@endsection
