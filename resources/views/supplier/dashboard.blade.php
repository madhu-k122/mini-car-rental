@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-blue-500 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between hover:scale-105 transform transition">
        <div>
            <h2 class="text-xl font-semibold">My Cars</h2>
            <p class="text-3xl font-bold">{{ $myCars }}</p>
        </div>
        <div class="text-white text-4xl">
            <i class="fas fa-car"></i>
        </div>
    </div>

    <div class="bg-green-500 text-white p-6 rounded-2xl shadow-lg flex items-center justify-between hover:scale-105 transform transition">
        <div>
            <h2 class="text-xl font-semibold">My Bookings</h2>
            <p class="text-3xl font-bold">{{ $myBookings }}</p>
        </div>
        <div class="text-white text-4xl">
            <i class="fas fa-book"></i>
        </div>
    </div>
</div>
@endsection
