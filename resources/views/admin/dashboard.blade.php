@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded">Total Cars: <strong>{{ $totalCars }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Total Bookings: <strong>{{ $totalBookings }}</strong></div>
        <div class="bg-white p-4 shadow rounded">Total Suppliers: <strong>{{ $totalSuppliers }}</strong></div>
    </div>
@endsection
