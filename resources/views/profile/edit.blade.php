@extends('frontend.layout')

@section('title', 'Profile Settings - Drive Elite')

@section('content')
<div class="relative min-h-screen pt-32 pb-20 overflow-hidden" 
     style="background: linear-gradient(rgba(11, 17, 32, 0.85), rgba(11, 17, 32, 0.95)), 
            url('https://images.unsplash.com/photo-1617531653332-bd46c24f2068?q=80&w=2115&auto=format&fit=crop'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;">
    
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/10 rounded-full blur-[120px] -mr-48 -mt-48 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px] -ml-40 -mb-40 pointer-events-none"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <div class="text-center mb-10">
            <h2 class="font-poppins text-4xl font-black text-white tracking-tight">Profile <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">Settings</span></h2>
            <p class="font-inter text-gray-400 text-sm mt-2">Manage your account details and executive credentials.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-2xl rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-[0_15px_50px_rgba(0,0,0,0.5)]">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white/10 backdrop-blur-2xl rounded-[2rem] p-8 md:p-10 border border-white/20 shadow-[0_15px_50px_rgba(0,0,0,0.5)]">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white/5 backdrop-blur-2xl rounded-[2rem] p-8 md:p-10 border border-red-500/20 shadow-[0_15px_50px_rgba(0,0,0,0.5)] relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-red-500/10 rounded-full blur-[60px] pointer-events-none"></div>
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>
@endsection