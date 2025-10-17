@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Cars List</h2>
        <a href="{{ route('admin.cars.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Add Car
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table class="min-w-full bg-white rounded shadow overflow-hidden datatable">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Supplier</th>
                    <th class="px-4 py-2">Price/Day</th>
                    <th class="px-4 py-2">Approved</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $car->c_name }}</td>
                    <td class="px-4 py-2">{{ $car->supplier?->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $car->c_price_per_day }}</td>
                    <td class="px-4 py-2">{{ $car->c_is_approved ? 'Yes' : 'No' }}</td>
                    <td>
                        @if($car->c_status)
                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Active</span>
                        @else
                        <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.cars.edit', $car->c_code) }}" class="text-blue-600 hover:underline">Edit</a>
                        <a href="#" class="text-red-600 hover:underline car-delete-btn" data-id="{{ $car->c_code }}" data-name="{{ $car->c_name }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/car-bookings.js') }}" defer></script>
@endpush