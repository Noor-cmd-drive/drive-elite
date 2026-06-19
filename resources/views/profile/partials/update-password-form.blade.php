<section>
    <header>
        <h2 class="text-xl font-poppins font-black text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400 font-inter">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password" class="w-full sm:w-3/4 bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password" class="w-full sm:w-3/4 bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div>
            <label class="block text-[11px] font-bold text-gray-300 uppercase tracking-widest mb-1.5 ml-1">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full sm:w-3/4 bg-[#0b1120]/50 border border-white/10 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all font-inter text-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500 text-xs font-bold" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-white/10">
            <button type="submit" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white font-poppins font-bold text-sm tracking-wide py-3 px-8 rounded-xl shadow-[0_10px_20px_rgba(249,115,22,0.3)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.5)] hover:-translate-y-0.5 transition-all">
                {{ __('Save Password') }}
            </button>
        </div>
    </form>

    @if (session('status') === 'password-updated')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Password Secured',
                    text: 'Your account password has been successfully updated.',
                    background: 'rgba(11, 17, 32, 0.85)',
                    color: '#fff',
                    confirmButtonColor: '#ea580c',
                    customClass: { popup: 'border border-orange-500/20 rounded-2xl backdrop-blur-md' }
                });
            });
        </script>
    @endif

    @if($errors->updatePassword->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: "{{ $errors->updatePassword->first() }}",
                    background: 'rgba(11, 17, 32, 0.85)',
                    color: '#fff',
                    confirmButtonColor: '#dc2626',
                    customClass: { popup: 'border border-red-500/20 rounded-2xl backdrop-blur-md' }
                });
            });
        </script>
    @endif
</section>