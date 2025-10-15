@extends('layouts.app')
@section('content')
    <h1>Cars (Admin)</h1>
    <a href="{{ route('admin.cars.create') }}">Add Car</a>
    <table>
        <thead><tr><th>ID</th><th>Name</th><th>Supplier</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->supplier->name }}</td>
                <td>{{ $car->is_approved ? 'Approved' : 'Pending' }}</td>
                <td>
                    <a href="{{ route('admin.cars.edit', $car) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.cars.destroy', $car) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $cars->links() }}
@endsection
