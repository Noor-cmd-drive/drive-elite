@extends('admin.layout')

@section('header_title', 'Marketing Intelligence')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tight italic uppercase">Newsletter Hub</h3>
            <p class="text-gray-500 mt-2 font-medium">Manage your subscription base and orchestrate marketing campaigns.</p>
        </div>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('newsletters.export') }}" class="bg-white border border-gray-200 text-gray-700 px-5 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm flex items-center gap-2 group">
                <i class="fa-solid fa-file-csv text-blue-500 text-lg group-hover:scale-110 transition-transform"></i> 
                Export CSV
            </a>

            <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Active Subscribers</p>
                <p class="text-2xl font-black text-blue-600">{{ $subscribers->total() }} <span class="text-xs font-bold text-gray-400 tracking-normal">Emails Collected</span></p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="p-6">Subscriber Details</th>
                        <th class="p-6">Subscription Date</th>
                        <th class="p-6">Source Status</th>
                        <th class="p-6 text-right px-10">Administrative Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50/50 transition duration-300 group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-500 font-black shadow-inner group-hover:from-blue-600 group-hover:to-blue-700 group-hover:text-white transition-all duration-500">
                                        <i class="fa-solid fa-envelope-open-text text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-900 leading-none mb-1 text-lg tracking-tighter">{{ $subscriber->email }}</p>
                                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Verified Channel</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <p class="text-sm font-bold text-gray-700">{{ $subscriber->created_at->format('M d, Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-black uppercase mt-1 tracking-widest">{{ $subscriber->created_at->format('h:i A') }}</p>
                            </td>
                            <td class="p-6">
                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Receiving Updates
                                </span>
                            </td>
                            <td class="p-6 text-right px-10">
                                <div class="flex items-center justify-end gap-3">
                                    <form action="{{ route('newsletters.destroy', $subscriber->id) }}" method="POST" onsubmit="return confirm('WARNING: Permanently remove this subscriber from the mailing list?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-white border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-100 hover:bg-red-50 p-2.5 rounded-xl transition duration-300 shadow-sm group/btn">
                                            <i class="fa-solid fa-trash-can text-sm transition-transform group-hover/btn:scale-110"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-24 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-6 border border-gray-100 shadow-inner">
                                    <i class="fa-solid fa-envelopes-bulk text-3xl text-gray-200"></i>
                                </div>
                                <h4 class="text-xl font-black text-gray-900">No Subscribers Yet</h4>
                                <p class="text-gray-400 text-sm mt-2 max-w-xs mx-auto">Your newsletter list is currently empty. Subscriptions from the website footer will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($subscribers->hasPages())
            <div class="p-6 border-t border-gray-50 bg-gray-50/30">
                {{ $subscribers->links() }}
            </div>
        @endif
    </div>
@endsection