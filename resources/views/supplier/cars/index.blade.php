@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Cars List</h2>
        <a href="{{ route('supplier.cars.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add Car</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table id="carsTable" class="min-w-full divide-y divide-gray-200 datatable">
            <thead class="bg-gray-100">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Price/Day</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr data-id="{{ $car->c_code }}">
                    <td>{{ $car->c_name }}</td>
                    <td>{{ $car->c_type }}</td>
                    <td>{{ $car->c_location }}</td>
                    <td>₹{{ $car->c_price_per_day }}</td>
                    <td>
                        @if($car->c_status)
                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Active</span>
                        @else
                        <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="space-x-2">
                        <a href="{{ route('supplier.cars.availability.calendar', $car->c_code) }}"
                            class="text-blue-600 hover:underline">
                            Set Availability
                        </a>
                        <a href="{{ route('supplier.cars.edit', $car) }}" class="text-blue-600 hover:underline">Edit</a>
                        <a href="#" class="text-red-600 hover:underline delete-btn" data-id="{{ $car->c_code }}" data-name="{{ $car->c_name }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
@push('scripts')
<script src="{{ asset('js/supplier-cars.js') }}"></script>
@endpush
