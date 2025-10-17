<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Mini Car Rental')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/common_classes.css') }}">
    <link href="{{ asset('css/validation.css') }}" rel="stylesheet" />
    @stack('head')
</head>

<body class="bg-gradient-to-br from-purple-700 via-indigo-700 to-blue-700 min-h-screen flex items-center justify-center px-4">

    @yield('content')

    @stack('scripts')

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/custom-validation.js') }}"></script>
</body>

</html>