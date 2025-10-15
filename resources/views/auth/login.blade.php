@extends('layouts.auth')

@section('title', 'Login - Mini Car Rental')

@section('content')
<div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8">
    @include('components.errors')
    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('images/logo.PNG') }}" alt="Mini Car Rental Logo" class="w-24 h-24 rounded-full shadow-md">
        <h1 class="text-2xl font-bold mt-4 text-gray-800">Mini Car Rental</h1>
        <p class="text-sm text-gray-500 mt-1">Welcome back! Please login to your account.</p>
    </div>

    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-5 validate_form">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="you@example.com"
                required
                value="{{ old('email') }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
            <p id="emailError" class="mt-1 text-red-600 text-sm hidden"></p>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
            <p id="passwordError" class="mt-1 text-red-600 text-sm hidden"></p>
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center">
                <input
                    type="checkbox"
                    name="remember"
                    class="text-indigo-600 rounded border-gray-300 focus:ring-indigo-500"
                />
                <span class="ml-2 text-gray-600">Remember me</span>
            </label>
            <a href="#" class="text-indigo-600 hover:underline">Forgot password?</a>
        </div>

        <button
            type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition"
        >
            Log In
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Register here</a>
    </p>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/login.js') }}" defer></script>
@endpush
