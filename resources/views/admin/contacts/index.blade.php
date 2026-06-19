@extends('admin.layout')

@section('header_title', 'Customer Inquiries')

@section('content')
    <div class="mb-8 flex flex-col lg:flex-row lg:justify-between lg:items-end gap-6">
        <div>
            <p class="text-gray-500 font-medium text-sm mb-1 text-uppercase tracking-wider">Communication Hub</p>
            <h3 class="text-3xl font-black text-gray-900 tracking-tight">Support Messages</h3>
            <p class="text-gray-500 mt-2">Manage inquiries and feedback from your premium clients.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></div>
                <span class="text-sm font-bold text-gray-700">{{ $messages->where('status', 'unread')->count() }} New Messages</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-widest">
                        <th class="p-6 font-bold text-center">Status</th>
                        <th class="p-6 font-bold">Sender Info</th>
                        <th class="p-6 font-bold">Subject</th>
                        <th class="p-6 font-bold text-center">Received Date</th>
                        <th class="p-6 font-bold text-right px-8">Quick Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-gray-50/50 transition duration-300 group {{ $msg->status == 'unread' ? 'bg-orange-50/30' : '' }}">
                            <td class="p-6 text-center">
                                @if($msg->status == 'unread')
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-600 shadow-sm" title="New Message">
                                        <i class="fa-solid fa-envelope-circle-check animate-bounce"></i>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-400" title="Read">
                                        <i class="fa-solid fa-envelope-open"></i>
                                    </span>
                                @endif
                            </td>
                            
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center text-white font-bold group-hover:scale-110 transition duration-300">
                                        {{ substr($msg->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-900 leading-none mb-1">{{ $msg->name }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $msg->email }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="p-6">
                                <p class="font-bold text-gray-800 tracking-tight max-w-xs truncate">
                                    {{ $msg->subject ?? 'General Inquiry' }}
                                </p>
                            </td>
                            
                            <td class="p-6 text-center">
                                <span class="text-[11px] font-bold text-gray-500 uppercase italic">
                                    {{ $msg->created_at->format('M d, Y') }} <br>
                                    <small class="text-[9px] text-gray-400">{{ $msg->created_at->diffForHumans() }}</small>
                                </span>
                            </td>

                            <td class="p-6 px-8 text-right">
                                <div class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition duration-300">
                                    <button onclick="openMessageModal('{{ addslashes($msg->name) }}', '{{ addslashes($msg->email) }}', '{{ $msg->phone ?? 'N/A' }}', '{{ addslashes($msg->subject ?? 'No Subject') }}', '{{ addslashes($msg->message) }}', '{{ route('contacts.update', $msg->id) }}', '{{ $msg->status }}')" 
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-600 hover:text-white transition duration-300 shadow-sm border border-orange-100" 
                                            title="Read Message">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <form action="{{ route('contacts.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition duration-300 shadow-sm border border-red-100" title="Delete Message">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-24 text-center">
                                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-inner">
                                    <i class="fa-solid fa-comment-slash text-4xl text-gray-200"></i>
                                </div>
                                <h4 class="text-xl font-black text-gray-900 mb-2">Inbox is Empty</h4>
                                <p class="text-gray-400 max-w-xs mx-auto text-sm leading-relaxed">No customer messages found. Inquiries from the Contact Us page will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="msgModal" class="fixed inset-0 z-[999] hidden bg-[#0b1120]/90 backdrop-blur-md flex items-center justify-center p-4 transition-opacity duration-300 opacity-0">
        <div class="bg-white rounded-3xl overflow-hidden max-w-xl w-full shadow-2xl transform scale-95 transition-transform duration-300" id="msgModalContent">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/80">
                <div>
                    <h3 id="modalSubject" class="font-black text-gray-900 uppercase tracking-tighter text-lg mb-0.5 italic"></h3>
                    <p id="modalSender" class="text-[10px] text-orange-500 font-bold uppercase tracking-[0.2em]"></p>
                </div>
                <button onclick="closeMessageModal()" class="w-10 h-10 flex items-center justify-center rounded-full bg-white text-gray-400 hover:text-red-500 transition-colors shadow-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Email Address</p>
                        <p id="modalEmail" class="text-xs font-bold text-gray-900"></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase mb-1">Phone Number</p>
                        <p id="modalPhone" class="text-xs font-bold text-gray-900"></p>
                    </div>
                </div>
                
                <div class="bg-orange-50/30 p-6 rounded-[2rem] border border-orange-100/50">
                    <p class="text-[9px] font-black text-orange-500 uppercase mb-3 tracking-widest">Message Content</p>
                    <p id="modalBody" class="text-sm text-gray-700 leading-relaxed italic"></p>
                </div>
            </div>

            <div class="p-4 bg-gray-50 text-center border-t border-gray-100">
                <form id="markReadForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" id="readBtn" class="bg-gray-900 text-white px-8 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-lg shadow-gray-900/20">
                        Mark as Read & Close
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openMessageModal(name, email, phone, subject, message, updateUrl, status) {
            document.getElementById('modalSubject').innerText = subject;
            document.getElementById('modalSender').innerText = 'From: ' + name;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalPhone').innerText = phone;
            document.getElementById('modalBody').innerText = '"' + message + '"';
            
            const form = document.getElementById('markReadForm');
            form.action = updateUrl;

            // Agar pehle se read hai to button hide kar do
            document.getElementById('readBtn').style.display = (status === 'read') ? 'none' : 'inline-block';

            const modal = document.getElementById('msgModal');
            const content = document.getElementById('msgModalContent');
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeMessageModal() {
            const modal = document.getElementById('msgModal');
            const content = document.getElementById('msgModalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
    </script>
@endsection