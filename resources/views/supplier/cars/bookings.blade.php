@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Bookings</h2>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table id="bookingsTable" class="min-w-full divide-y divide-gray-200 datatable">
            <thead>
                <tr>
                    <th>Car Name</th>
                    <th>User</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/car-bookings.js') }}"></script>
@endpush
