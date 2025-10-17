@extends('layouts.supplier')

@section('title', 'Add Car Availability')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Add Availability - {{ $car->c_name }}</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    <form method="POST" action="{{ route('supplier.cars.availability.store', $car->id) }}" class="bg-white p-4 rounded shadow">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-2 font-semibold">From Date</label>
                <input type="date" name="start_date" class="border rounded w-full p-2" required>
            </div>
            <div>
                <label class="block mb-2 font-semibold">To Date</label>
                <input type="date" name="end_date" class="border rounded w-full p-2" required>
            </div>
            <div>
                <label class="block mb-2 font-semibold">Available?</label>
                <select name="is_available" class="border rounded w-full p-2" required>
                    <option value="1">Yes (Available)</option>
                    <option value="0">No (Unavailable)</option>
                </select>
            </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Add Availability</button>
    </form>
</div>
@endsection
