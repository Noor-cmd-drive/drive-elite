<section class="space-y-6">
    <header>
        <h2 class="text-xl font-poppins font-black text-red-500">
            {{ __('Danger Zone: Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-400 font-inter">
            {{ __('Once your account is deleted, all resources and data will be permanently wiped. Proceed with extreme caution.') }}
        </p>
    </header>

    <button type="button" onclick="confirmDelete()" class="bg-red-500/10 text-red-500 border border-red-500/20 font-poppins font-bold text-sm tracking-wide py-3 px-8 rounded-xl hover:bg-red-600 hover:text-white hover:border-red-600 hover:shadow-[0_0_30px_rgba(220,38,38,0.4)] transition-all">
        {{ __('Initiate Account Deletion') }}
    </button>

    <script>
        function confirmDelete() {
            Swal.fire({
                html: `
                    <div class="text-center">
                        <div class="w-16 h-16 rounded-full bg-red-500/10 mx-auto flex items-center justify-center text-red-500 text-3xl mb-4 shadow-[0_0_30px_rgba(220,38,38,0.3)]">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h2 class="text-2xl font-poppins font-black text-white mb-2">Confirm Deletion</h2>
                        <p class="text-gray-400 text-sm font-inter mb-6">Please enter your password to confirm you would like to permanently delete your account.</p>
                        
                        <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                            <input type="password" name="password" required placeholder="Enter your password" class="w-full bg-[#0b1120]/80 border border-red-500/30 text-white placeholder-gray-500 rounded-xl py-3 px-4 focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none transition-all font-inter text-sm" autocomplete="current-password">
                        </form>
                    </div>
                `,
                background: 'rgba(11, 17, 32, 0.95)',
                backdrop: `rgba(0,0,0,0.85) backdrop-filter: blur(10px)`,
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#374151',
                confirmButtonText: 'Permanently Delete',
                cancelButtonText: 'Cancel',
                customClass: { popup: 'border border-red-500/30 rounded-3xl' },
                preConfirm: () => {
                    const form = document.getElementById('delete-account-form');
                    if (!form.password.value) {
                        Swal.showValidationMessage('Password is required to proceed.');
                        return false;
                    }
                    form.submit();
                }
            });
        }
    </script>

    @if($errors->userDeletion->has('password'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Action Denied',
                    text: 'The password you entered is incorrect. Account deletion aborted.',
                    background: 'rgba(11, 17, 32, 0.85)',
                    color: '#fff',
                    confirmButtonColor: '#dc2626',
                    customClass: { popup: 'border border-red-500/20 rounded-2xl backdrop-blur-md' }
                });
            });
        </script>
    @endif
</section>