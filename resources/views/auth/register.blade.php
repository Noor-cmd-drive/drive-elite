@extends('frontend.layout')

@section('title', 'Register - Drive Elite')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    /* 🌟 PRO ELITE STYLING */
    .iti { width: 100%; display: block; }
    .iti__country-list { 
        background-color: #0b1120; 
        border: 1px solid rgba(255,255,255,0.1); 
        color: white; 
        border-radius: 1rem; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        font-family: 'Inter', sans-serif;
        z-index: 50;
    }
    .iti__country.iti__highlight { background-color: rgba(249, 115, 22, 0.3); }
    .iti__selected-flag { border-right: 1px solid rgba(255,255,255,0.1); padding: 0 16px; }

    /* 🌟 STYLISH GLOW ANIMATION */
    .elite-card { position: relative; overflow: hidden; }
    .elite-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
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

    ::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.6; cursor: pointer; }
    
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
    .toggle-password { cursor: pointer; transition: color 0.3s ease; }
    .toggle-password:hover { color: #f97316; }
</style>

<div class="relative min-h-screen flex items-center justify-center pt-24 pb-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    
    <div class="absolute inset-0 z-0 bg-[#0b1120]">
        <img src="https://images.pexels.com/photos/18029645/pexels-photo-18029645.jpeg" 
             class="absolute inset-0 w-full h-full object-cover opacity-100" 
             alt="Luxury Cars Fleet Background">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0b1120] via-black/60 to-[#0b1120]"></div>
    </div>

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-orange-600/20 blur-[120px] rounded-full animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 blur-[120px] rounded-full animate-pulse" style="animation-delay: 2s;"></div>

    <div class="relative z-10 w-full max-w-2xl" data-aos="zoom-in" data-aos-duration="1000">
        <div class="elite-card bg-white/5 backdrop-blur-2xl border border-white/20 rounded-[3rem] shadow-[0_30px_100px_rgba(0,0,0,0.8)]">
            
            <div class="px-8 md:px-10 py-8">
                <div class="text-center mb-6">
                    <div class="inline-block px-4 py-1 rounded-full bg-orange-500/10 border border-orange-500/20 mb-3">
                        <span class="text-orange-500 text-[9px] font-black uppercase tracking-widest">Registration</span>
                    </div>
                    <h2 class="font-poppins text-3xl font-black text-white tracking-tighter mb-2 uppercase italic">
                        Join the <span class="orange-shine">Elite</span>
                    </h2>
                    <p class="font-inter text-gray-400 text-xs font-medium leading-relaxed">Enter your details to create an account.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerForm">
                    @csrf

                    <div class="group">
                        <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Full Name</label>
                        <div class="relative">
                            <i class="fa-regular fa-user absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your full name" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Email Address</label>
                            <div class="relative">
                                <i class="fa-regular fa-envelope absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-6 outline-none font-inter text-sm shadow-inner">
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Phone Number</label>
                            <div class="relative">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required class="input-pro w-full text-white rounded-2xl py-3 pl-14 pr-6 outline-none font-inter text-sm shadow-inner">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob') }}" required max="{{ date('Y-m-d', strtotime('-18 years')) }}" class="input-pro w-full text-white rounded-2xl py-3 px-5 outline-none font-inter text-sm shadow-inner">
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Gender</label>
                            <div class="relative">
                                <select name="gender" required class="input-pro w-full text-white rounded-2xl py-3 px-5 outline-none font-inter text-sm appearance-none cursor-pointer shadow-inner">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <i class="fa-solid fa-chevron-down absolute right-5 top-4 text-gray-500 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-lock absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="password" id="passwordField" name="password" required autocomplete="new-password" placeholder="Create a password" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-10 outline-none font-inter text-sm shadow-inner">
                                <i class="fa-regular fa-eye-slash toggle-password absolute right-4 top-3.5 text-gray-400" onclick="togglePasswordVisibility('passwordField', this)"></i>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1.5 ml-2">Confirm Password</label>
                            <div class="relative">
                                <i class="fa-solid fa-check-double absolute left-5 top-3.5 text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                                <input type="password" id="confirmPasswordField" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" class="input-pro w-full text-white placeholder-gray-500 rounded-2xl py-3 pl-12 pr-10 outline-none font-inter text-sm shadow-inner">
                                <i class="fa-regular fa-eye-slash toggle-password absolute right-4 top-3.5 text-gray-400" onclick="togglePasswordVisibility('confirmPasswordField', this)"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2">
                        <label class="flex items-center group cursor-pointer ml-2">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="driving_license" required class="peer appearance-none w-4 h-4 border-2 border-white/20 rounded-sm bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[9px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-[11px] text-gray-400 group-hover:text-gray-200 transition-colors font-medium">I hold a valid driver's license.</span>
                        </label>

                        <label class="flex items-center group cursor-pointer ml-2">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="terms" required class="peer appearance-none w-4 h-4 border-2 border-white/20 rounded-sm bg-transparent checked:bg-orange-500 checked:border-orange-500 transition-all">
                                <i class="fa-solid fa-check absolute text-[9px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                            <span class="ml-3 text-[11px] text-gray-400 group-hover:text-gray-200 transition-colors font-medium">I agree to the <a href="javascript:void(0)" onclick="showTerms()" class="text-orange-500 font-bold hover:underline">Terms & Conditions</a>.</span>
                        </label>
                    </div>

                    <div class="flex flex-col items-center pt-1">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark" style="transform: scale(0.9); transform-origin: center;"></div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="group relative w-full bg-orange-500 hover:bg-orange-600 text-white font-poppins font-black text-sm uppercase italic tracking-[0.2em] py-3.5 rounded-2xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] transition-all active:scale-95 overflow-hidden">
                            <span class="relative z-10">Create Account</span>
                            <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        </button>
                    </div>
                </form>

                <p class="text-center text-[11px] text-gray-400 font-medium mt-6">
                    Already have an account? <a href="{{ route('login') }}" class="text-white hover:text-orange-500 transition-colors font-bold ml-1">Sign in here</a>
                </p>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
            initialCountry: "pk",
            separateDialCode: true,
            preferredCountries: ["pk", "ae", "sa", "us", "uk"]
        });

        document.getElementById("registerForm").addEventListener("submit", function(e) {
            // Check if captcha is completed
            var response = grecaptcha.getResponse();
            if(response.length == 0) {
                e.preventDefault();
                alert("Please complete the reCAPTCHA verification.");
                return false;
            }
            input.value = iti.getNumber();
        });
    });

    // 🚀 Password Visibility Toggle Function 🚀
    function togglePasswordVisibility(fieldId, iconElement) {
        var passwordField = document.getElementById(fieldId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            iconElement.classList.remove("fa-eye-slash");
            iconElement.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            iconElement.classList.remove("fa-eye");
            iconElement.classList.add("fa-eye-slash");
        }
    }

    // 🚀 Professional Detailed Terms & Conditions 🚀
    function showTerms() {
        Swal.fire({
            title: 'TERMS & CONDITIONS',
            html: `
                <div style="text-align: left; font-size: 12px; line-height: 1.6; max-height: 250px; overflow-y: auto; padding-right: 15px; font-family: 'Inter';">
                    <h4 style="color: #f97316; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">01. Driver Eligibility</h4>
                    <p style="color: #9ca3af; margin-bottom: 15px;">Renters must be at least 21 years of age and possess a valid, government-issued driving license for a minimum of 1 year. Verification is required before vehicle handover.</p>

                    <h4 style="color: #f97316; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">02. Insurance & Liability</h4>
                    <p style="color: #9ca3af; margin-bottom: 15px;">All vehicles include standard comprehensive insurance. The renter is responsible for any excess charges in case of at-fault accidents, negligence, or interior damage.</p>

                    <h4 style="color: #f97316; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">03. Vehicle Usage Rules</h4>
                    <p style="color: #9ca3af; margin-bottom: 15px;">Strictly no off-roading, track racing, or subleasing. Vehicles must be returned with the same fuel level as provided, otherwise refueling charges will apply.</p>

                    <h4 style="color: #f97316; font-weight: 800; margin-bottom: 5px; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">04. Security Deposit</h4>
                    <p style="color: #9ca3af; margin-bottom: 5px;">A refundable security deposit is held during the rental period to cover potential tolls, traffic fines, or incidental damages. Refunds are processed within 14 working days after vehicle return.</p>
                </div>
            `,
            background: '#070b14',
            color: '#fff',
            confirmButtonText: 'I AGREE',
            confirmButtonColor: '#f97316',
            width: '550px',
            customClass: { popup: 'border border-white/10 rounded-[2rem] shadow-2xl' }
        });
    }

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Registration Error',
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
                confirmButtonColor: '#dc2626'
            });
        });
    @endif
</script>
@endsection