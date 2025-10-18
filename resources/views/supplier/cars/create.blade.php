@extends('layouts.app')
@section('title', 'My Bookings')
@section('page-title', 'My Bookings')@section('content')
<div class="max-w-10xl mx-auto px-4 py-6">
    <div class="card w-full">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            {{ isset($car) ? 'Edit Car' : 'Add Car' }}
        </h2>
        @include('components.errors')
        <form action="{{ isset($car) ? route('supplier.cars.update', $car) : route('supplier.cars.store') }}"
            method="POST" enctype="multipart/form-data" class="space-y-6 validate_form">
            @csrf
            @if(isset($car)) @method('PUT') @endif
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="c_name" placeholder="Name" value="{{ old('c_name', $car->c_name ?? '') }}"
                        class="input-field" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Type</label>
                    <input type="text" name="c_type" value="{{ old('c_type', $car->c_type ?? '') }}"
                        class="input-field" placeholder="Type" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" name="c_location" placeholder="Location" value="{{ old('c_location', $car->c_location ?? '') }}" class="input-field" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Price per Day</label>
                    <input type="number" name="c_price_per_day" placeholder="Price per Day" value="{{ old('c_price_per_day', $car->c_price_per_day ?? '') }}" class="input-field" required>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Status</label>
                    <select name="c_status" class="input-field" required>
                        <option value="1" {{ old('c_status', $car->c_status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('c_status', $car->c_status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" name="c_image" class="input-field">
                    @if(isset($car) && $car->c_image)
                    <img src="{{ asset('storage/'.$car->c_image) }}" class="mt-3 w-24 h-24 object-cover rounded">
                    @endif
                </div>

            </div>

            <div class="flex space-x-3 pt-4">
                <button type="submit" class="btn-primary">
                    {{ isset($car) ? 'Update Car' : 'Add Car' }}
                </button>
                <a href="{{ route('supplier.cars.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection