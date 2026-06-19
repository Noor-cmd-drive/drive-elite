@extends('admin.layout')

@section('header_title', 'Customer Intelligence')

@section('content')
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <h3 class="text-3xl font-black text-gray-900 tracking-tight">Registered Customers</h3>
            <p class="text-gray-500 mt-2 font-medium">Analyze and manage your DriveElite user base and their engagement.</p>
        </div>
        <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-1">Total Audience</p>
            <p class="text-2xl font-black text-red-600">{{ $customers->count() }} <span class="text-xs font-bold text-gray-400 tracking-normal">Verified Users</span></p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                        <th class="p-6">Member Details</th>
                        <th class="p-6">Join Date</th>
                        <th class="p-6">Security Status</th>
                        <th class="p-6 text-right px-10">Administrative Control</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-gray-50/50 transition duration-300 group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-500 font-black shadow-inner group-hover:from-red-500 group-hover:to-red-600 group-hover:text-white transition-all duration-500">
                                        {{ substr($customer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-gray-900 leading-none mb-1 text-lg tracking-tighter">{{ $customer->name }}</p>
                                        <p class="text-sm text-gray-400 font-medium tracking-tight">{{ $customer->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <p class="text-sm font-bold text-gray-700">{{ $customer->created_at->format('M d, Y') }}</p>
                                <p class="text-[10px] text-gray-400 font-black uppercase mt-1 tracking-widest">Enrolled</p>
                            </td>
                            <td class="p-6">
                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Active User
                                </span>
                            </td>
                            <td class="p-6 text-right px-10">
                                <div class="flex items-center justify-end gap-3">
                                    <form action="{{ route('users.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('WARNING: This action will permanently remove the customer. Continue?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-white border border-gray-200 text-gray-400 hover:text-red-600 hover:border-red-100 hover:bg-red-50 p-2.5 rounded-xl transition duration-300 shadow-sm">
                                            <i class="fa-solid fa-user-slash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-24 text-center">
                                <i class="fa-solid fa-users-slash text-5xl text-gray-200 mb-6"></i>
                                <h4 class="text-xl font-black text-gray-900">Audience is Quiet</h4>
                                <p class="text-gray-400 text-sm mt-2">No customers have registered on the platform yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection