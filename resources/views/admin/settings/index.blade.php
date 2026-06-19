@extends('admin.layout')

@section('header_title', 'System Configuration')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-gray-900">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100">
                    <h4 class="text-xl font-black text-gray-900 mb-8 uppercase tracking-tighter italic border-l-4 border-red-600 pl-4">Business Identity</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Platform Name</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'DriveElite' }}" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-red-500 focus:border-red-500 font-bold p-4 text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Official Email</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'info@driveelite.com' }}" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-red-500 focus:border-red-500 font-bold p-4 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Headquarters Address</label>
                            <input type="text" name="address" value="{{ $settings['address'] ?? 'Sargodha, Punjab, Pakistan' }}" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-red-500 focus:border-red-500 font-bold p-4 text-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100">
                    <h4 class="text-xl font-black text-gray-900 mb-8 uppercase tracking-tighter italic border-l-4 border-red-600 pl-4">Contact & Social Presence</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-500 shadow-sm border border-green-100 group-hover:bg-green-500 group-hover:text-white transition-all duration-300">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">WhatsApp Business</label>
                                <input type="text" name="whatsapp" value="{{ $settings['whatsapp'] ?? '+92 300 1234567' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-pink-500 shadow-sm border border-pink-100 group-hover:bg-gradient-to-tr group-hover:from-yellow-400 group-hover:via-red-500 group-hover:to-purple-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-brands fa-instagram text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Instagram Profile</label>
                                <input type="text" name="instagram" value="{{ $settings['instagram'] ?? '#' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shadow-sm border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-brands fa-facebook-f text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Facebook Page</label>
                                <input type="text" name="facebook" value="{{ $settings['facebook'] ?? '#' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-900 shadow-sm border border-gray-200 group-hover:bg-black group-hover:text-white transition-all duration-300">
                                <i class="fa-brands fa-tiktok text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">TikTok Channel</label>
                                <input type="text" name="tiktok" value="{{ $settings['tiktok'] ?? '#' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 shadow-sm border border-red-100 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-brands fa-youtube text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">YouTube Channel</label>
                                <input type="text" name="youtube" value="{{ $settings['youtube'] ?? '#' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>

                        <div class="flex items-center gap-4 group">
                            <div class="w-14 h-14 rounded-2xl bg-yellow-50 flex items-center justify-center text-yellow-600 shadow-sm border border-yellow-100 group-hover:bg-yellow-500 group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-location-dot text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Google Maps Location Link</label>
                                <input type="text" name="map_link" value="{{ $settings['map_link'] ?? '#' }}" class="w-full rounded-xl border-transparent bg-gray-50 font-bold p-3 text-xs focus:bg-white focus:border-gray-200 focus:ring-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gray-900 rounded-[2.5rem] p-10 text-white sticky top-24 shadow-2xl border border-gray-800">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-red-500/10 flex items-center justify-center text-red-500">
                            <i class="fa-solid fa-shield-halved text-2xl"></i>
                        </div>
                        <h4 class="text-2xl font-black tracking-tight">Save Changes</h4>
                    </div>
                    
                    <p class="text-gray-400 text-sm mb-10 leading-relaxed font-medium">Update your global system configurations. These modifications will synchronize with the frontend landing page instantly.</p>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-5 rounded-2xl font-black uppercase tracking-[0.2em] transition-all duration-300 shadow-lg shadow-red-600/30 transform hover:-translate-y-1 active:scale-95 text-xs">
                        Update System
                    </button>
                    
                    <div class="mt-10 pt-10 border-t border-gray-800 flex items-center justify-between opacity-50">
                        <span class="text-[10px] font-black uppercase tracking-widest">DriveElite v1.0</span>
                        <div class="flex gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection