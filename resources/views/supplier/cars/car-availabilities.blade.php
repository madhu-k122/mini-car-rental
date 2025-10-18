@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Car Availabilities</h2>
    <div class="overflow-x-auto bg-white rounded shadow p-4">
        <table class="min-w-full divide-y divide-gray-200 datatable">
            <thead class="bg-gray-100">
                <tr>
                    <th>Car Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Available</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($availabilities as $av)
                <tr>
                    <td>{{ $av->car->c_name ?? 'N/A' }}</td>
                    <td>{{ $av->a_from_date }}</td>
                    <td>{{ $av->a_to_date }}</td>
                    <td>
                        <select class="availability-dropdown px-2 py-1 border rounded"
                            data-code="{{ $av->car->c_code }}">
                            <option value="1" {{ $av->a_is_available ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$av->a_is_available ? 'selected' : '' }}>No</option>
                        </select>
                    </td>
                    <td>{{ $av->a_status ? 'Active' : 'Inactive' }}</td>
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