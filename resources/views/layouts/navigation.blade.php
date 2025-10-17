<aside class="w-64 bg-white shadow-md flex flex-col h-screen">
    <div class="px-6 py-4 border-b border-gray-200 flex items-center space-x-4">
        <img src="{{ asset('images/logo.png') }}" alt="Mini Car Rental Logo" class="h-10 w-10 object-contain">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Hello, {{ auth()->user()->name }}
            </h2>
            <p class="text-sm text-gray-500 capitalize">Welcome</p>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 overflow-y-auto">
        <ul class="space-y-2">
            @if(auth()->user()->role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.suppliers.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.suppliers.*') ? 'bg-gray-200 font-bold' : '' }}">
                    Manage Suppliers
                </a>
            </li>
            <li>
                <a href="{{ route('admin.cars.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.cars.*') ? 'bg-gray-200 font-bold' : '' }}">
                    Manage Cars
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bookings.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-200 font-bold' : '' }}">
                    <i class="fas fa-book"></i> Bookings
                </a>
            </li>

            </li>
            @elseif(auth()->user()->role === 'supplier')
            <li>
                <a href="{{ route('supplier.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('supplier.dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.cars.index') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('supplier.cars.*') ? 'bg-gray-200 font-bold' : '' }}">
                    My Cars
                </a>
            </li>
            <li>
                <a href="{{ route('supplier.cars.bookings') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('supplier.cars.bookings') ? 'bg-gray-200 font-bold' : '' }}">
                    My Bookings
                </a>
            </li>

            <li>
                <a href="{{ route('supplier.cars.availability.calendar', $car->c_code ?? '#') }}"
                    class="block py-2 px-4 rounded hover:bg-gray-200 {{ request()->routeIs('supplier.cars.availability.*') ? 'bg-gray-200 font-bold' : '' }}">
                    Availability Calendar
                </a>
            </li>


            @endif
        </ul>
    </nav>
</aside>