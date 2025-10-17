@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">
    {{ isset($supplier) ? 'Edit Supplier' : 'Add Supplier' }}
</h1>

<div class="bg-white shadow rounded-lg p-6">
    @include('components.errors')
    <form action="{{ isset($supplier) ? route('admin.suppliers.update', $supplier) : route('admin.suppliers.store') }}" method="POST" class="validate_form">
        @csrf
        @if(isset($supplier)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $supplier->name ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Enter supplier name" allow_characters="a-zA-Z " data-msg-allowcharacters="Only letters and spaces are allowed." required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $supplier->email ?? '') }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Enter email"
                    required>
            </div>


            @unless(isset($supplier))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Enter password"
                    required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endunless

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select
                    name="status"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    required>
                    <option value="1" {{ old('status', $supplier->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $supplier->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-6 flex flex-wrap gap-4">
            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition">
                {{ isset($supplier) ? 'Update Supplier' : 'Create Supplier' }}
            </button>

            <a href="{{ route('admin.suppliers.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection