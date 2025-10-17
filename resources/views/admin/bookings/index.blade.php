@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Bookings</h2>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table id="bookingsTable" class="min-w-full bg-white rounded shadow datatable">
            <thead class="bg-gray-200">
                <tr>
                    <th>Car</th>
                    <th>Customer</th>
                    <th>Start Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->car->c_name ?? 'N/A' }}</td>
                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                    <td>{{ $booking->b_start_date }}</td>
                    <td>
                        <button class="view-booking text-blue-600 hover:underline"
                            data-booking='@json($booking)'>
                            View
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="bookingModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50 view-booking">
    <div class="bg-white rounded shadow-lg w-11/12 md:w-1/2 p-6 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl font-bold">✕</button>
        <h3 class="text-xl font-bold mb-4">Booking Details</h3>
        <div id="bookingDetails" class="space-y-2 text-gray-700"></div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/car-bookings.js') }}" defer></script>
@endpush