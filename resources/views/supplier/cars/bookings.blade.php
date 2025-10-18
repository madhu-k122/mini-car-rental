@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">My Car Bookings</h2>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table id="bookingsTable" class="min-w-full divide-y divide-gray-200 datatable">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Car Name</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Start Date</th>
                    <th class="px-4 py-2 text-left">End Date</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td class="px-4 py-2">{{ $booking->car->c_name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $booking->user->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $booking->b_start_date }}</td>
                        <td class="px-4 py-2">{{ $booking->b_end_date }}</td>
                        <td class="px-4 py-2 capitalize">{{ $booking->b_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/car-bookings.js') }}"></script>
@endpush
