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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        
        <!-- 🚀 ACCESSIBILITY VIP FEATURE: Skip to Main Content -->
        <!-- Ye button aam tor par chupa rahega, sirf 'Tab' key press karne par top par show hoga -->
        <a href="#main-content" class="absolute top-0 left-0 -translate-y-full focus:translate-y-0 bg-orange-500 text-white font-black py-4 px-8 z-[9999] transition-transform duration-300 rounded-br-2xl shadow-2xl focus:outline-none focus:ring-4 focus:ring-blue-950 uppercase tracking-widest text-sm">
            Skip to Main Content
        </a>

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <!-- 🚀 ACCESSIBILITY: ID aur tabindex add kiya gaya hai taake uper wala button yahan jump kare -->
            <main id="main-content" tabindex="-1" class="focus:outline-none">
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
             
        </div>
    </body>
</html>