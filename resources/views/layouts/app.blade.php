<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <nav class="bg-gray-900 text-white py-4 mb-8">
        <div class="max-w-7xl mx-auto px-4">
            <a class="text-xl font-bold" href="/">Form Builder</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4">
        @yield('content')
    </div>

    @livewireScripts
</body>
</html>