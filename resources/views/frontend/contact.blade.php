@extends('frontend.layout')

@section('title', 'Contact Concierge | Drive Elite')

@section('content')

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<style>
    /* 🌟 THE ULTRA-PREMIUM TOOLKIT 🌟 */
    :root { --elite-orange: #f97316; --dark-bg: #0b1120; }
    
    .hero-glow { filter: blur(140px); opacity: 0.35; background: radial-gradient(circle, var(--elite-orange), transparent 70%); }
    .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(25px); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .glass-card:hover { border-color: rgba(249, 115, 22, 0.4); box-shadow: 0 40px 80px -20px rgba(0,0,0,0.5); }
    
    .text-shine { background: linear-gradient(90deg, #f97316, #fff, #f97316); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: 200% auto; animation: shine 4s linear infinite; }
    @keyframes shine { to { background-position: 200% center; } }

    /* 📝 LUXURY INPUT FIELDS */
    .input-elite { 
        background: rgba(11, 17, 32, 0.8); 
        border: 1px solid rgba(255, 255, 255, 0.05); 
        color: white; 
        border-radius: 1.5rem; 
        padding: 1.25rem 1.5rem; 
        font-family: 'Inter', sans-serif;
        font-size: 0.875rem; 
        outline: none; 
        transition: all 0.4s ease; 
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.2);
    }
    .input-elite:focus { 
        border-color: var(--elite-orange); 
        background: rgba(11, 17, 32, 1); 
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.5), 0 0 20px rgba(249, 115, 22, 0.1); 
    }
    .input-elite::placeholder { color: rgba(255,255,255,0.3); }
    
    /* 🗺️ DYNAMIC MAP STYLING */
    .dark-map { filter: grayscale(100%) invert(92%) contrast(83%); opacity: 0.7; mix-blend-mode: luminosity; transition: all 0.5s ease; }
    .map-container:hover .dark-map { filter: grayscale(0%) invert(0%) contrast(100%); opacity: 1; mix-blend-mode: normal; }

    /* 🔗 LINK BADGE STYLE */
    .link-badge { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); padding: 10px 18px; border-radius: 14px; display: inline-flex; align-items: center; gap: 10px; color: white; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; }
    .link-badge:hover { background: #f97316; border-color: #f97316; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(249, 115, 22, 0.2); }
</style>

<div class="relative w-full h-[65vh] flex items-center justify-center overflow-hidden bg-[#0b1120]">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=1920')] bg-cover bg-center opacity-20 transform scale-105"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0b1120] via-[#0b1120]/80 to-transparent"></div>
    </div>
    <div class="absolute top-1/4 right-[-10%] w-[500px] h-[500px] hero-glow rounded-full pointer-events-none"></div>
    <div class="relative z-10 text-center px-6 mt-10" data-aos="zoom-out" data-aos-duration="1500">
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full glass-card mb-8 shadow-2xl">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-orange-500"></span>
            </span>
            <span class="text-orange-100 text-[10px] font-black tracking-[0.4em] uppercase">24/7 VIP Concierge</span>
        </div>
        <h1 class="font-poppins text-6xl md:text-8xl font-black text-white tracking-tighter italic uppercase mb-6 leading-none">
            Get In <span class="text-shine">Touch.</span>
        </h1>
        <p class="font-inter text-gray-400 max-w-2xl mx-auto text-lg font-light leading-relaxed">Have a special request or need executive assistance? Our premium support team is available round the clock.</p>
    </div>
</div>

<div class="relative min-h-screen pb-32 pt-10 bg-[#0b1120] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-card p-10 rounded-[3rem] flex items-center gap-6 group cursor-pointer" onclick="window.location.href='{{ $settings['whatsapp_link'] ?? '#' }}'" data-aos="fade-right" data-aos-delay="100">
                    <div class="w-20 h-20 bg-orange-500/10 text-orange-500 rounded-[1.5rem] flex items-center justify-center text-3xl group-hover:bg-green-500 group-hover:text-white transition-all duration-500 shadow-xl">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2">Secure Line</p>
                        <p class="text-white font-bold text-xl tracking-wider group-hover:text-green-500 transition-colors">{{ $settings['company_phone'] ?? '+92 300 0000000' }}</p>
                    </div>
                </div>

                <div class="glass-card p-10 rounded-[3rem] flex items-center gap-6 group cursor-pointer" onclick="window.location.href='mailto:{{ $settings['company_email'] ?? 'support@driveelite.com' }}'" data-aos="fade-right" data-aos-delay="200">
                    <div class="w-20 h-20 bg-orange-500/10 text-orange-500 rounded-[1.5rem] flex items-center justify-center text-3xl group-hover:bg-orange-500 group-hover:text-white transition-all duration-500 shadow-xl">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-500 mb-2">Executive Desk</p>
                        <p class="text-white font-bold text-sm tracking-widest uppercase">{{ $settings['company_email'] ?? 'support@driveelite.com' }}</p>
                    </div>
                </div>

                @php
                    $admin_address = $settings['company_address'] ?? '';
                    $admin_map_link = $settings['google_map_link'] ?? '';
                    
                    // Fixed logic: Use Address Search as iframe src to avoid "Refused to connect"
                    $embed_url = !empty($admin_address) ? "https://www.google.com/maps?q=" . urlencode($admin_address) . "&output=embed" : "";
                @endphp

                <div class="glass-card rounded-[3rem] overflow-hidden group map-container" data-aos="fade-right" data-aos-delay="300">
                    <div class="h-64 w-full bg-gray-900 overflow-hidden relative border-b border-white/5">
                        <iframe class="w-full h-full dark-map" src="{{ $embed_url }}" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="p-8 flex flex-col gap-5 relative z-10 bg-[#0b1120]/80 backdrop-blur-md">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white/5 text-orange-500 rounded-xl flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-white transition-all duration-500">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-500 mb-0.5">Headquarters</p>
                                <p class="text-white font-bold text-xs">{{ $admin_address }}</p>
                            </div>
                        </div>

                        <div class="pt-2 border-t border-white/5 flex flex-wrap gap-3 items-center">
                            @if(!empty($admin_map_link))
                            <a href="{{ $admin_map_link }}" target="_blank" class="link-badge">
                                <i class="fa-solid fa-location-dot"></i>
                                Google Maps
                            </a>
                            <button onclick="copyToClipboard('{{ $admin_map_link }}')" class="text-[9px] text-gray-500 hover:text-white uppercase font-black tracking-widest transition-all">
                                <i class="fa-regular fa-copy mr-1"></i> Copy Link
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2" data-aos="fade-left" data-aos-delay="300">
                <div class="glass-card rounded-[4rem] p-10 md:p-16 shadow-2xl relative overflow-hidden h-full">
                    <div class="absolute top-0 right-0 w-80 h-80 bg-orange-500/10 rounded-full blur-[100px] pointer-events-none"></div>
                    <div class="mb-14 relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <h3 class="font-poppins text-4xl font-black text-white italic uppercase tracking-tighter mb-2">Secure Messaging</h3>
                            <p class="text-gray-400 text-xs uppercase tracking-widest font-bold">Fields marked with <span class="text-orange-500">*</span> are required.</p>
                        </div>
                        <button type="submit" form="eliteContactForm" class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center bg-transparent hover:bg-orange-500 hover:border-orange-500 transition-all duration-300 group cursor-pointer shadow-lg hover:shadow-[0_0_30px_rgba(249,115,22,0.4)]">
                            <i class="fa-solid fa-paper-plane text-orange-500 text-2xl group-hover:text-white group-hover:-translate-y-1 group-hover:translate-x-1 transition-all duration-300"></i>
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="mb-10 bg-green-500/10 border border-green-500/30 p-6 rounded-[2rem] flex items-center gap-5 relative z-10 backdrop-blur-md shadow-xl">
                            <div class="w-12 h-12 rounded-2xl bg-green-500/20 flex items-center justify-center"><i class="fa-solid fa-check text-green-500 text-xl"></i></div>
                            <p class="text-sm font-black tracking-[0.2em] text-green-500 uppercase italic">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form id="eliteContactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-8 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block ml-5">Full Name <span class="text-white">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="input-elite w-full" placeholder="e.g. Ali Khan">
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block ml-5">Email Address <span class="text-white">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required class="input-elite w-full" placeholder="e.g. ali@corporate.com">
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block ml-5">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="input-elite w-full" placeholder="Optional">
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block ml-5">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="input-elite w-full" placeholder="What is this regarding?">
                            </div>
                        </div>
                        <div class="group">
                            <label class="text-[10px] font-black text-orange-500 uppercase tracking-[0.3em] mb-4 block ml-5">Your Message <span class="text-white">*</span></label>
                            <textarea name="message" required rows="5" class="input-elite w-full resize-none" placeholder="Detail your itinerary here...">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="group w-full bg-white text-[#0b1120] font-black py-7 rounded-[2rem] hover:bg-orange-500 hover:text-white transition-all duration-500 shadow-2xl uppercase text-xs tracking-[0.4em] italic overflow-hidden relative mt-8">
                            <span class="relative z-10 flex items-center justify-center gap-4">Transmit Message <i class="fa-solid fa-arrow-right group-hover:translate-x-3 transition-transform"></i></span>
                            <div class="absolute inset-0 bg-orange-600 translate-y-full group-hover:translate-y-0 transition-transform duration-700 z-0"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() { AOS.init({ duration: 1200, once: true, mirror: false, offset: 50 }); });
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Full link copied!', showConfirmButton: false, timer: 2000, background: '#0b1120', color: '#fff' });
        });
    }
</script>

@endsection