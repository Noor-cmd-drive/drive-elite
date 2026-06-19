@extends('admin.layout')

@section('header_title', 'System Settings')

@section('content')
<div class="max-w-4xl mx-auto pb-10">
    <div class="mb-8">
        <p class="text-gray-500 font-medium text-sm mb-1 text-uppercase tracking-wider">Configuration</p>
        <h3 class="text-3xl font-black text-gray-900 tracking-tight">System Settings</h3>
        <p class="text-gray-500 mt-2">Update your company info, payment methods, and social presence across the platform.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm space-y-12">
        @csrf
        
        <div>
            <h4 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-2"><i class="fa-solid fa-file-invoice mr-2 text-red-600"></i> Invoice & Company Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Company Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-solid fa-building text-gray-400"></i></div>
                        <input type="text" name="company_name" value="{{ $settings['company_name'] ?? '' }}" placeholder="e.g. DriveElite Rentals" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Official Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-solid fa-phone text-gray-400"></i></div>
                        <input type="text" name="company_phone" value="{{ $settings['company_phone'] ?? '' }}" placeholder="e.g. +92 300 1234567" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Billing Support Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-solid fa-envelope text-gray-400"></i></div>
                        <input type="email" name="company_email" value="{{ $settings['company_email'] ?? '' }}" placeholder="e.g. billing@driveelite.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Complete Official Address</label>
                    <div class="relative">
                        <div class="absolute top-5 left-0 pl-4 pointer-events-none"><i class="fa-solid fa-map-location-dot text-gray-400"></i></div>
                        <textarea name="company_address" rows="3" placeholder="Enter your full office address here..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none resize-none">{{ $settings['company_address'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="md:col-span-2 bg-red-50 p-6 rounded-2xl border border-red-100">
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-800 mb-1">Google Location Link (Map Embed URL)</label>
                    <p class="text-[10px] text-gray-500 mb-3 font-medium">Paste your exact Google Maps URL here. This will only be displayed on the Contact Us page.</p>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-solid fa-map-pin text-red-400"></i></div>
                        <input type="text" name="google_map_link" value="{{ $settings['google_map_link'] ?? '' }}" placeholder="e.g. https://www.google.com/maps/embed?pb=..." class="w-full bg-white border border-red-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none shadow-sm">
                    </div>
                </div>

            </div>
        </div>

        <div>
            <h4 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-2"><i class="fa-solid fa-credit-card mr-2 text-red-600"></i> Payment Gateway Configuration</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 space-y-4 shadow-sm">
                    <div class="flex items-center gap-3 mb-4 border-b border-gray-200 pb-3">
                        <div class="flex items-center justify-center bg-black text-white px-3 py-1.5 rounded-lg border-l-4 border-red-600 shadow-sm">
                            <span class="font-black italic text-[12px] tracking-tight">Jazz<span class="text-red-600">Cash</span></span>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Account</span>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">JazzCash Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-solid fa-mobile-screen text-gray-400"></i></div>
                            <input type="text" name="jazzcash_number" value="{{ $settings['jazzcash_number'] ?? '' }}" placeholder="0346 7369941" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-red-600 outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">Account Title</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-regular fa-user text-gray-400"></i></div>
                            <input type="text" name="jazzcash_name" value="{{ $settings['jazzcash_name'] ?? '' }}" placeholder="Abdul Hadi" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-red-600 outline-none">
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 space-y-4 shadow-sm">
                    <div class="flex items-center gap-3 mb-4 border-b border-gray-200 pb-3">
                        <div class="flex items-center justify-center bg-[#00c853] text-white px-3 py-1.5 rounded-lg shadow-sm">
                            <span class="font-black italic text-[12px] tracking-tight">easypaisa</span>
                        </div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">Account</span>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">EasyPaisa Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-solid fa-mobile-screen text-gray-400"></i></div>
                            <input type="text" name="easypaisa_number" value="{{ $settings['easypaisa_number'] ?? '' }}" placeholder="0346 7369941" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#00c853] outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">Account Title</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="fa-regular fa-user text-gray-400"></i></div>
                            <input type="text" name="easypaisa_name" value="{{ $settings['easypaisa_name'] ?? '' }}" placeholder="Abdul Hadi" class="w-full bg-white border border-gray-200 rounded-xl py-3 pl-10 pr-4 text-sm focus:ring-2 focus:ring-[#00c853] outline-none">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 p-6 bg-gray-50 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-4 border-b border-gray-200 pb-3">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white"><i class="fa-solid fa-building-columns text-sm"></i></div>
                        <span class="text-[12px] font-black uppercase tracking-widest text-blue-600">Official Bank Account Details</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">Bank Name</label>
                            <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}" placeholder="e.g. National Bank (NBP)" class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">IBAN / Account Number</label>
                            <input type="text" name="bank_iban" value="{{ $settings['bank_iban'] ?? '' }}" placeholder="e.g. PK75 NBP 0001..." class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-1 ml-1">Account Title</label>
                            <input type="text" name="bank_title" value="{{ $settings['bank_title'] ?? '' }}" placeholder="e.g. Drive Elite PVT" class="w-full bg-white border border-gray-200 rounded-xl py-3 px-4 text-sm focus:ring-2 focus:ring-blue-600 outline-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h4 class="text-lg font-bold text-gray-900 mb-6 border-b border-gray-100 pb-2"><i class="fa-solid fa-share-nodes mr-2 text-red-600"></i> Social Media Presence</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Facebook URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-facebook text-blue-600"></i></div>
                        <input type="text" name="facebook_link" value="{{ $settings['facebook_link'] ?? '' }}" placeholder="https://facebook.com/driveelite" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">Instagram URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-instagram text-pink-600"></i></div>
                        <input type="text" name="instagram_link" value="{{ $settings['instagram_link'] ?? '' }}" placeholder="https://instagram.com/driveelite" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">X (Twitter) URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-x-twitter text-gray-900"></i></div>
                        <input type="text" name="twitter_link" value="{{ $settings['twitter_link'] ?? '' }}" placeholder="https://x.com/driveelite" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">LinkedIn URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-linkedin text-blue-700"></i></div>
                        <input type="text" name="linkedin_link" value="{{ $settings['linkedin_link'] ?? '' }}" placeholder="https://linkedin.com/company/driveelite" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">WhatsApp URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-whatsapp text-green-500 text-lg"></i></div>
                        <input type="text" name="whatsapp_link" value="{{ $settings['whatsapp_link'] ?? '' }}" placeholder="https://wa.me/923001234567" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black uppercase tracking-widest text-gray-500 mb-2">YouTube Channel URL</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"><i class="fa-brands fa-youtube text-red-600 text-sm"></i></div>
                        <input type="text" name="youtube_link" value="{{ $settings['youtube_link'] ?? '' }}" placeholder="https://youtube.com/@driveelite" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 pl-12 pr-6 text-gray-900 font-medium focus:ring-2 focus:ring-red-600 outline-none">
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-xl font-black uppercase tracking-widest text-sm hover:bg-red-700 transition shadow-lg shadow-red-600/20 flex items-center gap-2">
                <i class="fa-solid fa-save"></i> Save All Settings
            </button>
        </div>
    </form>
</div>
@endsection