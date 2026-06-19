<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Drive Elite</title>
    
    <!-- 🚀 EXACT SAME ICON AS MAIN WEBSITE -->
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/741/741407.png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    
    <!-- 🌟 ANIMATION LIBRARY -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- 🚀 GOOGLE RECAPTCHA SCRIPT ADDED -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* 🚀 ULTRA-PREMIUM CINEMATIC BACKGROUND */
        .executive-bg {
            background: linear-gradient(to bottom, rgba(10, 10, 10, 0.4), rgba(10, 10, 10, 0.9)), 
                        url('https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?q=100&w=1920&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* 🌟 SMOKED GLASS PANEL (Elegant & Solid) */
        .glass-panel {
            background: rgba(10, 10, 10, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8), inset 0 0 0 1px rgba(255, 255, 255, 0.02);
        }

        /* ⚡ SLEEK INPUTS (Solid feel with Orange focus) */
        .elite-input {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }
        .elite-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(249, 115, 22, 0.7); /* Orange-500 */
            box-shadow: 0 0 15px rgba(249, 115, 22, 0.15);
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(10, 10, 10, 0.9); }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 10px; }
    </style>
</head>
<body class="executive-bg min-h-screen flex items-center justify-center p-4 sm:p-6 text-white">

    <!-- WRAPPER FOR SMOOTH FADE-IN ANIMATION -->
    <div class="w-full max-w-md relative z-10 animate__animated animate__fadeInDown animate__faster">
        
        <!-- COMPACT SMOKED GLASS PANEL -->
        <div class="glass-panel rounded-3xl p-8 md:p-10 w-full">
            
            <!-- HEADER -->
            <div class="text-center mb-8 relative">
                <div class="w-16 h-16 bg-white/5 border border-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-car-side text-2xl text-orange-500"></i>
                </div>
                <h1 class="font-poppins text-2xl font-black uppercase tracking-widest mb-1">
                    <span class="text-white">Drive</span><span class="text-orange-500">Elite</span>
                </h1>
                <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-[0.3em]">Admin Portal</p>
            </div>

            <!-- ERROR MESSAGE SHOWCASE -->
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-xl p-3 mb-6 flex items-start gap-3 animate__animated animate__shakeX">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                    <div class="text-[11px] text-red-200 font-medium tracking-wide leading-relaxed">
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="group">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 group-focus-within:text-orange-500 transition-colors">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                        <input type="email" name="email" required autocomplete="email" placeholder="admin@driveelite.com" 
                               class="elite-input w-full rounded-xl py-3.5 pl-11 pr-4 text-sm text-white placeholder-gray-600 outline-none">
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1 group-focus-within:text-orange-500 transition-colors">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-500 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••••••" 
                               class="elite-input w-full rounded-xl py-3.5 pl-11 pr-4 text-sm text-white placeholder-gray-600 outline-none tracking-widest">
                    </div>
                </div>

                <!-- 🚀 DARK THEMED RECAPTCHA WIDGET ADDED -->
                <div class="flex justify-center pt-2">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark"></div>
                </div>

                <button type="submit" class="w-full bg-orange-500 text-white font-black py-3.5 rounded-xl uppercase tracking-[0.2em] text-xs transition-all duration-300 hover:bg-orange-600 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)] mt-6">
                    <span class="flex items-center justify-center gap-2">
                        Log In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </span>
                </button>
            </form>

            <!-- SECURITY WARNING -->
            <div class="mt-8 text-center border-t border-white/5 pt-5">
                <p class="text-[9px] text-gray-500 font-medium uppercase tracking-[0.2em] flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-shield-check text-green-500"></i> Secure Connection
                </p>
            </div>

        </div>
    </div>

</body>
</html>