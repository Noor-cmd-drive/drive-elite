@extends('frontend.layout')

@section('title', 'Cars Collection - Drive Elite')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>

<style>
    .glass-box { background: rgba(11, 17, 32, 0.7); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.08); }
    .hero-glow { filter: blur(120px); opacity: 0.4; }
    .color-scheme-dark { color-scheme: dark; }
    .input-elite { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; }
    .input-elite:focus { border-color: #f97316; background: rgba(255, 255, 255, 0.1); }
</style>

<div class="relative w-full pt-40 pb-32 flex items-center justify-center overflow-hidden bg-[#0b1120]">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-30 transform scale-105"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#f8fafc] via-[#0b1120]/80 to-[#0b1120]"></div>
    </div>

    <div class="absolute top-10 right-[-10%] w-[500px] h-[500px] bg-orange-600 hero-glow rounded-full animate-pulse"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 text-center" data-aos="zoom-in" data-aos-duration="1200">
        <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full border border-orange-500/20 backdrop-blur-xl mb-6 shadow-2xl bg-white/5">
            <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></div>
            <span class="text-orange-100 text-[10px] font-black tracking-[0.4em] uppercase">All Luxury Cars</span>
        </div>
        <h1 class="font-poppins text-5xl md:text-7xl font-black text-white tracking-tighter mb-6 italic uppercase">
            Find Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Dream Car.</span>
        </h1>
        <p class="font-inter text-gray-400 text-lg max-w-2xl mx-auto font-light">
            Select your favorite vehicle from our premium collection and start your journey.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-20 mb-20" data-aos="fade-up" data-aos-delay="200">
    <div class="glass-box rounded-[2.5rem] shadow-[0_30px_60px_rgba(0,0,0,0.4)] p-8 md:p-10">
        <form action="{{ route('fleet') }}" method="GET" class="flex flex-col gap-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
                <div class="group">
                    <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-3 ml-2">Choose Brand</label>
                    <div class="relative">
                        <i class="fa-solid fa-tags absolute left-5 top-4.5 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                        <select name="search" class="input-elite w-full rounded-2xl py-4 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                            <option value="" class="bg-[#0b1120] text-gray-400">All Brands</option>
                            @php
                                try {
                                    $brands = \App\Models\Car::select('brand')->distinct()->whereNotNull('brand')->pluck('brand');
                                } catch(\Exception $e) {
                                    $brands = collect([]);
                                }
                            @endphp
                            @foreach($brands as $brand)
                                <option value="{{ $brand }}" class="bg-[#0b1120] text-white" {{ request('search') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-5 top-4.5 text-gray-500 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-3 ml-2">City / Location</label>
                    <div class="relative">
                        <i class="fa-solid fa-location-dot absolute left-5 top-4.5 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                        <select name="location" class="input-elite w-full rounded-2xl py-4 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                            <option value="" class="bg-[#0b1120] text-gray-400">All Pakistan</option>
                            @php $cities = ['Islamabad', 'Lahore', 'Karachi', 'Faisalabad', 'Rawalpindi', 'Multan', 'Sargodha', 'Gujranwala', 'Bahawalpur', 'Hyderabad', 'Peshawar', 'Sialkot', 'Sukkur', 'Jhelum', 'Quetta']; @endphp
                            @foreach($cities as $city)
                                <option value="{{ $city }}" class="bg-[#0b1120] text-white" {{ request('location') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-5 top-4.5 text-gray-500 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-3 ml-2">Car Type</label>
                    <div class="relative">
                        <i class="fa-solid fa-car-side absolute left-5 top-4.5 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                        <select name="category" class="input-elite w-full rounded-2xl py-4 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                            <option value="" class="bg-[#0b1120] text-gray-400">All Types</option>
                            <option value="SUV" class="bg-[#0b1120] text-white" {{ request('category') == 'SUV' ? 'selected' : '' }}>SUV / Jeep</option>
                            <option value="Sedan" class="bg-[#0b1120] text-white" {{ request('category') == 'Sedan' ? 'selected' : '' }}>Sedan / Family</option>
                            <option value="Sports" class="bg-[#0b1120] text-white" {{ request('category') == 'Sports' ? 'selected' : '' }}>Luxury / Sports</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-5 top-4.5 text-gray-500 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="h-full flex items-end">
                    <button type="submit" class="group w-full bg-white text-[#0b1120] hover:text-white font-poppins font-black text-xs uppercase tracking-widest py-4.5 rounded-2xl transition-all shadow-xl hover:shadow-orange-500/30 overflow-hidden relative italic h-[54px]">
                        <span class="relative z-10 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i> Search Now
                        </span>
                        <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500 z-0"></div>
                    </button>
                </div>
            </div>

            <!-- 🚀 ACCESSIBILITY: Wheelchair Filter Toggle -->
            <div class="pt-4 mt-2 border-t border-white/10 flex justify-end">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="wheelchair_accessible" value="1" class="sr-only peer" {{ request('wheelchair_accessible') ? 'checked' : '' }} onchange="this.form.submit()">
                    <div class="w-11 h-6 bg-gray-700/50 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-500/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-300 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-[10px] font-black text-gray-400 group-hover:text-gray-200 transition-colors uppercase tracking-widest flex items-center gap-2">
                        <i class="fa-solid fa-wheelchair text-blue-500 text-sm"></i> Wheelchair Accessible Only
                    </span>
                </label>
            </div>

        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
    
    @if(request()->anyFilled(['location', 'search', 'category', 'wheelchair_accessible']))
        <div class="mb-12 pb-6 border-b border-gray-200 flex justify-between items-center" data-aos="fade-in">
            <p class="font-poppins font-black text-gray-800 italic uppercase tracking-widest text-sm">
                Showing Results for: <span class="text-orange-500">Applied Filters</span>
            </p>
            <a href="{{ route('fleet') }}" class="text-[10px] font-black text-red-500 hover:text-white hover:bg-red-500 transition-all uppercase tracking-widest flex items-center gap-2 px-4 py-2 rounded-full border border-red-200">
                <i class="fa-solid fa-xmark"></i> Clear All
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        
        @forelse($cars as $idx => $car)
            <div class="group bg-white rounded-[3.5rem] p-5 shadow-sm hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] transition-all duration-700 flex flex-col" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}" data-tilt data-tilt-max="4">
                
                <div class="relative h-72 bg-gray-100 overflow-hidden rounded-[3rem] flex items-center justify-center">
                    <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://images.unsplash.com/photo-1503376712344-652d0f4ca4f5?q=80&w=800&auto=format&fit=crop' }}" 
                         onerror="this.src='https://images.unsplash.com/photo-1550355291-bbee04a92027?q=80&w=800&auto=format&fit=crop'" 
                         alt="{{ $car->brand }} {{ $car->model_name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    
                    @if($car->is_available)
                        <div class="absolute top-5 left-5 bg-white/95 backdrop-blur-md text-[#0b1120] text-[9px] font-black uppercase tracking-widest px-4 py-2 rounded-2xl shadow-xl flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Available
                        </div>
                    @else
                        <div class="absolute top-5 left-5 bg-[#0b1120]/95 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-widest px-4 py-2 rounded-2xl shadow-xl flex items-center gap-2 border border-red-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Booked
                        </div>
                    @endif

                    <div class="absolute top-5 right-5 bg-white/95 backdrop-blur-xl px-5 py-2.5 rounded-2xl shadow-2xl font-black text-[#0b1120]">
                        PKR {{ number_format($car->daily_rent ?? 25000) }} <span class="text-[9px] text-orange-500 uppercase">/ DAY</span>
                    </div>

                    <!-- 🚀 ACCESSIBILITY: Wheelchair Badge on Car Image -->
                    @if($car->is_wheelchair_accessible)
                        <div class="absolute bottom-5 left-5 bg-blue-600/95 backdrop-blur-md text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-2xl shadow-xl flex items-center gap-2 border border-blue-400/30" title="Wheelchair Accessible Vehicle">
                            <i class="fa-solid fa-wheelchair text-sm"></i> Accessible
                        </div>
                    @endif
                </div>

                <div class="p-8 flex-grow flex flex-col">
                    <div class="mb-6">
                        <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-2 italic">{{ $car->category->name ?? 'Premium' }}</p>
                        <h3 class="font-poppins text-3xl font-black text-[#0b1120] leading-tight uppercase italic">
                            {{ $car->brand ?? 'Luxury' }} <br> <span class="text-gray-400 group-hover:text-[#0b1120] transition-colors">{{ $car->model_name ?? 'Vehicle' }}</span>
                        </h3>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-10 text-center">
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors">
                            <i class="fa-solid fa-users text-gray-300 group-hover:text-orange-500 mb-2"></i>
                            <p class="text-[9px] font-black text-[#0b1120] tracking-widest">{{ $car->seats ?? '4' }} SEATS</p>
                        </div>
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors">
                            <i class="fa-solid fa-gears text-gray-300 group-hover:text-orange-500 mb-2"></i>
                            <p class="text-[9px] font-black text-[#0b1120] uppercase tracking-widest">{{ substr($car->transmission ?? 'Auto', 0, 4) }}</p>
                        </div>
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors">
                            <i class="fa-solid fa-calendar text-gray-300 group-hover:text-orange-500 mb-2"></i>
                            <p class="text-[9px] font-black text-[#0b1120] tracking-widest">{{ $car->year ?? '2024' }}</p>
                        </div>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('car.show', $car->id) }}" class="flex items-center justify-center gap-4 w-full bg-[#0b1120] text-white py-6 rounded-2xl font-black text-xs uppercase tracking-widest group-hover:bg-orange-600 transition-all duration-500 italic shadow-xl">
                            View Details <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-32 bg-white rounded-[4rem] border border-gray-100 shadow-sm" data-aos="fade-in">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-gray-100">
                    <i class="fa-solid fa-magnifying-glass text-3xl text-gray-300"></i>
                </div>
                <h3 class="font-poppins text-3xl font-black text-[#0b1120] mb-4 italic uppercase">No Cars Found</h3>
                <p class="text-gray-500 mb-8 font-medium">We could not find any car matching your search.</p>
                <a href="{{ route('fleet') }}" class="bg-[#0b1120] text-white px-10 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-orange-500 transition-all shadow-xl italic">
                    Clear Filters
                </a>
            </div>
        @endforelse

    </div>

    @if(isset($cars) && method_exists($cars, 'hasPages') && $cars->hasPages())
        <div class="mt-20 flex justify-center" data-aos="fade-up">
            <div class="bg-white px-8 py-4 rounded-3xl shadow-sm border border-gray-100">
                {{ $cars->appends(request()->query())->links() }}
            </div>
        </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true, mirror: false, offset: 50 });
        VanillaTilt.init(document.querySelectorAll("[data-tilt]"));
    });
</script>

@endsection