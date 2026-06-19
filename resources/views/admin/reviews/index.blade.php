@extends('admin.layout')

@section('header_title', 'Elite Reflections')

@section('content')
    <div class="mb-8 flex flex-col lg:flex-row lg:justify-between lg:items-end gap-6">
        <div>
            <p class="text-gray-500 font-medium text-sm mb-1 uppercase tracking-widest text-orange-500">Social Proof</p>
            <h3 class="text-3xl font-black text-gray-900 tracking-tight italic uppercase">Customer Reflections</h3>
            <p class="text-gray-500 mt-2 text-sm">Review and moderate feedback before it goes live on the premier landing page.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></div>
                <span class="text-sm font-bold text-gray-700">{{ $reviews->where('is_published', false)->count() }} Pending Approval</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] uppercase tracking-[0.2em]">
                        <th class="p-6 font-black text-center">Status</th>
                        <th class="p-6 font-black">Client</th>
                        <th class="p-6 font-black">Rating</th>
                        <th class="p-6 font-black">Reflection / Comment</th>
                        <th class="p-6 font-black text-right px-8">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($reviews as $rev)
                        <tr class="hover:bg-gray-50/50 transition duration-300 group {{ !$rev->is_published ? 'bg-orange-50/20' : '' }}">
                            <td class="p-6 text-center">
                                @if($rev->is_published)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-green-100 text-green-600 text-[9px] font-black uppercase tracking-widest">
                                        <i class="fa-solid fa-circle-check"></i> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-orange-100 text-orange-600 text-[9px] font-black uppercase tracking-widest animate-pulse">
                                        <i class="fa-solid fa-clock"></i> Pending
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#0b1120] flex items-center justify-center text-white font-black text-xs uppercase shadow-lg">
                                        {{ substr($rev->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-900 leading-none mb-1 uppercase text-xs italic">{{ $rev->user->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $rev->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-6 text-orange-500">
                                <div class="flex gap-0.5">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="fa-{{ $i <= $rev->rating ? 'solid' : 'regular' }} fa-star text-[10px]"></i>
                                    @endfor
                                </div>
                            </td>
                            
                            <td class="p-6">
                                <p class="text-xs font-medium text-gray-600 tracking-tight italic max-w-xs truncate group-hover:whitespace-normal transition-all duration-500">
                                    "{{ $rev->comment }}"
                                </p>
                            </td>

                            <td class="p-6 px-8 text-right">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition duration-300">
                                    
                                    @if(!$rev->is_published)
                                        <form action="{{ route('reviews.update', $rev->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-orange-500 text-white hover:bg-orange-600 transition duration-300 shadow-lg shadow-orange-500/20 text-[10px] font-black uppercase tracking-widest">
                                                <i class="fa-solid fa-paper-plane"></i> Approve
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('reviews.destroy', $rev->id) }}" method="POST" onsubmit="return confirm('Archive this reflection permanently?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition duration-300 flex items-center justify-center border border-red-100">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-24 text-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-gray-100">
                                    <i class="fa-solid fa-comment-slash text-3xl text-gray-200"></i>
                                </div>
                                <h4 class="text-lg font-black text-gray-900 mb-1 italic uppercase">Silence on the Roads</h4>
                                <p class="text-gray-400 max-w-xs mx-auto text-xs font-medium">No customer reflections found. New feedback will appear here for your approval.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection