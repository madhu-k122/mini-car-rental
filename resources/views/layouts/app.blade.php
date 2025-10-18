<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mini Car Rental')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/common_classes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    @stack('head')
</head>

<body class="bg-gray-100 min-h-screen flex">
    @include('layouts.navigation')
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold"></h1>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="focus:outline-none flex items-center space-x-2">
                    <div class="w-9 h-9 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </button>

                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                    <div class="p-4 border-b">
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="p-2">
                        <button onclick="confirmLogout()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <main class="p-6 flex-1">
            @yield('content')
        </main>

        <footer class="bg-white text-center py-4 border-t text-sm text-gray-500">
            &copy; {{ date('Y') }} Mini Car Rental
        </footer>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/cdn.min.js') }}"></script>
    <script src="{{ asset('js/custom-validation.js') }}"></script>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>

</html>