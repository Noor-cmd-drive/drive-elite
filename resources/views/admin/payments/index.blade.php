@extends('admin.layout')

@section('header_title', 'Financial Intelligence')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        
        <div class="bg-gray-900 rounded-[2rem] p-8 text-white relative overflow-hidden shadow-2xl border border-gray-800 group hover:scale-[1.02] transition-transform duration-500">
            <div class="absolute -right-8 -top-8 w-40 h-40 bg-red-600 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center shadow-lg shadow-red-600/30">
                        <i class="fa-solid fa-wallet text-sm"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Total Realized Revenue</span>
                </div>
                <h4 class="text-4xl font-black tracking-tighter">Rs. {{ number_format($payments->where('status', 'Completed')->sum('total_price')) }}</h4>
                <div class="mt-6 flex items-center gap-2">
                    <span class="text-[10px] font-bold bg-green-500/20 text-green-400 px-2 py-1 rounded-md uppercase tracking-wider border border-green-500/20">Synced Live</span>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-[2rem] p-8 relative overflow-hidden shadow-xl border border-gray-100 group hover:scale-[1.02] transition-transform duration-500">
            <div class="absolute -right-8 -top-8 w-40 h-40 bg-blue-500 opacity-5 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center shadow-lg shadow-blue-500/30 text-white">
                        <i class="fa-solid fa-chart-line text-sm"></i>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Projected Earnings</span>
                </div>
                <h4 class="text-4xl font-black tracking-tighter text-gray-900">Rs. {{ number_format($payments->where('status', 'Approved')->sum('total_price')) }}</h4>
                <div class="mt-6 flex items-center gap-2">
                    <span class="text-[10px] font-bold bg-blue-50 text-blue-500 px-2 py-1 rounded-md uppercase tracking-wider border border-blue-100">Confirmed Bookings</span>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-gray-50 to-white rounded-[2rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center border-dashed border-2 group transition-all duration-300">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4 group-hover:bg-red-50 transition-colors">
                <i class="fa-solid fa-chart-pie text-2xl text-gray-300 group-hover:text-red-500 transition-colors"></i>
            </div>
            <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Growth Analytics</p>
            <p class="text-xs font-bold text-gray-400 mt-1 italic tracking-tight">Integrating Chart.js...</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden relative">
        <div class="p-8 border-b border-gray-50 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h4 class="font-black text-gray-900 text-xl tracking-tighter uppercase">Global Ledger</h4>
                <p class="text-xs text-gray-400 font-medium">Detailed financial transaction history for DriveElite.</p>
            </div>
            <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                <span class="text-[10px] font-black text-gray-600 uppercase tracking-widest leading-none">Live Sync Active</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="text-gray-400 text-[10px] font-black uppercase tracking-[0.15em] border-b border-gray-50">
                        <th class="p-8">Reference</th>
                        <th class="p-8">Customer</th>
                        <th class="p-8">Amount</th>
                        <th class="p-8">Status</th>
                        <th class="p-8 text-right">Settlement Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50/80 transition-all duration-300 group">
                            <td class="p-8">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-[10px] font-black text-gray-400 group-hover:bg-gray-900 group-hover:text-white transition-colors uppercase">
                                        TX
                                    </div>
                                    <span class="font-mono text-xs text-gray-400 uppercase font-bold tracking-tighter">ELITE-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </td>
                            <td class="p-8">
                                <p class="font-black text-gray-900 tracking-tighter leading-none">{{ $payment->customer_name }}</p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase mt-1 tracking-widest">Verified Client</p>
                            </td>
                            <td class="p-8">
                                <p class="text-lg font-black text-gray-900 tracking-tighter">Rs. {{ number_format($payment->total_price) }}</p>
                            </td>
                            <td class="p-8">
                                @if($payment->status == 'Completed')
                                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">
                                        <i class="fa-solid fa-circle-check"></i> Cleared
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                        <i class="fa-solid fa-spinner animate-spin"></i> Processing
                                    </span>
                                @endif
                            </td>
                            <td class="p-8 text-right font-bold text-gray-500 text-sm">
                                {{ $payment->updated_at->format('M d, Y') }}
                                <span class="block text-[10px] text-gray-300 uppercase mt-0.5">{{ $payment->updated_at->format('H:i A') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-32 text-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-inner">
                                    <i class="fa-solid fa-receipt text-3xl text-gray-200"></i>
                                </div>
                                <h4 class="text-xl font-black text-gray-900 mb-2 tracking-tighter">No Financial Activity</h4>
                                <p class="text-gray-400 max-w-xs mx-auto text-sm font-medium">Once a booking is approved or completed, the transaction ledger will populate automatically.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection