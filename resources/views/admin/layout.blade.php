<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DriveElite | Command Center</title>
    
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/741/741407.png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom Scrollbar for Sidebar */
        .custom-scrollbar::-webkit-scrollbar { width: 0px; background: transparent; }
        .custom-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-white flex flex-col shadow-2xl transition-all duration-300 relative z-20">
            <div class="h-20 flex items-center justify-center border-b border-gray-700/50 bg-gray-900/50 backdrop-blur-sm">
                <h1 class="text-2xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-white uppercase">
                    <i class="fa-solid fa-car-side text-red-500 mr-2"></i> DriveElite
                </h1>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">
                
                <p class="px-4 pb-2 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Main Menu</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-red-600 to-red-500 shadow-lg shadow-red-500/20 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5' }} rounded-xl transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-gauge-high w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Dashboard</span>
                </a>
                
                <div class="py-4">
                    <div class="border-t border-gray-700/50"></div>
                </div>

                <p class="px-4 pb-2 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">Fleet Operations</p>
                
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('categories.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-layer-group w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Vehicle Categories</span>
                </a>
                
                <a href="{{ route('cars.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('cars.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-car-rear w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Fleet Management</span>
                </a>

                <a href="{{ route('maintenances.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('maintenances.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-screwdriver-wrench w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Maintenance Logs</span>
                </a>

                <a href="{{ route('bookings.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('bookings.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-calendar-check w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Reservations</span>
                </a>

                <a href="{{ route('reviews.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('reviews.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <div class="flex items-center">
                        <i class="fa-solid fa-star-half-stroke w-6 text-lg text-orange-500"></i> 
                        <span class="font-bold tracking-wide ml-1">Elite Reflections</span>
                    </div>
                    @php $pendingReviews = \App\Models\Review::where('is_published', false)->count(); @endphp
                    @if($pendingReviews > 0)
                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-orange-500 text-[10px] font-black text-white animate-pulse">
                            {{ $pendingReviews }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('contacts.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('contacts.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <div class="flex items-center">
                        <i class="fa-solid fa-comment-dots w-6 text-lg"></i> 
                        <span class="font-bold tracking-wide">Client Messages</span>
                    </div>
                    @php $unreadCount = \App\Models\Contact::where('status', 'unread')->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-black text-white animate-pulse">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('users.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-users w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Customers</span>
                </a>

                <a href="{{ route('admin.payments') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.payments') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-file-invoice-dollar w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">Payments & Revenue</span>
                </a>

                <a href="{{ route('newsletters.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('newsletters.*') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-envelopes-bulk w-6 text-lg text-blue-400"></i> 
                    <span class="font-bold tracking-wide">Newsletter Hub</span>
                </a>

                <a href="{{ route('admin.cookies') }}" class="flex items-center justify-between px-4 py-3 rounded-xl {{ request()->routeIs('admin.cookies') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <div class="flex items-center">
                        <i class="fa-solid fa-cookie-bite w-6 text-lg text-yellow-500"></i> 
                        <span class="font-bold tracking-wide">Cookie Consents</span>
                    </div>
                    @php 
                        try {
                            $consentCount = \App\Models\CookieConsent::count(); 
                        } catch(\Exception $e) {
                            $consentCount = 0;
                        }
                    @endphp
                    @if($consentCount > 0)
                        <span class="flex h-5 w-auto px-2 items-center justify-center rounded-full bg-gray-700 text-[10px] font-black text-white">
                            {{ $consentCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.settings') ? 'bg-white/10 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-white/5' }} transition duration-200">
                    <i class="fa-solid fa-gears w-6 text-lg"></i> 
                    <span class="font-bold tracking-wide">System Settings</span>
                </a>
            </nav>

            <div class="p-5 border-t border-gray-700/50 bg-gray-900/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gray-800 hover:bg-red-600 rounded-xl text-gray-300 hover:text-white transition duration-300 shadow-sm group">
                        <i class="fa-solid fa-power-off mr-3 group-hover:rotate-90 transition-transform"></i> 
                        <span class="font-black text-sm uppercase tracking-widest">Secure Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F8FAFC]">
            
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center justify-between px-8 z-10 sticky top-0">
                <h2 class="text-2xl font-black text-gray-800 tracking-tight italic uppercase">
                    @yield('header_title', 'Command Center')
                </h2>
                <div class="flex items-center space-x-6">
                    <button class="relative text-gray-400 hover:text-red-500 transition">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 -mt-1 -mr-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    </button>
                    
                    <div class="flex items-center pl-6 border-l border-gray-200">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-red-500 to-gray-900 flex items-center justify-center text-white font-black shadow-md border-2 border-white">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="ml-3 hidden md:block text-left">
                            <p class="text-xs font-black text-gray-800 leading-tight uppercase tracking-tighter">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-black text-red-600 tracking-[0.2em] uppercase mt-0.5">System Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 relative custom-scrollbar">
                @if(session('success'))
                    <div class="mb-6 px-6 py-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm flex items-center animate__animated animate__fadeInRight">
                        <i class="fa-solid fa-circle-check text-xl mr-3 text-green-500"></i>
                        <span class="font-bold uppercase text-xs tracking-widest">{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>