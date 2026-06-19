<section>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    <style>
        .iti { width: 100%; display: block; }
        .iti__country-list { background-color: #0b1120; border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 0.75rem; font-family: 'Inter', sans-serif; font-size: 14px; z-index: 50; }
        .iti__country.iti__highlight { background-color: rgba(249,115,22,0.2); }
        ::-webkit-calendar-picker-indicator { filter: invert(1); opacity: 0.6; cursor: pointer; }
    </style>

    <header>
        <h2 class="text-xl font-poppins font-black text-white">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400 font-inter">
            {{ __("Update your account's profile information, email address, and elite credentials.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6" id="profileUpdateForm">
        @csrf
        @method('patch')

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Full Name') }}</label>
            <input id="name" name="name" type="text" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500 text-xs font-bold" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Email Address') }}</label>
            <input id="email" name="email" type="email" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500 text-xs font-bold" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-400">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-orange-500 hover:text-orange-400 rounded-md focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Phone Number') }}</label>
            <div class="mt-1 w-full relative">
                <input id="phone" name="phone" type="tel" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 pl-14 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" value="{{ old('phone', $user->phone) }}" required autocomplete="tel" />
            </div>
            <x-input-error class="mt-2 text-red-500 text-xs font-bold" :messages="$errors->get('phone')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Date of Birth (18+)') }}</label>
                <input id="dob" name="dob" type="date" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" value="{{ old('dob', $user->dob) }}" required max="{{ date('Y-m-d', strtotime('-18 years')) }}" />
                <x-input-error class="mt-2 text-red-500 text-xs font-bold" :messages="$errors->get('dob')" />
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Gender') }}</label>
                <select id="gender" name="gender" class="w-full bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm appearance-none" required>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }} class="bg-[#0b1120]">Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }} class="bg-[#0b1120]">Female</option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }} class="bg-[#0b1120]">Other</option>
                </select>
                <x-input-error class="mt-2 text-red-500 text-xs font-bold" :messages="$errors->get('gender')" />
            </div>
        </div>

        <div class="flex items-start mt-4">
            <input type="hidden" name="has_driving_license" value="0">
            <input id="has_driving_license" name="has_driving_license" type="checkbox" value="1" class="mt-1 w-4 h-4 rounded bg-[#0b1120]/50 border-white/20 text-orange-500 focus:ring-orange-500 focus:ring-offset-[#0b1120]" {{ old('has_driving_license', $user->has_driving_license) ? 'checked' : '' }}>
            <label for="has_driving_license" class="ml-3 text-sm text-gray-300 font-inter cursor-pointer">
                {{ __('I confirm that I hold a valid Driving License.') }}
            </label>
        </div>
        <x-input-error class="mt-1 text-red-500 text-xs font-bold" :messages="$errors->get('has_driving_license')" />

        <div class="flex items-center gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-bold text-sm tracking-wide py-3 px-8 rounded-xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.5)] hover:-translate-y-0.5 transition-all">
                {{ __('Save Changes') }}
            </button>
        </div>
    </form>

    @if (session('status') === 'profile-updated')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Profile Updated',
                    text: 'Your elite credentials have been successfully updated.',
                    background: 'rgba(11, 17, 32, 0.85)',
                    color: '#fff',
                    confirmButtonColor: '#ea580c',
                    customClass: { popup: 'border border-orange-500/20 rounded-2xl backdrop-blur-md' }
                });
            });
        </script>
    @endif
</section>

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

        document.getElementById("profileUpdateForm").addEventListener("submit", function() {
            input.value = iti.getNumber();
        });
    });
</script>