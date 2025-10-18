@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ isset($car) ? 'Edit Car' : 'Add Car' }}</h1>
<div class="bg-white shadow rounded p-6">
    @include('components.errors')
    <form action="{{ isset($car) ? route('admin.cars.update', $car->c_code) : route('admin.cars.store') }}"
        method="POST" enctype="multipart/form-data" class="space-y-4 validate_form">
        @csrf
        @if(isset($car)) @method('PUT') @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1 font-medium">Supplier</label>
                @if(isset($suppliers) && $suppliers)
                <select name="c_user_id" class="border p-2 w-full rounded" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ (old('c_user_id', $car->c_user_id ?? '') == $supplier->id) ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                    @endforeach
                </select>
                @endif

            </div>
            <div>
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="c_name" value="{{ old('c_name', $car->c_name ?? '') }}" class="border p-2 w-full rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Type</label>
                <input type="text" name="c_type" value="{{ old('c_type', $car->c_type ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1 font-medium">Location</label>
                <input type="text" name="c_location" value="{{ old('c_location', $car->c_location ?? '') }}" class="border p-2 w-full rounded" required>
            </div>
            <div>
                <label class="block mb-1 font-medium">Price per Day</label>
                <input type="number" step="0.01" name="c_price_per_day" value="{{ old('c_price_per_day', $car->c_price_per_day ?? '') }}" class="border p-2 w-full rounded" required>
            </div>

            <div>
                <label class="block mb-1 font-medium">Approved</label>
                <select name="c_is_approved" class="border p-2 w-full rounded" required>
                    <option value="0" {{ (old('c_is_approved', $car->c_is_approved ?? 0) == 0) ? 'selected' : '' }}>No</option>
                    <option value="1" {{ (old('c_is_approved', $car->c_is_approved ?? 0) == 1) ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="c_status" class="border p-2 w-full rounded" required>
                    <option value="1" {{ (old('c_status', $car->c_status ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ (old('c_status', $car->c_status ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Car Image</label>
                <input type="file" name="c_image" class="border p-2 w-full rounded">
                @if(isset($car) && $car->c_image)
                <img src="{{ asset('storage/'.$car->c_image) }}" class="mt-3 w-24 h-24 object-cover rounded">
                @endif
            </div>
        </div>

        <div class="flex space-x-2 mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($car) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.cars.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection