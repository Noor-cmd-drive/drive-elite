<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_name'] ?? 'DriveElite' }} | Premium Car Rental</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <h1 class="text-2xl font-black tracking-tighter uppercase italic">
                <span class="text-red-600">Drive</span>Elite
            </h1>
            <div class="hidden md:flex items-center gap-8 font-bold text-sm uppercase tracking-widest text-gray-600">
                <a href="#" class="hover:text-red-600 transition">Our Fleet</a>
                <a href="#" class="hover:text-red-600 transition">How it Works</a>
                <a href="#" class="hover:text-red-600 transition">Contact</a>
            </div>
            <a href="{{ route('login') }}" class="bg-gray-900 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-red-600 transition shadow-lg shadow-gray-900/10">
                Client Portal
            </a>
        </div>
    </nav>

    <section class="pt-40 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="bg-red-50 text-red-600 px-4 py-2 rounded-full text-xs font-black uppercase tracking-[0.2em] border border-red-100 mb-6 inline-block">Premium Experience</span>
                <h2 class="text-6xl lg:text-8xl font-black tracking-tighter leading-[0.9] mb-8">
                    Drive Your <br><span class="text-red-600 uppercase">Dreams</span> Today.
                </h2>
                <p class="text-gray-500 text-lg font-medium mb-10 max-w-md">Experience the pinnacle of luxury and performance with DriveElite's exclusive vehicle collection.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#fleet" class="bg-red-600 text-white px-8 py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-red-700 transition-all transform hover:-translate-y-1 shadow-2xl shadow-red-600/30">Explore Fleet</a>
                    <a href="https://wa.me/{{ str_replace(['+', ' '], '', $settings['whatsapp'] ?? '') }}" class="bg-white border border-gray-200 px-8 py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-gray-50 transition-all flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i> Fast Track
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-10 bg-red-600/5 rounded-full blur-3xl"></div>
                <img src="https://purepng.com/public/uploads/large/purepng.com-mercedes-benz-carmercedes-benzmercedesbenzmercedes-cars-1701527506240d0rbe.png" alt="Luxury Car" class="relative z-10 w-full drop-shadow-2xl">
            </div>
        </div>
    </section>

    <section id="fleet" class="py-24 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h4 class="text-4xl font-black tracking-tighter uppercase">Our Elite <span class="text-red-600">Fleet</span></h4>
                    <p class="text-gray-400 font-medium mt-2">Choose from our curated selection of high-performance vehicles.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($cars as $car)
                <div class="group bg-gray-50 rounded-[2.5rem] p-4 border border-gray-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="relative h-64 overflow-hidden rounded-[2rem] bg-white border border-gray-100">
                        <img src="{{ asset('storage/' . $car->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $car->brand }}">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-4 py-2 rounded-xl text-xs font-black text-gray-900 shadow-sm border border-white">
                            Rs. {{ number_format($car->daily_rent) }} / Day
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h5 class="text-xl font-black text-gray-900 leading-tight">{{ $car->brand }} {{ $car->model_name }}</h5>
                                <p class="text-xs font-bold text-red-600 uppercase tracking-widest mt-1">{{ $car->category->name }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2 mb-8">
                            <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                                <i class="fa-solid fa-chair text-gray-400 text-xs mb-1"></i>
                                <p class="text-[10px] font-black text-gray-900 uppercase tracking-tighter">{{ $car->seats }} Seats</p>
                            </div>
                            <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                                <i class="fa-solid fa-gear text-gray-400 text-xs mb-1"></i>
                                <p class="text-[10px] font-black text-gray-900 uppercase tracking-tighter">{{ $car->transmission }}</p>
                            </div>
                            <div class="bg-white p-3 rounded-2xl border border-gray-100 text-center">
                                <i class="fa-solid fa-calendar text-gray-400 text-xs mb-1"></i>
                                <p class="text-[10px] font-black text-gray-900 uppercase tracking-tighter">{{ $car->year }}</p>
                            </div>
                        </div>
                        <a href="#" class="block w-full text-center bg-gray-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest group-hover:bg-red-600 transition-colors">
                            Rent this Vehicle
                        </a>
                    </div>
                </div>
                @empty
                    <p class="text-gray-400 font-medium italic">Our fleet is currently out on tracks. Check back soon!</p>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 pt-24 pb-12 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-20">
            <div class="md:col-span-2">
                <h1 class="text-4xl font-black tracking-tighter uppercase italic mb-6">
                    <span class="text-red-600">Drive</span>Elite
                </h1>
                <p class="text-gray-400 max-w-sm font-medium leading-relaxed">The ultimate car rental solution for enthusiasts who demand excellence, style, and performance on every road.</p>
                
                <div class="flex gap-4 mt-8">
                    @if(isset($settings['whatsapp']))
                        <a href="https://wa.me/{{ str_replace(['+', ' '], '', $settings['whatsapp']) }}" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-green-500 transition-all text-xl">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif
                    @if(isset($settings['instagram']))
                        <a href="{{ $settings['instagram'] }}" target="_blank" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-pink-600 transition-all text-xl">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    @if(isset($settings['facebook']))
                        <a href="{{ $settings['facebook'] }}" target="_blank" class="w-12 h-12 rounded-xl bg-gray-800 flex items-center justify-center hover:bg-blue-600 transition-all text-xl">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div>
                <h5 class="font-black uppercase tracking-widest text-sm mb-6 text-red-600">Headquarters</h5>
                <p class="text-gray-400 font-medium leading-loose">
                    {{ $settings['address'] ?? 'Sargodha, Punjab' }}<br>
                    {{ $settings['contact_email'] ?? 'info@driveelite.com' }}
                </p>
                @if(isset($settings['map_link']))
                    <a href="{{ $settings['map_link'] }}" target="_blank" class="inline-block mt-4 text-xs font-black uppercase text-white border-b border-red-600 pb-1">Get Directions</a>
                @endif
            </div>
            <div>
                <h5 class="font-black uppercase tracking-widest text-sm mb-6 text-red-600">Company</h5>
                <ul class="text-gray-400 font-medium space-y-4">
                    <li><a href="#" class="hover:text-white transition">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 border-t border-gray-800 pt-12 flex flex-col md:flex-row justify-between items-center gap-6 text-gray-500 text-xs font-bold uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'DriveElite' }}. Crafted for Performance.</p>
            <p>Built by Abdul Hadi</p>
        </div>
    </footer>

</body>
</html>