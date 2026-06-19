<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? 'DriveElite' }} | Premium Car Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav { background: rgba(9, 9, 11, 0.8); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); }
        .clip-path-slant { clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%); }
    </style>
</head>
<body class="bg-zinc-50 text-zinc-900 antialiased selection:bg-red-600 selection:text-white">

    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-white/10 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-24 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter text-white uppercase flex items-center gap-2 group">
                <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center shadow-lg shadow-red-600/30 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-car-side text-white text-lg"></i>
                </div>
                <span>Drive<span class="text-red-600">Elite</span></span>
            </a>
            
            <div class="hidden md:flex items-center gap-10 font-bold text-xs uppercase tracking-[0.15em] text-zinc-300">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors relative group">
                    Home
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('fleet') }}" class="hover:text-white transition-colors relative group">
                    Our Fleet
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
                </a>
                <a href="#contact" class="hover:text-white transition-colors relative group">
                    Contact Us
                    <span class="absolute -bottom-2 left-0 w-0 h-0.5 bg-red-600 transition-all group-hover:w-full"></span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                <a href="https://wa.me/{{ str_replace(['+', ' '], '', $settings['whatsapp'] ?? '') }}" class="hidden lg:flex w-10 h-10 rounded-full bg-white/5 border border-white/10 items-center justify-center text-zinc-300 hover:bg-green-500 hover:text-white hover:border-green-500 transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
                <a href="{{ route('login') }}" class="bg-white text-zinc-950 px-8 py-3.5 rounded-full font-black text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.1)] hover:shadow-[0_0_30px_rgba(220,38,38,0.4)] transform hover:-translate-y-0.5">
                    Client Portal
                </a>
            </div>
        </div>
    </nav>

    <section class="relative pt-48 pb-32 px-6 bg-zinc-950 text-white overflow-hidden clip-path-slant">
        <div class="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-red-600/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-zinc-800/50 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
            <div class="pt-10">
                <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 px-4 py-2 rounded-full mb-8 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-300">The Ultimate Fleet is Ready</span>
                </div>
                
                <h2 class="text-7xl lg:text-[6.5rem] font-black tracking-tighter leading-[0.9] mb-8">
                    Command <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-800">The Road.</span>
                </h2>
                
                <p class="text-zinc-400 text-lg font-normal mb-12 max-w-lg leading-relaxed">
                    Elevate your journey with {{ $settings['site_name'] ?? 'DriveElite' }}. We offer an exclusive collection of high-performance and luxury vehicles for those who refuse to compromise.
                </p>
                
                <div class="flex flex-wrap gap-5">
                    <a href="{{ route('fleet') }}" class="group relative px-8 py-5 bg-red-600 text-white rounded-full font-black text-xs uppercase tracking-[0.2em] overflow-hidden shadow-[0_0_40px_rgba(220,38,38,0.4)] hover:shadow-[0_0_60px_rgba(220,38,38,0.6)] transition-all duration-300 transform hover:-translate-y-1">
                        <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                        Reserve a Vehicle
                    </a>
                </div>
                
                <div class="grid grid-cols-3 gap-8 mt-20 pt-10 border-t border-white/10">
                    <div>
                        <p class="text-3xl font-black text-white">50+</p>
                        <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mt-1">Luxury Cars</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-white">24/7</p>
                        <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mt-1">VIP Support</p>
                    </div>
                    <div>
                        <p class="text-3xl font-black text-white">100%</p>
                        <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest mt-1">Insured</p>
                    </div>
                </div>
            </div>
            
            <div class="relative hidden lg:block">
                <img src="https://purepng.com/public/uploads/large/purepng.com-mercedes-benz-carmercedes-benzmercedesbenzmercedes-cars-1701527506240d0rbe.png" alt="Luxury Vehicle" class="relative z-10 w-[120%] max-w-none -ml-10 drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] hover:scale-105 transition-transform duration-1000 ease-out">
            </div>
        </div>
    </section>

    <section id="fleet" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-[2px] w-10 bg-red-600"></div>
                        <span class="text-xs font-black text-red-600 uppercase tracking-[0.2em]">Our Collection</span>
                    </div>
                    <h4 class="text-5xl font-black tracking-tighter text-zinc-950">The Featured <br>Fleet</h4>
                </div>
                <a href="{{ route('fleet') }}" class="group flex items-center gap-3 text-xs font-black uppercase tracking-widest text-zinc-950 hover:text-red-600 transition-colors">
                    Explore Showroom 
                    <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center group-hover:bg-red-50 transition-colors">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featured_cars ?? [] as $car)
                <div class="group bg-white rounded-[2rem] p-3 border border-zinc-200/60 shadow-lg hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] hover:border-red-200 transition-all duration-500 transform hover:-translate-y-2">
                    <div class="relative h-72 overflow-hidden rounded-[1.5rem] bg-zinc-100">
                        <img src="{{ asset('storage/' . $car->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 ease-in-out" alt="{{ $car->brand }}">
                        
                        <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-md px-5 py-3 rounded-2xl shadow-xl border border-white">
                            <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest leading-none mb-1">Daily Rate</p>
                            <p class="text-lg font-black text-zinc-950 leading-none">Rs. {{ number_format($car->daily_rent) }}</p>
                        </div>
                        
                        <div class="absolute top-4 right-4 bg-zinc-950/90 backdrop-blur-md px-4 py-2 rounded-full">
                            <p class="text-[10px] font-black text-white uppercase tracking-widest">{{ $car->category->name }}</p>
                        </div>
                    </div>
                    
                    <div class="p-6 pb-4">
                        <div class="mb-6">
                            <h5 class="text-2xl font-black text-zinc-950 tracking-tight">{{ $car->brand }} {{ $car->model_name }}</h5>
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="inline-flex items-center gap-2 px-3 py-2 bg-zinc-50 border border-zinc-100 rounded-lg text-[11px] font-bold text-zinc-600 uppercase tracking-widest">
                                <i class="fa-solid fa-chair text-zinc-400"></i> {{ $car->seats }} Seats
                            </span>
                            <span class="inline-flex items-center gap-2 px-3 py-2 bg-zinc-50 border border-zinc-100 rounded-lg text-[11px] font-bold text-zinc-600 uppercase tracking-widest">
                                <i class="fa-solid fa-gear text-zinc-400"></i> {{ $car->transmission }}
                            </span>
                            <span class="inline-flex items-center gap-2 px-3 py-2 bg-zinc-50 border border-zinc-100 rounded-lg text-[11px] font-bold text-zinc-600 uppercase tracking-widest">
                                <i class="fa-solid fa-calendar text-zinc-400"></i> {{ $car->year }}
                            </span>
                        </div>
                        
                        <a href="{{ route('car.details', $car->id) }}" class="flex items-center justify-between w-full bg-zinc-950 text-white px-6 py-4 rounded-2xl font-black uppercase text-xs tracking-widest group-hover:bg-red-600 transition-colors duration-300">
                            <span>View Specifications</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
                @empty
                    <div class="col-span-3 py-20 text-center bg-zinc-50 rounded-[3rem] border border-zinc-200 border-dashed">
                        <i class="fa-solid fa-car-tunnel text-4xl text-zinc-300 mb-4"></i>
                        <h3 class="text-xl font-black text-zinc-900 tracking-tight">Showroom is being updated</h3>
                        <p class="text-zinc-500 font-medium mt-2">Our premium fleet is currently out on tracks. Please check back shortly.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 relative bg-[#0b1120] border-t border-white/5">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-[2px] w-10 bg-red-600"></div>
                        <span class="text-xs font-black text-red-600 uppercase tracking-[0.2em]">Priority Support</span>
                    </div>
                    <h4 class="text-5xl font-black tracking-tighter text-white mb-6">Get In <br>Touch With Us</h4>
                    <p class="text-zinc-400 leading-relaxed mb-8 max-w-md">
                        Have a special request or need executive assistance? Our premium support team is available around the clock to ensure your DriveElite experience is flawless.
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4 text-zinc-300">
                            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-red-500">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-1">Direct Line</p>
                                <p class="font-bold text-lg">{{ $settings['company_phone'] ?? '+92 300 0000000' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 text-zinc-300">
                            <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-red-500">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-500 mb-1">Email Support</p>
                                <p class="font-bold text-lg">{{ $settings['company_email'] ?? 'support@driveelite.com' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/5 backdrop-blur-3xl rounded-[2.5rem] p-8 md:p-10 border border-white/10 shadow-2xl relative">
                    
                    @if(session('success'))
                        <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-500 p-4 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                            <i class="fa-solid fa-circle-check text-lg"></i>
                            <p class="text-xs font-bold uppercase tracking-widest">{{ session('success') }}</p>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
                            <i class="fa-solid fa-circle-exclamation text-lg"></i>
                            <p class="text-xs font-bold uppercase tracking-widest">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2 block ml-2">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-red-600 transition-all text-sm placeholder:text-zinc-600 shadow-inner" placeholder="John Doe">
                                @error('name') <span class="text-red-500 text-[10px] font-bold mt-1 ml-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2 block ml-2">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-red-600 transition-all text-sm placeholder:text-zinc-600 shadow-inner" placeholder="john@example.com">
                                @error('email') <span class="text-red-500 text-[10px] font-bold mt-1 ml-2 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2 block ml-2">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-red-600 transition-all text-sm placeholder:text-zinc-600 shadow-inner" placeholder="+92 300...">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2 block ml-2">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-red-600 transition-all text-sm placeholder:text-zinc-600 shadow-inner" placeholder="Inquiry Type">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2 block ml-2">Your Message <span class="text-red-500">*</span></label>
                            <textarea name="message" required rows="4" class="w-full bg-[#0b1120] border border-white/10 text-white rounded-2xl py-4 px-6 outline-none focus:border-red-600 transition-all text-sm placeholder:text-zinc-600 shadow-inner resize-none" placeholder="How can we assist you today?">{{ old('message') }}</textarea>
                            @error('message') <span class="text-red-500 text-[10px] font-bold mt-1 ml-2 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-[0_10px_30px_rgba(220,38,38,0.3)] hover:-translate-y-1 transition-all uppercase tracking-[0.2em] text-xs">
                            Send Secure Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-zinc-950 pt-32 pb-10 text-white relative overflow-hidden border-t border-zinc-900">
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-12 gap-16 mb-24 relative z-10">
            <div class="md:col-span-5">
                <a href="#" class="text-4xl font-black tracking-tighter text-white uppercase flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center shadow-lg shadow-red-600/20">
                        <i class="fa-solid fa-car-side text-white text-xl"></i>
                    </div>
                    <span>Drive<span class="text-red-600">Elite</span></span>
                </a>
                <p class="text-zinc-400 font-medium leading-relaxed max-w-sm mb-10">
                    Redefining luxury travel. Experience unmatched comfort, raw power, and elite service with our carefully curated automotive collection.
                </p>
                
                <div class="flex gap-4">
                    @if(isset($settings['whatsapp']))
                        <a href="https://wa.me/{{ str_replace(['+', ' '], '', $settings['whatsapp']) }}" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-green-500 hover:border-green-500 transition-all duration-300 text-lg group">
                            <i class="fa-brands fa-whatsapp text-zinc-400 group-hover:text-white"></i>
                        </a>
                    @endif
                    @if(isset($settings['instagram']))
                        <a href="{{ $settings['instagram'] }}" target="_blank" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-red-500 hover:to-purple-600 hover:border-transparent transition-all duration-300 text-lg group">
                            <i class="fa-brands fa-instagram text-zinc-400 group-hover:text-white"></i>
                        </a>
                    @endif
                    @if(isset($settings['facebook']))
                        <a href="{{ $settings['facebook'] }}" target="_blank" class="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center hover:bg-blue-600 hover:border-blue-600 transition-all duration-300 text-lg group">
                            <i class="fa-brands fa-facebook-f text-zinc-400 group-hover:text-white"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="md:col-span-4">
                <h5 class="font-black uppercase tracking-[0.2em] text-xs mb-8 text-white">Headquarters</h5>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4 text-zinc-400">
                        <i class="fa-solid fa-location-dot mt-1 text-red-600"></i>
                        <span class="font-medium">{{ $settings['address'] ?? 'Sargodha, Punjab, Pakistan' }}</span>
                    </li>
                    <li class="flex items-start gap-4 text-zinc-400">
                        <i class="fa-solid fa-envelope mt-1 text-red-600"></i>
                        <span class="font-medium">{{ $settings['contact_email'] ?? 'info@driveelite.com' }}</span>
                    </li>
                    <li class="flex items-start gap-4 text-zinc-400">
                        <i class="fa-solid fa-phone mt-1 text-red-600"></i>
                        <span class="font-medium">{{ $settings['whatsapp'] ?? '+92 300 0000000' }}</span>
                    </li>
                </ul>
                @if(isset($settings['map_link']))
                    <a href="{{ $settings['map_link'] }}" target="_blank" class="inline-flex items-center gap-2 mt-8 text-xs font-black uppercase tracking-widest text-red-500 hover:text-white transition-colors">
                        <i class="fa-solid fa-map"></i> Open in Maps
                    </a>
                @endif
            </div>

            <div class="md:col-span-3">
                <h5 class="font-black uppercase tracking-[0.2em] text-xs mb-8 text-white">Explore</h5>
                <ul class="text-zinc-400 font-medium space-y-4">
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">About DriveElite</a></li>
                    <li><a href="{{ route('fleet') }}" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Our Fleet</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 border-t border-white/10 pt-10 flex flex-col md:flex-row justify-between items-center gap-6 relative z-10">
            <p class="text-zinc-500 text-[10px] font-bold uppercase tracking-[0.2em]">
                &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'DriveElite' }}. All rights reserved.
            </p>
            
            <div class="bg-white/5 px-6 py-3 rounded-full border border-white/10 flex items-center gap-3 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                <p class="text-zinc-400 text-[10px] font-bold uppercase tracking-widest">
                    Developed by <span class="text-white font-black tracking-[0.2em] ml-1 drop-shadow-[0_0_10px_rgba(255,255,255,0.5)]">NOOR NOSHAD</span>
                </p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>
</body>
</html>