@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Suppliers List</h2>
        <a href="{{ route('admin.suppliers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Add Supplier
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table id="suppliersTable" class="min-w-full divide-y divide-gray-200 datatable">
            <thead class="bg-gray-100">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr data-id="{{ $supplier->code }}">
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>
                        @if($supplier->status)
                        <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Active</span>
                        @else
                        <span class="px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="space-x-2">
                        <a href="{{ route('admin.suppliers.edit', $supplier->code) }}" class="text-blue-600 hover:underline">Edit</a>
                        <a href="#" class="text-red-600 hover:underline delete-btn" data-id="{{ $supplier->code }}" data-name="{{ $supplier->name }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('js/suppliers.js') }}" defer></script>
@endpush
