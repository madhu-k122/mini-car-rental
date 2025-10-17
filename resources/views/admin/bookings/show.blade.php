@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Booking Details</h1>

<div class="bg-white shadow rounded p-6">
    <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
    <p><strong>Car:</strong> {{ $booking->car->c_name ?? 'N/A' }}</p>
    <p><strong>Customer:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
    <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
    <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
    <p><strong>Total Price:</strong> ₹{{ number_format($booking->total_price, 2) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
</div>

<a href="{{ route('admin.bookings.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
@endsection
