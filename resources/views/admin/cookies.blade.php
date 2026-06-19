@extends('admin.layout')

@section('title', 'Cookie Privacy Consents')
@section('header_title', 'User Privacy Logs')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-4">
                        <table class="table align-items-center mb-0" style="border-spacing: 0 15px; border-collapse: separate;">
                            <thead>
                                <tr class="text-xs uppercase text-gray-500 font-bold border-b">
                                    <th class="py-3 px-4">IP Address</th>
                                    <th class="py-3 px-4">User Details</th>
                                    <th class="py-3 px-4 text-center">Status</th>
                                    <th class="py-3 px-4 text-center">Preferences</th>
                                    <th class="py-3 px-4">Date / Time</th>
                                    <th class="py-3 px-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($consents as $consent)
                                <tr class="bg-white border-b hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4 text-sm font-semibold text-gray-700">{{ $consent->ip_address }}</td>
                                    <td class="py-4 px-4 text-sm">
                                        @if($consent->user)
                                            <span class="text-blue-600 font-bold"><i class="fa-solid fa-user me-1"></i> {{ $consent->user->name }}</span>
                                        @else
                                            <span class="text-gray-500"><i class="fa-solid fa-user-secret me-1"></i> Guest</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                            {{ $consent->consent_status == 'accept_all' ? 'bg-green-100 text-green-700' : 
                                               ($consent->consent_status == 'reject_all' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                            {{ str_replace('_', ' ', $consent->consent_status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-center text-xs text-gray-500">
                                        {{ !empty($consent->preferences) ? 'Analytics: '.($consent->preferences['analytics'] ?? 'No').' | Marketing: '.($consent->preferences['marketing'] ?? 'No') : 'N/A' }}
                                    </td>
                                    <td class="py-4 px-4 text-xs text-gray-400">
                                        {{ $consent->updated_at->timezone('Asia/Karachi')->format('d M, Y | h:i A') }}
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <form action="{{ route('admin.cookies.destroy', $consent->id) }}" method="POST" onsubmit="return confirm('Delete this record? User will be asked for consent again.');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-10 text-gray-400">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection