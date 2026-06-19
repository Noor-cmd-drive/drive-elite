@extends('frontend.layout')

@section('title', $car->brand . ' ' . $car->model_name . ' - Drive Elite')

@section('content')
<div class="relative w-full pt-32 pb-16 bg-[#0b1120] border-b-4 border-orange-500 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0b1120] via-[#0b1120]/90 to-[#0b1120]/60"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-500/10 rounded-full blur-[100px]"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm text-gray-400 font-inter mb-6">
            <a href="{{ route('home') }}" class="hover:text-orange-500 transition-colors uppercase tracking-widest font-bold text-[10px]">Home</a>
            <i class="fa-solid fa-chevron-right text-[8px] text-orange-500/50"></i>
            <a href="{{ route('fleet') }}" class="hover:text-orange-500 transition-colors uppercase tracking-widest font-bold text-[10px]">Fleet</a>
            <i class="fa-solid fa-chevron-right text-[8px] text-orange-500/50"></i>
            <span class="text-white font-bold uppercase tracking-widest text-[10px]">{{ $car->brand }} {{ $car->model_name }}</span>
        </div>
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <span class="bg-orange-500/10 text-orange-500 border border-orange-500/20 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] inline-block">Premium Selection</span>
                    
                    @if($car->is_available)
                        <span class="bg-green-500/10 text-green-500 border border-green-500/20 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] inline-flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Available
                        </span>
                    @else
                        <span class="bg-red-500/10 text-red-500 border border-red-500/20 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] inline-flex items-center gap-2 shadow-[0_0_15px_rgba(239,68,68,0.2)]">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Reserved
                        </span>
                    @endif
                </div>

                <h1 class="font-poppins text-4xl md:text-6xl font-black text-white tracking-tighter leading-none">
                    {{ $car->brand }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">{{ $car->model_name }}</span>
                </h1>
            </div>
            <div class="flex items-center gap-4 bg-white/5 border border-white/10 p-4 rounded-2xl backdrop-blur-sm">
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Daily Rate</p>
                    <p class="text-2xl font-black text-white">Rs. {{ number_format($car->daily_rent) }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center text-white text-xl shadow-[0_0_20px_rgba(249,115,22,0.4)]">
                    <i class="fa-solid fa-bolt"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex flex-col lg:flex-row gap-12">
        
        <div class="w-full lg:w-2/3">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl shadow-gray-200/50 border border-gray-100 mb-12 relative overflow-hidden flex justify-center items-center h-[450px] group">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-orange-500/5 rounded-full blur-[120px] z-0 group-hover:bg-orange-500/10 transition-colors"></div>
                
                <img src="{{ $car->image ? asset('storage/' . $car->image) : asset('frontend/images/default-car.png') }}" 
                     alt="{{ $car->brand }} {{ $car->model_name }}" 
                     class="relative z-10 w-full max-h-full object-contain drop-shadow-[0_30px_50px_rgba(0,0,0,0.15)] group-hover:scale-105 transition-transform duration-700">
                
                <div class="absolute bottom-8 left-8 z-20 bg-[#0b1120] text-white text-[10px] font-black uppercase tracking-[0.2em] px-6 py-3 rounded-xl shadow-2xl border border-white/10">
                    {{ $car->category->name ?? 'Elite Class' }}
                </div>
            </div>

            <h3 class="font-poppins text-2xl font-black text-[#0b1120] mb-8 tracking-tight flex items-center gap-3">
                <span class="w-8 h-1 bg-orange-500 rounded-full"></span> Technical Specifications
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-[2rem] p-6 flex flex-col items-center justify-center text-center border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4 text-xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="text-[10px] text-gray-400 font-black mb-1 tracking-widest uppercase">Capacity</span>
                    <span class="font-inter font-bold text-[#0b1120]">{{ $car->seats ?? '4' }} Adults</span>
                </div>
                <div class="bg-white rounded-[2rem] p-6 flex flex-col items-center justify-center text-center border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4 text-xl">
                        <i class="fa-solid fa-gears"></i>
                    </div>
                    <span class="text-[10px] text-gray-400 font-black mb-1 tracking-widest uppercase">Transmission</span>
                    <span class="font-inter font-bold text-[#0b1120]">{{ $car->transmission ?? 'Auto' }}</span>
                </div>
                
                <div class="bg-white rounded-[2rem] p-6 flex flex-col items-center justify-center text-center border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4 text-xl">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                    <span class="text-[10px] text-gray-400 font-black mb-1 tracking-widest uppercase">Fuel Type</span>
                    <span class="font-inter font-bold text-[#0b1120]">{{ $car->fuel_type ?? 'Petrol' }}</span>
                </div>

                <div class="bg-white rounded-[2rem] p-6 flex flex-col items-center justify-center text-center border border-gray-100 shadow-sm hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4 text-xl">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <span class="text-[10px] text-gray-400 font-black mb-1 tracking-widest uppercase">Year</span>
                    <span class="font-inter font-bold text-[#0b1120]">{{ $car->year ?? '2024' }}</span>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h3 class="font-poppins text-2xl font-black text-[#0b1120] mb-6 tracking-tight">Luxury Overview</h3>
                <p class="font-inter text-gray-500 leading-[1.8] text-lg">
                    {{ $car->description ?? "Experience the pinnacle of automotive engineering with the " . $car->brand . " " . $car->model_name . ". This vehicle is meticulously maintained to provide an unmatched luxury experience." }}
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/3">
            <div class="bg-[#0b1120] rounded-[2.5rem] p-10 shadow-[0_30px_60px_rgba(0,0,0,0.3)] sticky top-32 border border-white/10 overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl group-hover:bg-orange-500/20 transition-all"></div>
                
                <h3 class="font-poppins text-3xl font-black text-white mb-8 tracking-tight">Secure <br><span class="text-orange-500 uppercase">Reservation</span></h3>

                <form action="{{ route('checkout.index') }}" method="POST" class="space-y-6" id="booking_form">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                    <input type="hidden" name="total_days" id="input_total_days">
                    <input type="hidden" name="total_price" id="input_total_price">

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] ml-2">Pickup Date & Time</label>
                        <div class="relative">
                            <i class="fa-regular fa-calendar-check absolute left-5 top-4 text-gray-500"></i>
                            <input type="datetime-local" id="start_date" name="start_date" required 
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-2xl py-4 pl-12 pr-4 focus:border-orange-500 outline-none transition-all font-inter text-sm color-scheme-dark">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-orange-400 uppercase tracking-[0.2em] ml-2">Return Date & Time</label>
                        <div class="relative">
                            <i class="fa-regular fa-calendar-xmark absolute left-5 top-4 text-gray-500"></i>
                            <input type="datetime-local" id="end_date" name="end_date" required 
                                   class="w-full bg-white/5 border border-white/10 text-white rounded-2xl py-4 pl-12 pr-4 focus:border-orange-500 outline-none transition-all font-inter text-sm color-scheme-dark">
                        </div>
                    </div>

                    <div id="summary_box" class="hidden bg-white/5 border border-dashed border-orange-500/30 rounded-2xl p-6 space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-inter">Duration:</span>
                            <span class="text-white font-black" id="display_days">0 Days</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-white/5">
                            <span class="text-gray-400 font-inter">Total Payable:</span>
                            <div class="text-right">
                                <p class="text-orange-500 font-black text-2xl">Rs. <span id="display_total">0</span></p>
                                <p class="text-[9px] text-gray-500 uppercase tracking-widest">Inclusive of taxes</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        @if(!$car->is_available)
                            <button type="button" disabled class="w-full bg-gray-800/50 border border-gray-700 text-gray-400 cursor-not-allowed font-poppins font-black text-xs uppercase tracking-[0.2em] py-5 rounded-2xl shadow-none flex justify-center items-center gap-3">
                                <i class="fa-solid fa-lock"></i> Currently Reserved
                            </button>
                        @else
                            @auth
                                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-black text-sm uppercase tracking-[0.2em] py-5 rounded-2xl shadow-2xl hover:shadow-orange-500/40 hover:-translate-y-1 transition-all flex justify-center items-center gap-3">
                                    Proceed to Payment <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="w-full bg-white text-[#0b1120] font-poppins font-black text-sm uppercase tracking-[0.2em] py-5 rounded-2xl shadow-xl hover:bg-gray-100 transition-all flex justify-center items-center gap-3 text-center block">
                                    Login to Reserve <i class="fa-solid fa-lock"></i>
                                </a>
                            @endauth
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');
        const summaryBox = document.getElementById('summary_box');
        const dailyRate = {{ $car->daily_rent ?? 25000 }};

        function calculate() {
            if (startInput.value && endInput.value) {
                const start = new Date(startInput.value);
                const end = new Date(endInput.value);

                if (end > start) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.max(1, Math.ceil(diffTime / (1000 * 60 * 60 * 24)));
                    const totalBill = diffDays * dailyRate;

                    document.getElementById('display_days').innerText = diffDays + (diffDays > 1 ? " Days" : " Day");
                    document.getElementById('display_total').innerText = totalBill.toLocaleString();
                    
                    document.getElementById('input_total_days').value = diffDays;
                    document.getElementById('input_total_price').value = totalBill;

                    summaryBox.classList.remove('hidden');
                    summaryBox.classList.add('animate-in', 'fade-in', 'slide-in-from-top-4', 'duration-500');
                } else {
                    summaryBox.classList.add('hidden');
                }
            }
        }

        startInput.addEventListener('change', calculate);
        endInput.addEventListener('change', calculate);
    });
</script>
@endsection