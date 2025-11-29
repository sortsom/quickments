<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tabler CSS -->
    <link href="https://unpkg.com/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@tabler/icons@latest/iconfont/tabler-icons.min.css" rel="stylesheet">
    
    <!-- List.js - client-side search/sort/pagination for tables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    
    <!-- Custom styles - only if file exists -->
    @if(file_exists(public_path('css/style.css')))
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @endif

    <!-- Scripts -->
<<<<<<< Updated upstream
    @vite(['resources/css/app.css', 'resources/js/app.js'])
=======
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
    @stack('styles')
>>>>>>> Stashed changes
</head>

<body>
    <div class="page">
        @include('layouts.navigation')

        <!-- Page Content -->
        <div class="page-wrapper">
            {{ $slot }}
        </div>
    </div>
<<<<<<< Updated upstream
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js"></script>
=======

    <!-- Tabler JS -->
    <script src="https://unpkg.com/@tabler/core@latest/dist/js/tabler.min.js"></script>
    
    @stack('scripts')
>>>>>>> Stashed changes
</body>

</html>