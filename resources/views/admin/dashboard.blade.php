@extends('admin.layout')

@section('header_title', 'Command Center | Overview')

@section('content')
    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 rounded-3xl shadow-2xl p-10 mb-10 text-white relative overflow-hidden border border-gray-700">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-red-600 opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-48 h-48 bg-white opacity-5 rounded-full blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-black mb-3 tracking-tight">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-400 text-lg font-medium max-w-xl">DriveElite is performing well. You have <span class="text-red-500 font-bold">{{ $pending_bookings }} pending</span> reservations that need your attention.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('bookings.index') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-lg shadow-red-600/20 text-sm">Review Bookings</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-500 group">
            <div class="flex items-center justify-between mb-4">
                <div class="h-14 w-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-500 group-hover:text-white transition duration-500 shadow-inner">
                    <i class="fa-solid fa-sack-dollar text-2xl"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-green-500 bg-green-50 px-2 py-1 rounded-md">Real-time</span>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Revenue</p>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">Rs. {{ number_format($total_revenue) }}</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-500 group">
            <div class="flex items-center justify-between mb-4">
                <div class="h-14 w-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition duration-500 shadow-inner">
                    <i class="fa-solid fa-car-rear text-2xl"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-blue-500 bg-blue-50 px-2 py-1 rounded-md">Live Fleet</span>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Vehicles</p>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $total_cars }} Units</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-500 group">
            <div class="flex items-center justify-between mb-4">
                <div class="h-14 w-14 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-500 group-hover:text-white transition duration-500 shadow-inner">
                    <i class="fa-solid fa-calendar-check text-2xl"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-purple-500 bg-purple-50 px-2 py-1 rounded-md">Active</span>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Bookings</p>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $total_bookings }} Orders</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition duration-500 group">
            <div class="flex items-center justify-between mb-4">
                <div class="h-14 w-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-500 group-hover:text-white transition duration-500 shadow-inner">
                    <i class="fa-solid fa-bell-concierge text-2xl"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-red-500 bg-red-50 px-2 py-1 rounded-md animate-pulse">Action Required</span>
            </div>
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Pending Requests</p>
                <p class="text-3xl font-black text-gray-900 tracking-tighter">{{ $pending_bookings }} Items</p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-gray-900 rounded-3xl p-8 text-white shadow-xl flex items-center justify-between group overflow-hidden relative">
            <div class="relative z-10">
                <h4 class="text-xl font-bold mb-2">Fleet Management</h4>
                <p class="text-gray-400 text-sm mb-6">Add new high-end vehicles to your collection.</p>
                <a href="{{ route('cars.create') }}" class="inline-flex items-center text-sm font-bold bg-white text-gray-900 px-6 py-3 rounded-xl hover:bg-red-500 hover:text-white transition duration-300">
                    Add New Car <i class="fa-solid fa-plus ml-2"></i>
                </a>
            </div>
            <i class="fa-solid fa-car text-9xl text-white/5 absolute -right-4 -bottom-4 rotate-12 group-hover:rotate-0 transition duration-500"></i>
        </div>

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex items-center justify-between group overflow-hidden relative">
            <div class="relative z-10">
                <h4 class="text-xl font-bold mb-2 text-gray-900">System Logs</h4>
                <p class="text-gray-500 text-sm mb-6">Review system performance and user activities.</p>
                <a href="#" class="inline-flex items-center text-sm font-bold bg-gray-100 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-200 transition duration-300">
                    View Logs <i class="fa-solid fa-arrow-right-long ml-2"></i>
                </a>
            </div>
            <i class="fa-solid fa-chart-line text-9xl text-gray-50 absolute -right-4 -bottom-4 group-hover:scale-110 transition duration-500"></i>
        </div>
    </div>
@endsection