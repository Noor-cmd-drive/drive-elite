@extends('admin.layout')

@section('header_title', 'Reservations & Bookings')

@section('content')
    <div class="mb-8 flex flex-col lg:flex-row lg:justify-between lg:items-end gap-6">
        <div>
            <p class="text-gray-500 font-medium text-sm mb-1 text-uppercase tracking-wider">Fleet Logistics</p>
            <h3 class="text-3xl font-black text-gray-900 tracking-tight">Active Reservations</h3>
            <p class="text-gray-500 mt-2">Monitor, approve, and manage customer bookings in real-time.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></div>
                <span class="text-sm font-bold text-gray-700">{{ $bookings->where('status', 'Pending')->count() }} Pending</span>
            </div>
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                <span class="text-sm font-bold text-gray-700">{{ $bookings->where('status', 'Approved')->count() }} Active</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-widest">
                        <th class="p-6 font-bold text-center">ID</th>
                        <th class="p-6 font-bold">Client Information</th>
                        <th class="p-6 font-bold">Vehicle Assigned</th>
                        <th class="p-6 font-bold text-center">Booking Period</th>
                        <th class="p-6 font-bold">Total Revenue</th>
                        <th class="p-6 font-bold">Payment Info</th>
                        <th class="p-6 font-bold">Current Status</th>
                        <th class="p-6 font-bold text-right px-8">Quick Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50/50 transition duration-300 group">
                            <td class="p-6 text-center">
                                <span class="bg-gray-100 text-gray-500 text-[10px] font-black px-2 py-1 rounded-md uppercase tracking-tighter">
                                    #{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold group-hover:scale-110 transition duration-300">
                                        {{ substr($booking->user->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-900 leading-none mb-1">
                                            {{ $booking->user->name ?? 'Unknown' }}
                                        </p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                            {{ $booking->user->email ?? 'No Email' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <p class="font-bold text-gray-800 tracking-tight">
                                        {{ $booking->car->brand ?? 'N/A' }} 
                                        <span class="text-red-600 uppercase text-xs ml-1">{{ $booking->car->model_name ?? 'N/A' }}</span>
                                    </p>
                                </div>
                            </td>
                            
                            <td class="p-6 text-center">
                                <div class="inline-flex flex-col items-center">
                                    <span class="text-[11px] font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</span>
                                    <i class="fa-solid fa-arrow-down-long text-[10px] my-1 text-gray-300"></i>
                                    <span class="text-[11px] font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                </div>
                            </td>
                            
                            <td class="p-6">
                                <p class="text-lg font-black text-gray-900 tracking-tighter">Rs. {{ number_format($booking->total_price) }}</p>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">{{ $booking->total_days }} Days Plan</p>
                            </td>

                            <td class="p-6">
                                <p class="text-[11px] font-black uppercase text-[#0b1120] tracking-widest flex items-center gap-1.5">
                                    @if($booking->payment_method === 'jazzcash') <span class="text-red-600">JazzCash</span>
                                    @elseif($booking->payment_method === 'easypaisa') <span class="text-green-600">EasyPaisa</span>
                                    @elseif($booking->payment_method === 'bank') <span class="text-blue-600">Bank Transfer</span>
                                    @else <span class="text-gray-600">Pay at Pickup</span>
                                    @endif
                                </p>
                                @if($booking->transaction_id)
                                    <p class="text-[10px] text-gray-400 font-bold tracking-widest mt-1">TID: {{ $booking->transaction_id }}</p>
                                @endif
                                @if($booking->payment_proof)
                                    <button type="button" onclick="openReceiptModal('{{ asset('storage/' . $booking->payment_proof) }}')" class="mt-2 inline-flex items-center gap-1 text-[9px] bg-orange-50 hover:bg-orange-500 text-orange-600 hover:text-white font-black uppercase tracking-widest py-1.5 px-3 rounded-lg transition-all border border-orange-100 hover:border-orange-500 shadow-sm">
                                        <i class="fa-solid fa-image"></i> View Proof
                                    </button>
                                @endif
                            </td>
                            
                            <td class="p-6 text-sm">
                                @if($booking->status == 'Pending')
                                    <span class="flex items-center gap-1.5 text-yellow-600 font-black uppercase text-[10px] tracking-widest">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-ping"></span> Pending
                                    </span>
                                @elseif($booking->status == 'Approved')
                                    <span class="flex items-center gap-1.5 text-blue-600 font-black uppercase text-[10px] tracking-widest">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Confirmed
                                    </span>
                                @elseif($booking->status == 'Completed')
                                    <span class="flex items-center gap-1.5 text-green-600 font-black uppercase text-[10px] tracking-widest">
                                        <i class="fa-solid fa-check-circle"></i> Returned
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-gray-400 font-black uppercase text-[10px] tracking-widest">
                                        <i class="fa-solid fa-ban"></i> Cancelled
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-6 px-8 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition duration-300">
                                    
                                    <a href="{{ route('bookings.invoice', $booking->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition duration-300 shadow-sm border border-red-100" title="Download VIP Invoice">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>

                                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="inline-flex items-center gap-2 bg-gray-50 p-1 rounded-lg border border-gray-100">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="text-[9px] font-black uppercase border-none focus:ring-0 bg-transparent text-gray-600 cursor-pointer py-1">
                                            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approved" {{ $booking->status == 'Approved' ? 'selected' : '' }}>Approve</option>
                                            <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Returned</option>
                                            <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancel</option>
                                        </select>
                                        <button type="submit" class="bg-gray-900 text-white w-6 h-6 flex items-center justify-center rounded-md hover:bg-black transition shadow-sm">
                                            <i class="fa-solid fa-check text-[9px]"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this reservation?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white transition duration-300 shadow-sm border border-gray-100" title="Delete Booking">
                                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-24 text-center">
                                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-inner">
                                    <i class="fa-solid fa-calendar-minus text-4xl text-gray-200"></i>
                                </div>
                                <h4 class="text-xl font-black text-gray-900 mb-2">No Active Reservations</h4>
                                <p class="text-gray-400 max-w-xs mx-auto text-sm leading-relaxed">Your fleet is currently available. Bookings will appear here once customers start reserving vehicles.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="receiptModal" class="fixed inset-0 z-[999] hidden bg-[#0b1120]/90 backdrop-blur-md flex items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-3xl overflow-hidden max-w-md w-full shadow-2xl transform scale-95 transition-transform duration-300" id="receiptModalContent">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-black text-gray-900 uppercase tracking-widest text-xs flex items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass-dollar text-orange-500 text-lg"></i> Payment Verification
                </h3>
                <button onclick="closeReceiptModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 hover:bg-red-500 hover:text-white transition-colors shadow-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 bg-gray-100/50 flex justify-center items-center min-h-[300px] relative">
                <div id="loader" class="absolute inset-0 flex items-center justify-center">
                    <div class="w-8 h-8 border-4 border-orange-500 border-t-transparent rounded-full animate-spin"></div>
                </div>
                <img id="receiptImage" src="" alt="Payment Receipt" class="max-w-full max-h-[60vh] rounded-xl shadow-md object-contain relative z-10 hidden" onload="document.getElementById('loader').classList.add('hidden'); this.classList.remove('hidden');">
            </div>
            <div class="p-4 bg-white text-center border-t border-gray-100">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Drive Elite Security Check</p>
            </div>
        </div>
    </div>

    <script>
        function openReceiptModal(imageUrl) {
            const modal = document.getElementById('receiptModal');
            const modalContent = document.getElementById('receiptModalContent');
            const img = document.getElementById('receiptImage');
            const loader = document.getElementById('loader');
            
            img.classList.add('hidden');
            loader.classList.remove('hidden');
            img.src = imageUrl;
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeReceiptModal() {
            const modal = document.getElementById('receiptModal');
            const modalContent = document.getElementById('receiptModalContent');
            
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.getElementById('receiptImage').src = '';
            }, 300);
        }
    </script>
@endsection