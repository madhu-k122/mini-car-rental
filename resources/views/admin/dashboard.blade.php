@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between hover:scale-105 transform transition">
        <div>
            <h2 class="text-xl font-semibold">Total Cars</h2>
            <p class="text-3xl font-bold">{{ $totalCars }}</p>
        </div>
        <div class="text-white text-4xl">
            <i class="fas fa-car"></i>
        </div>
    </div>

    <div class="bg-green-500 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between hover:scale-105 transform transition">
        <div>
            <h2 class="text-xl font-semibold">Total Bookings</h2>
            <p class="text-3xl font-bold">{{ $totalBookings }}</p>
        </div>
        <div class="text-white text-4xl">
            <i class="fas fa-book"></i>
        </div>
    </div>

    <div class="bg-yellow-500 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between hover:scale-105 transform transition">
        <div>
            <h2 class="text-xl font-semibold">Total Suppliers</h2>
            <p class="text-3xl font-bold">{{ $totalSuppliers }}</p>
        </div>
        <div class="text-white text-4xl">
            <i class="fas fa-users"></i>
        </div>
    </div>
</div>
@endsection
