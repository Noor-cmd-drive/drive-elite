@extends('frontend.layout')

@section('title', 'Log In - Drive Elite')

@section('content')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    /* 🌟 STYLISH GLOW ANIMATION (Like Register) */
    .elite-card { position: relative; overflow: hidden; }
    .elite-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(249, 115, 22, 0.15) 0%, transparent 70%);
        animation: rotateGlow 10s linear infinite;
        pointer-events: none;
    }
    @keyframes rotateGlow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .orange-shine {
        background: linear-gradient(90deg, #f97316, #fff, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% auto;
        animation: textShine 4s linear infinite;
    }
    @keyframes textShine { to { background-position: 200% center; } }

    .input-pro {
        background: rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .input-pro:focus {
        background: rgba(0, 0, 0, 0.5);
        border-color: #f97316;
        box-shadow: 0 0 15px rgba(249, 115, 22, 0.2);
        transform: translateY(-2px);
    }
    
    /* 🌟 Social Button Hover Effects */
    .social-btn:hover { background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); }
    .facebook-btn:hover { background: rgba(24, 119, 242, 0.1); border-color: rgba(24, 119, 242, 0.5); }
</style>

<div class="relative min-h-screen flex items-center justify-center pt-24 pb-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    <div class="absolute inset-0 z-0 bg-[#0b1120]">
        <img src="https://images.pexels.com/photos/9348013/pexels-photo-9348013.jpeg" 
             class="absolute inset-0 w-full h-full object-cover opacity-100" 
             alt="Luxury Cars Fleet Background">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0b1120] via-black/50 to-[#0b1120]"></div>
    </div>

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-600/20 blur-[120px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>

    <div class="relative z-10 w-full max-w-md" data-aos="zoom-in" data-aos-duration="1000">
        <div class="elite-card bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[3rem] shadow-[0_30px_100px_rgba(0,0,0,0.8)]">
            
            <div class="px-8 py-8">
                <div class="text-center mb-6">
                    <div class="w-14 h-14 bg-gradient-to-tr from-orange-400 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-orange-500/30">
                        <i class="fa-solid fa-user-lock text-white text-xl"></i>
                    </div>
                    <h2 class="font-poppins text-3xl font-black text-white tracking-tighter mb-2 uppercase italic">
                        Welcome <span class="orange-shine">Back</span>
                    </h2>
                    <p class="font-inter text-gray-400 text-xs font-medium leading-relaxed">Please enter your details to sign in.</p>
                </div>

                <form method="POST" action="{{ url('/login') }}" class="space-y-4" id="loginForm">
                    @csrf

                    <div class="group">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Email Address</label>
                        <div class="relative">
                            <i class="fa-regular fa-envelope absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div class="group">
                        <div class="flex justify-between items-center mb-1.5 ml-2 pr-2">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-gray-400 hover:text-orange-400 transition-colors">Forgot Password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="password" name="password" required placeholder="Enter your password" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div class="flex items-center ml-2 pt-1">
                        <label class="flex items-center group cursor-pointer">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="remember" id="remember" class="peer appearance-none w-4 h-4 border-2 border-white/20 rounded-sm bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[9px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-[12px] text-gray-400 group-hover:text-gray-200 transition-colors font-medium">Remember me</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center pt-1">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark" style="transform: scale(0.9); transform-origin: center;"></div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="group relative w-full bg-orange-500 hover:bg-orange-600 text-white font-poppins font-black text-sm uppercase italic tracking-[0.2em] py-3.5 rounded-2xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Sign In</span>
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        </button>
                    </div>
                </form>

                <div class="flex items-center my-6">
                    <div class="flex-grow border-t border-white/10"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-500 text-[10px] uppercase tracking-widest font-bold">Or continue with</span>
                    <div class="flex-grow border-t border-white/10"></div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="social-btn flex items-center justify-center gap-2 w-full bg-white/5 border border-white/10 text-white py-3 rounded-xl transition-all font-inter text-xs font-semibold shadow-sm">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4" alt="Google"> Google
                    </a>
                    
                    <a href="#" class="facebook-btn flex items-center justify-center gap-2 w-full bg-white/5 border border-white/10 text-white py-3 rounded-xl transition-all font-inter text-xs font-semibold shadow-sm">
                        <i class="fa-brands fa-facebook text-[#1877F2] text-[18px]"></i> Facebook
                    </a>
                </div>

                <p class="text-center text-[11px] text-gray-400 font-medium mt-8">
                    Don't have an account? <a href="{{ route('register') }}" class="text-white hover:text-orange-500 transition-colors font-bold ml-1">Sign up</a>
                </p>

            </div>
        </div>
    </div>
</div>

<script>
    // reCAPTCHA Validation for Login Form
    document.getElementById("loginForm").addEventListener("submit", function(e) {
        var response = grecaptcha.getResponse();
        if(response.length == 0) {
            e.preventDefault();
            alert("Please complete the reCAPTCHA verification to proceed.");
            return false;
        }
    });

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                html: `
                    <div style="text-align: left; font-size: 14px; color: #fff; font-family: 'Inter';">
                        <ul style="list-style-type: none; padding: 0; color: #ef4444; font-weight: 600;">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: 8px;"><i class="fa-solid fa-circle-exclamation mr-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                `,
                background: '#0b1120',
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Try Again',
                customClass: { popup: 'border border-red-500/20 rounded-[2rem]' }
            });
        });
    @endif
</script>
@endsection