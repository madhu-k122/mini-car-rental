@extends('layouts.app')

@section('title', 'Supplier Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Supplier Dashboard</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="bg-white p-4 shadow rounded">My Cars: <strong>{{ $myCars }}</strong></div>
        <div class="bg-white p-4 shadow rounded">My Bookings: <strong>{{ $myBookings }}</strong></div>
    </div>
@endsection
