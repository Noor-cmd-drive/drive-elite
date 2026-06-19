@extends('frontend.layout')

@section('title', 'Create New Password - Drive Elite')

@section('content')
<div class="relative min-h-screen flex items-center justify-center pt-28 pb-16 px-4 sm:px-6 lg:px-8">
    
    <div class="absolute inset-0 z-0 bg-[#0b1120]">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1603584173870-7f23fdae1b7a?q=80&w=2069&auto=format&fit=crop')] bg-cover bg-center opacity-20"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-[#0b1120] via-[#0b1120]/80 to-[#0b1120]"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-[2rem] shadow-[0_15px_50px_rgba(0,0,0,0.5)] overflow-hidden">
            
            <div class="px-8 py-10">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-tr from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-orange-500/30">
                        <i class="fa-solid fa-key text-white text-2xl"></i>
                    </div>
                    <h2 class="font-poppins text-3xl font-black text-white tracking-tight mb-3">New Password</h2>
                    <p class="font-inter text-gray-400 text-sm leading-relaxed">
                        Your identity has been verified. Please enter your new secure password below to regain access to your vault.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div>
                        <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">Registered Email</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-4 top-3.5 text-gray-500"></i>
                            <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly class="w-full bg-[#0b1120]/80 border border-white/5 text-gray-500 rounded-xl py-3 pl-11 pr-4 outline-none cursor-not-allowed font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">New Password*</label>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-4 top-3.5 text-gray-400"></i>
                            <input type="password" name="password" required placeholder="Create new password" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 pl-11 pr-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-[11px] font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">Confirm Password*</label>
                        <div class="relative">
                            <i class="fa-solid fa-check-double absolute left-4 top-3.5 text-gray-400"></i>
                            <input type="password" name="password_confirmation" required placeholder="Confirm new password" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 pl-11 pr-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-bold text-md tracking-wide py-3.5 rounded-xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.5)] hover:-translate-y-0.5 transition-all flex justify-center items-center gap-2">
                            Update Password <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection