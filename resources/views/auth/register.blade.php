@extends('layouts.app')

@section('title', 'Register - Mini Car Rental')

@section('content')
<div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8">
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('images/logo.PNG') }}" alt="Mini Car Rental Logo" class="w-24 h-24 rounded-full shadow-md">
        <h1 class="text-2xl font-bold mt-4 text-gray-800">Create an Account</h1>
        <p class="text-sm text-gray-500 mt-1">Join Mini Car Rental as a supplier.</p>
    </div>

    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <!-- Full Name -->
        <div>
            <label for="u_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input
                type="text"
                id="u_name"
                name="u_name"
                value="{{ old('u_name') }}"
                placeholder="John Doe"
                required
                maxlength="100"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
        </div>

        <!-- Email -->
        <div>
            <label for="u_email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input
                type="email"
                id="u_email"
                name="u_email"
                value="{{ old('u_email') }}"
                placeholder="you@example.com"
                required
                maxlength="100"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
        </div>

        <!-- Password -->
        <div>
            <label for="u_password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                type="password"
                id="u_password"
                name="u_password"
                placeholder="••••••••"
                required
                maxlength="191"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="u_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input
                type="password"
                id="u_password_confirmation"
                name="u_password_confirmation"
                placeholder="••••••••"
                required
                maxlength="191"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
            />
        </div>

        <!-- Hidden role field -->
        <input type="hidden" name="u_role" value="supplier">

        <!-- Submit -->
        <button
            type="submit"
            class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 transition"
        >
            Register
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Log in</a>
    </p>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/register.js') }}" defer></script>
@endpush
