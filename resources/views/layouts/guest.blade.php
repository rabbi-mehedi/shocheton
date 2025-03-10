<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 min-h-screen">
    <div class="flex flex-col items-center justify-center pt-6 sm:pt-0">
        <!-- Logo -->
        <div>
            <a href="/">
                <!-- You can change the color by adjusting "text-red-600" or "fill-current" -->
                <x-application-logo class="w-20 h-20 fill-current text-red-600" />
            </a>
        </div>

        <!-- Main Container -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
