@extends('frontend.layout')

@section('title', 'Drive Elite | Pakistan\'s Most Exclusive Luxury Car Rental')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>

<style>
    .hero-glow { filter: blur(120px); opacity: 0.4; }
    .glass-box { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); }
    .orange-text-shine { background: linear-gradient(90deg, #f97316, #fff, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: 200% auto; animation: shine 4s linear infinite; }
    @keyframes shine { to { background-position: 200% center; } }
    
    .luxury-marquee { background: #070b14; border-y: 1px solid rgba(255,255,255,0.03); overflow: hidden; padding: 30px 0; }
    .marquee-track { display: flex; gap: 80px; width: calc(200%); animation: scroll 40s linear infinite; }
    @keyframes scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

    .roadmap-line { position: absolute; top: 50px; left: 10%; right: 10%; height: 2px; background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.3), transparent); z-index: 0; }
    .color-scheme-dark { color-scheme: dark; }

    /* 🌟 ELITE INPUTS FOR SEARCH FORM 🌟 */
    .input-elite { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); color: white; transition: all 0.3s ease; }
    .input-elite:focus { border-color: #f97316; background: rgba(255, 255, 255, 0.1); }

    /* 🌟 PAGINATION STYLING 🌟 */
    .pagination-container nav div:first-child { display: none; } /* Hide mobile text */
    .pagination-container nav { display: flex; justify-content: center; gap: 10px; }
    .pagination-container span, .pagination-container a { 
        background: white; padding: 10px 20px; border-radius: 12px; font-weight: 800; font-family: 'Poppins'; font-size: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: all 0.3s ease;
    }
    .pagination-container .active span { background: #f97316 !important; color: white !important; }
    .pagination-container a:hover { background: #0b1120; color: white; }

    /* Custom sizing force for single line heading */
    .heading-single-line { font-size: clamp(3rem, 5vw, 6.5rem); }
</style>

<div class="relative w-full min-h-screen flex items-center justify-center overflow-hidden bg-[#0b1120]">
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline preload="auto" class="absolute inset-0 w-full h-full object-cover opacity-40 transform scale-105 pointer-events-none">
            <source src="{{ asset('videos/bm.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#0b1120]/30 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-l from-[#0b1120]/30 via-[#0b1120]/30 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0b1120] via-transparent to-transparent"></div>
    </div>

    <div class="absolute top-1/4 right-[-5%] w-[600px] h-[600px] bg-orange-600 hero-glow rounded-full animate-pulse"></div>

    <div class="relative z-10 w-full max-w-[90rem] mx-auto px-6 flex flex-col lg:flex-row-reverse items-center justify-between gap-10 py-24">
        
        <div class="w-full lg:w-[65%] text-left" data-aos="fade-left" data-aos-duration="1500">
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full glass-box mb-8 shadow-2xl">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
                </span>
                <span class="text-orange-100 text-[10px] font-black tracking-[0.4em] uppercase">Pakistan's Premier Rental Service</span>
            </div>
            
            <h1 class="heading-single-line font-poppins font-black text-white leading-tight mb-8 tracking-tighter italic uppercase whitespace-nowrap overflow-visible drop-shadow-lg">
                Beyond <span class="orange-text-shine">Driving</span>
            </h1>
            
            <p class="font-inter text-xl text-gray-200 mb-12 max-w-2xl leading-relaxed font-medium pr-4 drop-shadow-md">Experience the pinnacle of automotive luxury. Discover our exclusive collection and command the journey you deserve.</p>
        </div>

        <div class="w-full lg:w-[35%] max-w-md relative" data-aos="zoom-in-right">
            <div class="relative glass-box rounded-[3rem] p-10 shadow-[0_50px_100px_rgba(0,0,0,0.4)] bg-[#0b1120]/40 backdrop-blur-xl">
                <h3 class="font-poppins text-2xl font-black text-white italic uppercase mb-8">Reserve Ride</h3>
                
                <form action="{{ route('fleet') }}" method="GET" class="space-y-5">
                    
                    <div class="group relative">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Choose Brand</label>
                        <div class="relative">
                            <i class="fa-solid fa-tags absolute left-5 top-4 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                            <select name="search" class="input-elite w-full rounded-2xl py-3.5 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                                <option value="" class="bg-[#0b1120] text-gray-400">All Brands</option>
                                @php
                                    try {
                                        $brands = \App\Models\Car::select('brand')->distinct()->whereNotNull('brand')->pluck('brand');
                                    } catch(\Exception $e) {
                                        $brands = collect([]);
                                    }
                                @endphp
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}" class="bg-[#0b1120] text-white">{{ $brand }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-5 top-4 text-gray-500 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div class="group relative">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Pickup Territory</label>
                        <div class="relative">
                            <i class="fa-solid fa-location-dot absolute left-5 top-4 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                            <select name="location" class="input-elite w-full rounded-2xl py-3.5 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                                <option value="" class="bg-[#0b1120] text-gray-400">All Pakistan</option>
                                @php $cities = ['Islamabad', 'Lahore', 'Karachi', 'Faisalabad', 'Rawalpindi', 'Multan', 'Sargodha', 'Gujranwala', 'Bahawalpur', 'Hyderabad', 'Peshawar', 'Sialkot', 'Sukkur', 'Jhelum', 'Quetta']; @endphp
                                @foreach($cities as $city)
                                    <option value="{{ $city }}" class="bg-[#0b1120] text-white">{{ $city }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-5 top-4 text-gray-500 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <div class="group relative">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-2 ml-2">Vehicle Class</label>
                        <div class="relative">
                            <i class="fa-solid fa-car-side absolute left-5 top-4 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
                            <select name="category" class="input-elite w-full rounded-2xl py-3.5 pl-12 pr-4 outline-none font-inter text-sm font-semibold appearance-none cursor-pointer">
                                <option value="" class="bg-[#0b1120] text-gray-400">All Classes</option>
                                <option value="SUV" class="bg-[#0b1120] text-white">Luxury SUV</option>
                                <option value="Sedan" class="bg-[#0b1120] text-white">Executive Sedan</option>
                                <option value="Sports" class="bg-[#0b1120] text-white">Sports / Coupe</option>
                            </select>
                            <i class="fa-solid fa-chevron-down absolute right-5 top-4 text-gray-500 pointer-events-none text-xs"></i>
                        </div>
                    </div>

                    <button type="submit" class="group w-full bg-white text-[#0b1120] font-black py-5 rounded-2xl hover:bg-orange-500 hover:text-white transition-all shadow-xl uppercase text-xs tracking-[0.3em] italic overflow-hidden relative mt-2">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-magnifying-glass"></i> Initialize Search
                        </span>
                        <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="luxury-marquee">
    <div class="marquee-track">
        @foreach(['ROLLS ROYCE', 'LAMBORGHINI', 'MERCEDES BENZ', 'BMW M-SERIES', 'AUDI R8', 'PORSCHE', 'BENTLEY'] as $brand)
            <span class="text-5xl font-black text-white/5 uppercase italic tracking-tighter">{{ $brand }}</span>
            <div class="w-2 h-2 rounded-full bg-orange-500/10 self-center"></div>
        @endforeach
        @foreach(['ROLLS ROYCE', 'LAMBORGHINI', 'MERCEDES BENZ', 'BMW M-SERIES', 'AUDI R8', 'PORSCHE', 'BENTLEY'] as $brand)
            <span class="text-5xl font-black text-white/5 uppercase italic tracking-tighter">{{ $brand }}</span>
            <div class="w-2 h-2 rounded-full bg-orange-500/10 self-center"></div>
        @endforeach
    </div>
</div>

<section class="py-32 bg-[#0b1120] relative overflow-hidden border-b border-white/5">
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <h2 class="text-4xl md:text-6xl font-black text-white italic uppercase mb-32 tracking-tighter">The <span class="text-orange-500">VIP</span> Roadmap</h2>
        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-24">
            <div class="roadmap-line hidden md:block"></div>
            <div class="relative z-10 flex flex-col items-center group" data-aos="zoom-in">
                <div class="w-24 h-24 rounded-full glass-box flex items-center justify-center mb-10 group-hover:border-orange-500 transition-all shadow-2xl"><span class="text-4xl font-black text-white italic">01</span></div>
                <h3 class="text-2xl font-black text-white mb-4 uppercase italic">Choose Fleet</h3>
                <p class="text-gray-500 text-sm max-w-xs font-medium">Select your preferred machine from our curated showroom.</p>
            </div>
            <div class="relative z-10 flex flex-col items-center group" data-aos="zoom-in" data-aos-delay="200">
                <div class="w-24 h-24 rounded-full glass-box flex items-center justify-center mb-10 group-hover:border-orange-500 transition-all shadow-2xl"><span class="text-4xl font-black text-orange-500 italic">02</span></div>
                <h3 class="text-2xl font-black text-white mb-4 uppercase italic">Secure Booking</h3>
                <p class="text-gray-500 text-sm max-w-xs font-medium">Lock your dates with our encrypted payment escrow system.</p>
            </div>
            <div class="relative z-10 flex flex-col items-center group" data-aos="zoom-in" data-aos-delay="400">
                <div class="w-24 h-24 rounded-full glass-box flex items-center justify-center mb-10 group-hover:border-orange-500 transition-all shadow-2xl"><span class="text-4xl font-black text-white italic">03</span></div>
                <h3 class="text-2xl font-black text-white mb-4 uppercase italic">Elite Arrival</h3>
                <p class="text-gray-500 text-sm max-w-xs font-medium">The vehicle is delivered to your coordinates. Take control.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-32 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <h4 class="font-poppins text-5xl font-black text-[#0b1120] italic tracking-tighter uppercase">Featured <span class="text-orange-500">Showroom.</span></h4>
            <a href="{{ route('fleet') }}" class="bg-[#0b1120] text-white px-12 py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.4em] hover:bg-orange-500 transition-all shadow-xl">The Full Collection</a>
        </div>

        <div class="mb-12 relative w-full md:w-1/2">
            <i class="fa-solid fa-magnifying-glass absolute left-6 top-5 text-gray-400"></i>
            <input type="text" id="liveSearchInput" onkeyup="filterFeaturedCars()" placeholder="Search displayed cars (e.g. Audi, BMW)..." class="w-full bg-white border border-gray-200 text-gray-800 rounded-[2rem] py-4 pl-14 pr-6 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all shadow-sm font-medium">
        </div>

        <div id="featuredCarsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse($featured_cars as $car)
            <div class="car-item-card group bg-white rounded-[3.5rem] p-5 shadow-sm hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] transition-all" data-aos="fade-up" data-tilt data-tilt-max="4">
                <div class="relative h-80 overflow-hidden rounded-[3rem] bg-gray-100">
                    <img src="{{ asset('storage/' . $car->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                    
                    @if($car->is_available)
                        <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-xl px-4 py-2 rounded-xl shadow-xl font-black text-[#0b1120] text-[9px] uppercase flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Ready
                        </div>
                    @else
                        <div class="absolute top-6 left-6 bg-[#0b1120]/90 backdrop-blur-xl px-4 py-2 rounded-xl shadow-xl font-black text-white text-[9px] uppercase flex items-center gap-2 border border-red-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Reserved
                        </div>
                    @endif

                    <div class="absolute top-6 right-6 bg-white/95 backdrop-blur-xl px-6 py-3 rounded-2xl shadow-xl font-black text-[#0b1120]">PKR {{ number_format($car->daily_rent) }} <span class="text-[9px] text-orange-500">/ DAY</span></div>
                </div>
                <div class="p-8">
                    <p class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-3 italic">{{ $car->category->name ?? 'Luxury' }}</p>
                    
                    <h5 class="car-title text-3xl font-black text-[#0b1120] leading-tight mb-8 uppercase italic">{{ $car->brand }} <span class="text-gray-400">{{ $car->model_name }}</span></h5>
                    
                    <div class="grid grid-cols-3 gap-4 mb-10 text-center">
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors"><i class="fa-solid fa-chair text-gray-300 group-hover:text-orange-500 mb-2"></i><p class="text-[9px] font-black">{{ $car->seats }} SEATS</p></div>
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors"><i class="fa-solid fa-gear text-gray-300 group-hover:text-orange-500 mb-2"></i><p class="text-[9px] font-black uppercase">{{ substr($car->transmission,0,4) }}</p></div>
                        <div class="py-4 bg-gray-50 rounded-3xl group-hover:bg-orange-50 transition-colors"><i class="fa-solid fa-calendar text-gray-300 group-hover:text-orange-500 mb-2"></i><p class="text-[9px] font-black">{{ $car->year }}</p></div>
                    </div>
                    <a href="{{ route('car.show', $car->id) }}" class="flex items-center justify-center gap-4 w-full bg-[#0b1120] text-white py-6 rounded-2xl font-black text-xs uppercase tracking-[0.3em] group-hover:bg-orange-600 transition-all italic">Command Machine</a>
                </div>
            </div>
            @empty
                <div class="col-span-3 py-32 text-center glass-box rounded-[4rem] border-2 border-dashed border-gray-200"><h3 class="text-2xl font-black text-gray-300 uppercase italic">Showroom Preparing...</h3></div>
            @endforelse
        </div>

        <div class="mt-20 pagination-container">
            {{ $featured_cars->links() }}
        </div>
    </div>
</section>

<section class="py-24 bg-[#0b1120] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-[#070b14] rounded-[4rem] border border-white/5 overflow-hidden flex flex-col lg:flex-row items-center shadow-2xl relative" data-aos="fade-up">
            
            <div class="w-full lg:w-1/2 p-12 lg:p-20 relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-500/10 border border-orange-500/20 mb-8">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    <span class="text-orange-500 text-[10px] font-black tracking-[0.3em] uppercase">Uncompromised Luxury</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-white italic uppercase leading-tight mb-6">
                    Feel the <span class="text-orange-500">Adrenaline.</span>
                </h2>
                <p class="text-gray-400 font-light text-lg mb-10 leading-relaxed">
                    Aesthetics that command attention. Performance that defies logic. Step into a world where every detail is crafted for the elite. Your dream machine is waiting.
                </p>
                <a href="{{ route('fleet') }}" class="group inline-flex items-center gap-4 bg-orange-500 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.4em] hover:bg-white hover:text-[#0b1120] transition-all shadow-xl">
                    Explore Fleet <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>

            <div class="w-full lg:w-1/2 h-[400px] lg:h-[600px] relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1503376710356-70e69811cb62?q=80&w=1920&auto=format&fit=crop" 
                     class="absolute inset-0 w-full h-full object-cover object-center transform hover:scale-105 transition duration-1000" 
                     alt="Eye Catching Luxury Sports Car">
                <div class="absolute inset-0 bg-gradient-to-t lg:bg-gradient-to-l from-transparent via-[#070b14]/30 to-[#070b14]"></div>
            </div>
            
        </div>
    </div>
</section>

<section class="py-32 bg-[#0b1120] relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
            <div data-aos="fade-right">
                <h2 class="text-5xl font-black text-white italic uppercase tracking-tighter">Elite <span class="text-orange-500">Reflections.</span></h2>
                <p class="text-gray-400 mt-4 font-light">Authentic experiences shared by our distinguished clientele.</p>
            </div>
            @auth
                <button onclick="document.getElementById('reviewModal').classList.remove('hidden')" class="bg-white/5 border border-white/10 text-white px-10 py-4 rounded-full font-black uppercase text-[10px] tracking-widest hover:bg-orange-500 transition-all shadow-xl">Submit Your Reflection</button>
            @endauth
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @php $reviews = \App\Models\Review::with('user')->where('is_published', true)->latest()->get(); @endphp
            @forelse($reviews as $rev)
                <div class="glass-box p-12 rounded-[3.5rem] relative overflow-hidden group hover:border-orange-500/30 transition-all" data-aos="fade-up">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-500/5 rounded-full blur-3xl"></div>
                    <div class="flex gap-1 text-orange-500 mb-8">
                        @for($i=1; $i<=5; $i++)
                            <i class="fa-{{ $i <= $rev->rating ? 'solid' : 'regular' }} fa-star"></i>
                        @endfor
                    </div>
                    <p class="text-gray-300 font-medium italic mb-10 leading-relaxed text-lg">"{{ $rev->comment }}"</p>
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-orange-500/20 flex items-center justify-center text-orange-500 font-black text-xl uppercase">{{ substr($rev->user->name, 0, 1) }}</div>
                        <div>
                            <p class="text-white font-black italic uppercase tracking-widest text-sm">{{ $rev->user->name }}</p>
                            <p class="text-[9px] text-gray-500 font-bold uppercase tracking-[0.2em]">Verified Member</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20 text-gray-600 italic uppercase tracking-widest">Awaiting new reflections from the road...</div>
            @endforelse
        </div>
    </div>
</section>

<div id="reviewModal" class="fixed inset-0 z-[999] hidden bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-[#0b1120] border border-white/10 rounded-[3rem] p-12 max-w-lg w-full shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/10 rounded-full blur-3xl"></div>
        <h3 class="text-3xl font-black text-white italic mb-8 uppercase tracking-tighter">Submit Reflection</h3>
        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-8 relative z-10">
            @csrf
            <div>
                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block">Select Rating</label>
                <select name="rating" required class="w-full bg-white/5 border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-orange-500 cursor-pointer appearance-none">
                    <option value="5">5 Stars - Elite Experience</option>
                    <option value="4">4 Stars - Excellent Service</option>
                    <option value="3">3 Stars - Good Service</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block">Message Details</label>
                <textarea name="comment" required rows="4" class="w-full bg-white/5 border border-white/10 text-white rounded-[2rem] py-5 px-7 outline-none focus:border-orange-500 resize-none" placeholder="How was your Drive Elite journey?"></textarea>
            </div>
            <div class="flex gap-5">
                <button type="submit" class="flex-1 bg-orange-500 text-white font-black py-5 rounded-2xl uppercase italic tracking-widest shadow-2xl hover:scale-95 transition-transform">Post Reflection</button>
                <button type="button" onclick="document.getElementById('reviewModal').classList.add('hidden')" class="px-8 text-gray-500 font-bold uppercase text-[10px] tracking-widest">Cancel</button>
            </div>
        </form>
    </div>
</div>

<section id="contact" class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-[#0b1120] rounded-[4rem] p-12 md:p-24 relative overflow-hidden text-center shadow-2xl" data-aos="zoom-in">
            <div class="absolute top-0 left-0 w-full h-full opacity-5" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
            <h2 class="relative z-10 text-5xl md:text-7xl font-black text-white italic tracking-tighter uppercase mb-10">Still Thinking? <br><span class="text-orange-500">Just Connect.</span></h2>
            <p class="relative z-10 text-gray-400 text-lg mb-14 max-w-xl mx-auto font-light">Our elite concierge is online 24/7. One click away from your premium journey.</p>
            <a href="{{ $settings['whatsapp_link'] ?? '#' }}" class="relative z-10 bg-white text-[#0b1120] px-14 py-7 rounded-2xl font-black text-[10px] uppercase tracking-[0.4em] hover:bg-orange-500 hover:text-white transition-all shadow-2xl flex items-center gap-5 mx-auto w-fit italic"><i class="fa-brands fa-whatsapp text-2xl"></i> Secure WhatsApp Channel</a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true, mirror: false, offset: 50 });
        VanillaTilt.init(document.querySelectorAll("[data-tilt]"));
    });

    // 🚀 W3SCHOOLS REAL-TIME JAVASCRIPT SEARCH FUNCTION
    function filterFeaturedCars() {
        var input, filter, grid, cards, title, i, txtValue;
        input = document.getElementById("liveSearchInput");
        filter = input.value.toUpperCase();
        grid = document.getElementById("featuredCarsGrid");
        cards = grid.getElementsByClassName("car-item-card");

        for (i = 0; i < cards.length; i++) {
            title = cards[i].querySelector(".car-title");
            if (title) {
                txtValue = title.textContent || title.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    cards[i].style.display = ""; // Show the car
                } else {
                    cards[i].style.display = "none"; // Hide the car
                }
            }
        }
    }
</script>

@endsection