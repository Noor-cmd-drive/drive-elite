@extends('frontend.layout')

@section('title', 'About Us | Drive Elite')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
    /* 🌟 THE ULTRA-PREMIUM TOOLKIT 🌟 */
    :root { --elite-orange: #f97316; --dark-bg: #0b1120; }
    
    .hero-glow { filter: blur(140px); opacity: 0.35; background: radial-gradient(circle, var(--elite-orange), transparent 70%); }
    .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    
    .text-shine { background: linear-gradient(90deg, #f97316, #fff, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: 200% auto; animation: shine 4s linear infinite; }
    @keyframes shine { to { background-position: 200% center; } }

    /* 🏎️ FLOATING GALLERY ENGINE (Fixed Links) */
    .floating-gallery { display: flex; gap: 24px; padding: 40px 10px; overflow-x: auto; scrollbar-width: none; }
    .floating-gallery::-webkit-scrollbar { display: none; }
    .gallery-node { 
        min-width: 320px; 
        height: 200px; 
        border-radius: 2rem; 
        overflow: hidden; 
        transition: all 0.6s ease; 
        border: 2px solid rgba(255,255,255,0.05);
        box-shadow: 0 20px 40px rgba(0,0,0,0.5);
    }
    .gallery-node:hover { transform: translateY(-10px) scale(1.05); border-color: var(--elite-orange); z-index: 50; }
    .gallery-node img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease; filter: brightness(0.8); }
    .gallery-node:hover img { transform: scale(1.1); filter: brightness(1); }

    /* 📊 ELITE STATS ENGINE */
    .stat-box { 
        background: #111827; 
        border: 1px solid rgba(255, 255, 255, 0.02); 
        border-radius: 2.5rem; 
        padding: 3rem 2rem; 
        text-align: center;
        transition: all 0.4s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .stat-box:hover { border-color: rgba(249, 115, 22, 0.3); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(249, 115, 22, 0.1); }

    /* ❓ ELITE FAQ ENGINE */
    .faq-answer { max-height: 0; opacity: 0; overflow: hidden; transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .faq-item.active .faq-answer { max-height: 300px; opacity: 1; padding-top: 1rem; }
    .faq-icon { transition: transform 0.4s ease; }
    .faq-item.active .faq-icon { transform: rotate(180deg); color: var(--elite-orange); }
    .faq-item.active .faq-question-text { color: var(--elite-orange); }

    /* 📝 HOW TO BOOK STEP LINES */
    .step-line { position: absolute; top: 3rem; left: 50%; width: 100%; height: 2px; background: linear-gradient(90deg, var(--elite-orange), transparent); z-index: 0; opacity: 0.3; hidden: true; }
    @media (min-width: 768px) { .step-line { display: block; } }
</style>

<div class="relative w-full h-[85vh] flex flex-col items-center justify-center overflow-hidden bg-[#0b1120]">
    <div class="absolute inset-0 z-0">
        <video autoplay loop muted playsinline preload="auto" class="absolute inset-0 w-full h-full object-cover opacity-30 transform scale-105 pointer-events-none">
            <source src="{{ asset('videos/bg.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0b1120]/80 to-[#0b1120]"></div>
    </div>
    
    <div class="absolute top-1/4 right-[-10%] w-[600px] h-[600px] hero-glow rounded-full pointer-events-none"></div>

    <div class="relative z-10 text-center px-6 mt-10" data-aos="zoom-out" data-aos-duration="1500">
        <h1 class="font-poppins text-7xl md:text-9xl font-black text-white tracking-tighter italic uppercase leading-[0.85] mb-6">
            The <span class="text-shine">Heritage.</span>
        </h1>
        <p class="font-inter text-gray-400 max-w-3xl mx-auto text-xl font-light leading-relaxed mb-16">
            We don't just bridge distances; we engineer milestones. Drive Elite is the definitive standard for the nation's most distinguished journeys.
        </p>
    </div>

    <div class="relative z-20 w-full max-w-7xl mx-auto floating-gallery" data-aos="fade-up" data-aos-delay="300">
        <div class="gallery-node relative">
            <img src="https://images.unsplash.com/photo-1563720360172-67b8f3dce741?auto=format&fit=crop&q=80&w=800" alt="Toyota Land Cruiser V8">
            <div class="absolute bottom-4 left-4 bg-black/70 px-3 py-1 rounded-lg text-white text-xs font-bold uppercase border border-white/10">V8 Land Cruiser</div>
        </div>
        <div class="gallery-node relative">
            <img src="https://images.unsplash.com/photo-1590362891991-f776e747a588?auto=format&fit=crop&q=80&w=800" alt="Honda Civic RS">
            <div class="absolute bottom-4 left-4 bg-black/70 px-3 py-1 rounded-lg text-white text-xs font-bold uppercase border border-white/10">Civic RS</div>
        </div>
        <div class="gallery-node relative">
            <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800" alt="Toyota Fortuner">
            <div class="absolute bottom-4 left-4 bg-black/70 px-3 py-1 rounded-lg text-white text-xs font-bold uppercase border border-white/10">Fortuner</div>
        </div>
        <div class="gallery-node relative">
            <img src="https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?auto=format&fit=crop&q=80&w=800" alt="Audi A6">
            <div class="absolute bottom-4 left-4 bg-black/70 px-3 py-1 rounded-lg text-white text-xs font-bold uppercase border border-white/10">Audi A6</div>
        </div>
        <div class="gallery-node relative">
            <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800" alt="Toyota Prado TX">
            <div class="absolute bottom-4 left-4 bg-black/70 px-3 py-1 rounded-lg text-white text-xs font-bold uppercase border border-white/10">Prado TX</div>
        </div>
    </div>
</div>

<section class="py-20 bg-[#0b1120] relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="stat-box" data-aos="fade-up">
                <p class="text-6xl md:text-7xl font-black text-[#f97316] mb-3 tracking-tighter">15+</p>
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-[0.3em]">Cities</p>
            </div>
            <div class="stat-box" data-aos="fade-up" data-aos-delay="100">
                <p class="text-6xl md:text-7xl font-black text-[#f97316] mb-3 tracking-tighter">50+</p>
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-[0.3em]">Vehicles</p>
            </div>
            <div class="stat-box" data-aos="fade-up" data-aos-delay="200">
                <p class="text-6xl md:text-7xl font-black text-[#f97316] mb-3 tracking-tighter">2k+</p>
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-[0.3em]">VIP Clients</p>
            </div>
            <div class="stat-box" data-aos="fade-up" data-aos-delay="300">
                <p class="text-6xl md:text-7xl font-black text-[#f97316] mb-3 tracking-tighter">24/7</p>
                <p class="text-[11px] font-black text-gray-500 uppercase tracking-[0.3em]">Support</p>
            </div>
        </div>
    </div>
</section>

<section class="py-32 bg-white relative">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
        <div data-aos="fade-right">
            <h4 class="text-orange-500 font-black uppercase tracking-[0.4em] text-[10px] mb-6 flex items-center gap-4">
                <span class="w-16 h-[2px] bg-orange-500"></span> ESTABLISHED 2026
            </h4>
            <h2 class="text-5xl md:text-6xl font-black text-[#0b1120] tracking-tighter italic uppercase mb-10 leading-[0.9]">
                Absolute <br><span class="text-orange-500">Authority.</span>
            </h2>
            <div class="space-y-6 text-gray-600 text-lg leading-relaxed font-medium border-l-4 border-orange-500/20 pl-8">
                <p>Drive Elite was forged in the pursuit of perfection. In a market flooded with standard rentals, we recognized the need for true luxury. Whether it's a Land Cruiser V8 for a rugged tour, or an S-Class for a corporate delegation, we provide the ultimate fleet.</p>
                <p>Our collection is strictly tailored for the leaders, the dreamers, and the elite of Pakistan. We don't just hand over keys; we hand over an experience.</p>
            </div>
        </div>
        <div class="relative" data-aos="fade-left">
            <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&q=80&w=1200" class="relative z-10 rounded-[3rem] shadow-2xl w-full h-[550px] object-cover">
            
            <div class="absolute -bottom-8 -left-8 bg-[#0b1120] text-white p-8 rounded-[2rem] shadow-[0_20px_40px_rgba(249,115,22,0.3)] z-20 border border-white/10">
                <div class="flex items-center gap-4">
                    <i class="fa-solid fa-crown text-orange-500 text-3xl"></i>
                    <div>
                        <p class="text-3xl font-black italic text-white">#01</p>
                        <p class="text-[9px] font-black uppercase tracking-widest text-orange-500">In Pakistan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-32 bg-[#0b1120]">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-5xl md:text-6xl font-black text-white italic uppercase tracking-tighter mb-24">Sovereign <span class="text-orange-500">Standards.</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['icon' => 'fa-shield-halved', 'title' => 'Fortified Security', 'desc' => 'Rigorous mechanical checks. Your safety is uncompromising.'],
                ['icon' => 'fa-gem', 'title' => 'Curated Grandeur', 'desc' => 'Hand-picked Pakistani premium fleet: V8, Revo, Civic & More.'],
                ['icon' => 'fa-clock', 'title' => 'Absolute Precision', 'desc' => 'Your time is currency. Punctuality is our religion.']
            ] as $idx => $p)
                <div class="glass-card p-12 rounded-[3rem] group text-center" data-aos="fade-up" data-aos-delay="{{ $idx * 150 }}">
                    <div class="w-20 h-20 bg-orange-500/10 text-orange-500 rounded-[1.5rem] flex items-center justify-center text-4xl mx-auto mb-8 group-hover:bg-orange-500 group-hover:text-white transition-all shadow-xl">
                        <i class="fa-solid {{ $p['icon'] }}"></i>
                    </div>
                    <h3 class="text-2xl font-black text-white italic uppercase mb-4">{{ $p['title'] }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">{{ $p['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24 bg-[#080d18] relative border-t border-white/5 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20" data-aos="fade-up">
            <h4 class="text-orange-500 font-black uppercase tracking-[0.4em] text-[10px] mb-4">A Seamless Experience</h4>
            <h2 class="text-5xl md:text-6xl font-black text-white italic uppercase tracking-tighter mb-4">How To <span class="text-orange-500">Book.</span></h2>
            <p class="text-gray-400 text-lg font-light max-w-2xl mx-auto">Reserving your premium vehicle is a streamlined, effortless process designed for your absolute convenience.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <div class="relative z-10 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="hidden md:block step-line"></div>
                <div class="w-24 h-24 mx-auto bg-[#0b1120] border-2 border-orange-500 rounded-full flex items-center justify-center text-3xl text-orange-500 mb-6 shadow-[0_0_30px_rgba(249,115,22,0.2)] relative z-20">
                    <i class="fa-solid fa-car"></i>
                </div>
                <h3 class="text-2xl font-black text-white italic uppercase mb-3">01. Explore</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Browse our exclusive fleet and choose the perfect vehicle that suits your lifestyle and requirements.</p>
            </div>
            
            <div class="relative z-10 text-center mt-8 md:mt-0" data-aos="fade-up" data-aos-delay="200">
                <div class="hidden md:block step-line"></div>
                <div class="w-24 h-24 mx-auto bg-[#0b1120] border-2 border-orange-500 rounded-full flex items-center justify-center text-3xl text-orange-500 mb-6 shadow-[0_0_30px_rgba(249,115,22,0.2)] relative z-20">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="text-2xl font-black text-white italic uppercase mb-3">02. Schedule</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Select your desired rental dates, pickup location, and any additional VIP services like a chauffeur.</p>
            </div>

            <div class="relative z-10 text-center mt-8 md:mt-0" data-aos="fade-up" data-aos-delay="300">
                <div class="hidden md:block step-line"></div>
                <div class="w-24 h-24 mx-auto bg-[#0b1120] border-2 border-orange-500 rounded-full flex items-center justify-center text-3xl text-orange-500 mb-6 shadow-[0_0_30px_rgba(249,115,22,0.2)] relative z-20">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
                <h3 class="text-2xl font-black text-white italic uppercase mb-3">03. Secure</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Complete your reservation securely through our encrypted checkout and await instant confirmation.</p>
            </div>

            <div class="relative z-10 text-center mt-8 md:mt-0" data-aos="fade-up" data-aos-delay="400">
                <div class="w-24 h-24 mx-auto bg-[#0b1120] border-2 border-orange-500 rounded-full flex items-center justify-center text-3xl text-orange-500 mb-6 shadow-[0_0_30px_rgba(249,115,22,0.2)] relative z-20">
                    <i class="fa-solid fa-key"></i>
                </div>
                <h3 class="text-2xl font-black text-white italic uppercase mb-3">04. Command</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Receive your pristine vehicle at your doorstep. Step in, relax, and command your extraordinary journey.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-[#0b1120] relative border-t border-white/5">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h4 class="text-orange-500 font-black uppercase tracking-[0.4em] text-[10px] mb-4">Clear Your Doubts</h4>
            <h2 class="text-5xl font-black text-white italic uppercase tracking-tighter mb-4">Frequently Asked <span class="text-orange-500">Questions.</span></h2>
            <p class="text-gray-400 text-lg font-light">Everything you need to know about our premium car rental service.</p>
        </div>
        
        <div class="space-y-4">
            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="100" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">1. Do you provide professional chauffeurs?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Absolutely. We offer highly trained, discreet, and professional chauffeurs for our entire luxury fleet, ensuring a seamless and elite travel experience.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="150" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">2. How does the VIP delivery process work?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">We deliver directly to your specified location—whether it's an airport terminal, luxury hotel, or private residence. The vehicle arrives fully detailed and ready for departure.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="200" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">3. What documents are required to book a car?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">You will need a valid National Identity Card (CNIC) or Passport, a valid Driving License (if driving yourself), and a standard security deposit.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="250" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">4. What is the required security deposit?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Security deposits vary based on the vehicle class (e.g., Premium SUVs vs Executive Sedans). The deposit is fully transparent and promptly refunded upon the safe return of the vehicle.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="300" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">5. Are the vehicles fully insured?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Yes, every vehicle in the Drive Elite fleet is backed by comprehensive premium insurance, giving you absolute peace of mind during your journey.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="350" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">6. Is there any daily mileage limit?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Our rentals come with a generous daily mileage allowance. If you plan a cross-country trip, unlimited mileage packages can be arranged upon special request.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="400" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">7. Can I rent a car for a wedding or special event?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Absolutely. We offer specialized Elite Event Packages that include pristine detailing, ribbon/floral arrangements, and a smartly dressed chauffeur for your big day.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="450" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">8. Do you allow inter-city travel?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Yes, our fleet is fully permitted for nationwide travel. Whether you are traveling from Lahore to Islamabad or heading to the Northern areas, Drive Elite is ready.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="500" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">9. What is your cancellation policy?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">You can cancel your reservation free of charge up to 24 hours before your scheduled pickup time. Late cancellations may incur a nominal processing fee.</p>
                </div>
            </div>

            <div class="faq-item glass-card rounded-3xl p-6 cursor-pointer" data-aos="fade-up" data-aos-delay="550" onclick="toggleFAQ(this)">
                <div class="flex justify-between items-center">
                    <h3 class="faq-question-text text-xl font-bold text-white transition-colors">10. What happens in case of a breakdown?</h3>
                    <i class="fa-solid fa-chevron-down text-gray-500 faq-icon text-xl"></i>
                </div>
                <div class="faq-answer">
                    <p class="text-gray-400 leading-relaxed font-light border-t border-white/10 mt-2 pt-4">Our vehicles are impeccably maintained, but in the rare event of a mechanical issue, we provide 24/7 priority roadside assistance and an immediate replacement vehicle.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-32 bg-[#f8fafc]">
    <div class="max-w-6xl mx-auto px-6" data-aos="zoom-in">
        <div class="bg-[#0b1120] p-16 md:p-24 rounded-[4rem] relative overflow-hidden shadow-[0_40px_80px_-20px_rgba(0,0,0,0.5)] text-center">
            <div class="absolute -top-24 -right-24 w-80 h-80 bg-orange-500/20 rounded-full blur-[100px]"></div>
            <h2 class="relative z-10 text-5xl md:text-6xl font-black text-white italic uppercase tracking-tighter mb-8 leading-tight">Command Your <br><span class="text-orange-500">Destiny.</span></h2>
            <p class="relative z-10 text-gray-400 text-lg mb-12 max-w-2xl mx-auto font-light">Join the circle of Pakistan's most distinguished travelers. Your next chapter begins at the driver's seat.</p>
            <div class="relative z-10 flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('fleet') }}" class="bg-white text-[#0b1120] px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.4em] hover:bg-orange-500 hover:text-white transition-all shadow-xl italic w-full sm:w-auto">Enter Showroom</a>
                <a href="{{ route('contact') }}" class="text-white border border-white/20 px-12 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.4em] hover:bg-white/10 transition-all italic w-full sm:w-auto">Speak to Concierge</a>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true, offset: 50 });
    });

    // 🌟 FAQ Toggle Logic 🌟
    function toggleFAQ(element) {
        const isActive = element.classList.contains('active');
        const allItems = document.querySelectorAll('.faq-item');
        
        allItems.forEach(item => {
            item.classList.remove('active');
        });

        if (!isActive) {
            element.classList.add('active');
        }
    }
</script>

@endsection