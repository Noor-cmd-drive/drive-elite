@extends('frontend.layout')

@section('title', 'Executive Terminal - Drive Elite')

@section('content')

<div class="relative min-h-screen pt-32 pb-20 overflow-hidden" 
     style="background: linear-gradient(rgba(11, 17, 32, 0.7), rgba(11, 17, 32, 0.8)), 
            url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=2000&auto=format&fit=crop'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;">
    
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/20 rounded-full blur-[120px] -mr-48 -mt-48 animate-pulse"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/20 rounded-full blur-[100px] -ml-40 -mb-40"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative mb-12">
            <div class="bg-white/80 backdrop-blur-3xl rounded-[3.5rem] p-8 md:p-12 border border-white/20 shadow-[0_30px_100px_-20px_rgba(0,0,0,0.3)] flex flex-col md:flex-row items-center justify-between gap-8">
                
                <div class="flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                    <div class="relative group">
                        <div class="absolute -inset-2 bg-gradient-to-r from-orange-500 to-blue-600 rounded-[2.5rem] blur-xl opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                        <div class="relative w-28 h-28 rounded-3xl bg-[#0b1120] flex items-center justify-center shadow-2xl rotate-3 transition-transform duration-500 hover:rotate-0">
                            <span class="font-poppins text-5xl font-black text-orange-500">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <div class="inline-flex items-center gap-2 bg-[#0b1120] px-5 py-2 rounded-full mb-4 shadow-xl shadow-blue-900/20">
                            <span class="text-white font-black tracking-widest text-[10px] uppercase italic">Executive Terminal Verified</span>
                        </div>
                        <h1 class="font-poppins text-5xl md:text-6xl font-black text-[#0b1120] tracking-tighter">
                            Hey, <span class="text-orange-600">{{ Auth::user()->name }}</span>
                        </h1>
                        <p class="font-inter text-gray-700 text-sm font-medium mt-2">Manage your premium reservations and fleet status in real-time.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    
                    <a href="{{ route('fleet') }}" class="group w-full sm:w-auto text-center bg-[#0b1120] text-white px-8 py-4 rounded-2xl font-poppins font-black text-[11px] uppercase tracking-[0.2em] transition-all shadow-2xl hover:bg-orange-600 hover:-translate-y-1">
                        Explore Fleet <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="group w-full sm:w-auto text-center bg-white/80 text-[#0b1120] border-2 border-[#0b1120]/10 px-8 py-4 rounded-2xl font-poppins font-black text-[11px] uppercase tracking-[0.2em] transition-all shadow-lg hover:bg-[#0b1120] hover:border-[#0b1120] hover:text-white hover:-translate-y-1">
                        Profile <i class="fa-solid fa-user-gear ml-2 group-hover:rotate-90 transition-transform duration-500"></i>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto m-0">
                        @csrf
                        <button type="submit" class="group w-full sm:w-auto text-center bg-white/60 text-[#0b1120] border-2 border-[#0b1120]/10 px-8 py-4 rounded-2xl font-poppins font-black text-[11px] uppercase tracking-[0.2em] transition-all hover:bg-red-50 hover:border-red-500 hover:text-red-600 hover:-translate-y-1">
                            Logout <i class="fa-solid fa-power-off ml-2 group-hover:scale-110 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @php
                $userBookings = Auth::user()->bookings;
                $statsConfig = [
                    ['title' => 'Active Rides', 'count' => $userBookings->where('status', 'Approved')->count(), 'icon' => 'fa-car-side', 'color' => 'text-blue-600', 'bg' => 'bg-blue-500/10'],
                    ['title' => 'Pending Review', 'count' => $userBookings->where('status', 'Pending')->count(), 'icon' => 'fa-hourglass-half', 'color' => 'text-orange-600', 'bg' => 'bg-orange-500/10'],
                    ['title' => 'Total Journeys', 'count' => $userBookings->where('status', 'Completed')->count(), 'icon' => 'fa-flag-checkered', 'color' => 'text-emerald-600', 'bg' => 'bg-emerald-500/10']
                ];
            @endphp

            @foreach($statsConfig as $stat)
            <div class="bg-white/90 backdrop-blur-2xl rounded-[3rem] p-10 border border-white/20 shadow-[0_20px_50px_rgba(0,0,0,0.2)] hover:shadow-2xl transition-all duration-500 group">
                <div class="flex items-center justify-between">
                    <div class="w-20 h-20 rounded-3xl {{ $stat['bg'] }} {{ $stat['color'] }} flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform duration-500">
                        <i class="fa-solid {{ $stat['icon'] }}"></i>
                    </div>
                    <div class="text-right">
                        <h4 class="text-6xl font-black text-[#0b1120] tracking-tighter">{{ $stat['count'] }}</h4>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-[10px] mt-2">{{ $stat['title'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white/80 backdrop-blur-3xl rounded-[4rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.3)] border border-white/20 overflow-hidden">
            <div class="px-12 py-10 border-b border-gray-200/50 flex justify-between items-center bg-gray-50/50">
                <div>
                    <h2 class="font-poppins text-3xl font-black text-[#0b1120]">Recent Activity</h2>
                    <p class="text-orange-600 text-[10px] font-black uppercase tracking-[0.3em] mt-1 italic">Journey & Status Logs</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-white shadow-inner flex items-center justify-center text-[#0b1120] border border-gray-200">
                    <i class="fa-solid fa-fingerprint text-xl"></i>
                </div>
            </div>

            <div class="p-6 md:p-12">
                @if($userBookings->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-6">
                            <thead>
                                <tr class="text-gray-500 text-[11px] font-black uppercase tracking-widest px-10">
                                    <th class="px-10 pb-2">Vehicle</th>
                                    <th class="px-10 pb-2">Period</th>
                                    <th class="px-10 pb-2">Investment</th>
                                    <th class="px-10 pb-2 text-right">Status & Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userBookings->sortByDesc('created_at') as $booking)
                                <tr class="group hover:bg-white/90 transition-all duration-300 shadow-sm hover:shadow-md">
                                    <td class="py-8 px-10 bg-white/90 rounded-l-[2.5rem] border-y border-l border-gray-100">
                                        <div class="flex items-center gap-6">
                                            <div class="w-24 h-16 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 p-2 flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-500">
                                                <img src="{{ $booking->car->image ? asset('storage/'.$booking->car->image) : 'https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=200' }}" class="max-h-full object-contain">
                                            </div>
                                            <div>
                                                <p class="font-black text-[#0b1120] text-xl tracking-tight">{{ $booking->car->brand }}</p>
                                                <p class="text-[11px] font-bold text-orange-600 uppercase tracking-widest">{{ $booking->car->model_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-8 px-10 bg-white/90 border-y border-gray-100">
                                        <p class="text-base font-bold text-[#1e293b]">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}
                                        </p>
                                        <p class="text-[11px] text-gray-400 font-bold uppercase mt-1 tracking-tighter">{{ $booking->total_days }} Days Executive Plan</p>
                                    </td>
                                    <td class="py-8 px-10 bg-white/90 border-y border-gray-100">
                                        <p class="text-2xl font-black text-[#0b1120] tracking-tighter">Rs. {{ number_format($booking->total_price) }}</p>
                                        <span class="text-[10px] text-gray-400 font-black uppercase">Reserved Investment</span>
                                    </td>
                                    <td class="py-8 px-10 bg-white/90 rounded-r-[2.5rem] border-y border-r border-gray-100 text-right">
                                        <div class="flex flex-col items-end gap-3">
                                            @php
                                                $statusColors = [
                                                    'Pending' => 'bg-orange-500 text-white shadow-orange-500/30',
                                                    'Approved' => 'bg-blue-600 text-white shadow-blue-600/20',
                                                    'Completed' => 'bg-emerald-600 text-white shadow-emerald-600/30',
                                                    'Cancelled' => 'bg-gray-200 text-gray-600'
                                                ];
                                                $color = $statusColors[$booking->status] ?? 'bg-gray-200 text-gray-600';
                                            @endphp
                                            <span class="inline-flex px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg {{ $color }}">
                                                {{ $booking->status }}
                                            </span>

                                            @if($booking->status == 'Approved' || $booking->status == 'Completed')
                                                <a href="{{ route('user.invoice', $booking->id) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-black text-[10px] uppercase tracking-widest transition-colors">
                                                    <i class="fa-solid fa-file-invoice"></i> Download Receipt
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-32 text-center">
                        <i class="fa-solid fa-car-tunnel text-6xl text-gray-300 mb-8"></i>
                        <h3 class="font-poppins text-4xl font-black text-[#0b1120] mb-4">No Active Reservations</h3>
                        <p class="text-gray-500 max-w-sm mx-auto font-medium mb-12 leading-relaxed">Your executive terminal is currently empty. Explore our fleet to begin your luxury journey.</p>
                        <a href="{{ route('fleet') }}" class="bg-[#0b1120] text-white px-16 py-6 rounded-[2.5rem] font-black text-xs uppercase tracking-[0.2em] shadow-2xl hover:bg-orange-600 transition-all">Explore Showroom</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Executive Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #0b1120; }
    ::-webkit-scrollbar-thumb { background: #ea580c; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #f97316; }
</style>
@endsection