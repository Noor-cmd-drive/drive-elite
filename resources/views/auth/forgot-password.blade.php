@extends('frontend.layout')

@section('title', 'Secure Recovery - Drive Elite')

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
                        <i class="fa-solid fa-shield-halved text-white text-2xl"></i>
                    </div>
                    <h2 class="font-poppins text-3xl font-black text-white tracking-tight mb-3">Secure Recovery</h2>
                    <p class="font-inter text-gray-400 text-sm leading-relaxed">
                        Forgot your password? No problem. Enter your email address below and we will send you a secure link to regain access to your vault.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 font-inter font-bold text-sm text-green-400 bg-green-400/10 p-4 rounded-xl border border-green-400/20 text-center">
                        <i class="fa-solid fa-circle-check mr-1"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">Registered Email Address</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-4 top-3.5 text-gray-400"></i>
                            <input type="email" name="email" :value="old('email')" required autofocus placeholder="admin@driveelite.com" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 pl-11 pr-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-[11px] font-bold mt-2 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-bold text-md tracking-wide py-3.5 rounded-xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.5)] hover:-translate-y-0.5 transition-all">
                            Send Secure Link
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center border-t border-white/10 pt-6">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 font-inter hover:text-orange-500 transition-colors font-bold">
                        <i class="fa-solid fa-arrow-left text-xs"></i> Return to Login
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection