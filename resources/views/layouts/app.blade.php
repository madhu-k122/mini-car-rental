<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mini Car Rental')</title>
<script src="https://cdn.tailwindcss.com"></script>
    @stack('head')
</head>
<body class="bg-gradient-to-br from-purple-700 via-indigo-700 to-blue-700 min-h-screen flex items-center justify-center px-4">
    @yield('content')
    @stack('scripts')
</body>
</html>
