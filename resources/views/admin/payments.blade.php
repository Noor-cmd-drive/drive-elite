@extends('admin.layout')

@section('header_title', 'Financial Dashboard')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">Payments & <span class="text-green-600">Revenue</span></h2>
            <p class="text-gray-500 font-medium text-sm mt-1">Monitor your financial performance and transaction history.</p>
        </div>
        {{-- 🚀 UPDATED: Export Link pointing to the new route --}}
        <a href="{{ route('admin.payments.export') }}" class="bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm flex items-center gap-2 group">
            <i class="fa-solid fa-file-excel text-green-500 text-lg group-hover:scale-110 transition-transform"></i> 
            Export Excel Ledger
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between group hover:shadow-md transition duration-300">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Total Revenue</p>
                <h3 class="text-3xl font-black text-gray-900">Rs. {{ number_format($totalRevenue) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-xl group-hover:rotate-12 transition-transform duration-300">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between group hover:shadow-md transition duration-300">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Pending Clearance</p>
                <h3 class="text-3xl font-black text-orange-600">Rs. {{ number_format($pendingClearance) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl group-hover:rotate-12 transition-transform duration-300">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center justify-between group hover:shadow-md transition duration-300">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Completed Transactions</p>
                <h3 class="text-3xl font-black text-blue-600">{{ number_format($completedTransactions) }}</h3>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:rotate-12 transition-transform duration-300">
                <i class="fa-solid fa-money-bill-transfer"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h3 class="font-black text-gray-900 uppercase tracking-tight">Recent Transactions</h3>
            <i class="fa-solid fa-bars-staggered text-gray-400"></i>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="p-6">Transaction Ref</th>
                        <th class="p-6">Client Info</th>
                        <th class="p-6">Amount</th>
                        <th class="p-6">Status</th>
                        <th class="p-6 text-right px-10">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentTransactions as $transaction)
                        <tr class="hover:bg-gray-50/30 transition duration-200">
                            <td class="p-6 font-bold text-gray-900">
                                #BKG-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="p-6">
                                <p class="font-bold text-gray-900">{{ $transaction->user->name ?? 'Guest User' }}</p>
                                <p class="text-xs text-gray-500">{{ $transaction->user->email ?? 'N/A' }}</p>
                            </td>
                            <td class="p-6 font-black text-gray-900">
                                Rs. {{ number_format($transaction->total_price) }}
                            </td>
                            <td class="p-6">
                                @if($transaction->status == 'Completed')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">Completed</span>
                                @elseif($transaction->status == 'Pending')
                                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">Pending</span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider">{{ $transaction->status }}</span>
                                @endif
                            </td>
                            <td class="p-6 text-right px-10">
                                {{-- 🚀 UPDATED: Delete Button with Form --}}
                                <form action="{{ route('bookings.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Hadi bhai, are you sure you want to delete this financial record?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2">
                                        <i class="fa-solid fa-trash-can text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-24 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-6 border border-gray-100 shadow-inner">
                                    <i class="fa-solid fa-receipt text-3xl text-gray-200"></i>
                                </div>
                                <h4 class="text-xl font-black text-gray-900">No Transactions Yet</h4>
                                <p class="text-gray-400 text-sm mt-2 max-w-xs mx-auto">Your financial records are currently empty. Completed booking payments will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection