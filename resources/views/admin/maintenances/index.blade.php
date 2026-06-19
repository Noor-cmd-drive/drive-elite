@extends('admin.layout')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter">Maintenance <span class="text-red-600">Logs</span></h2>
            <p class="text-gray-500 font-medium text-sm mt-1">Track and manage vehicle service history.</p>
        </div>
        <a href="{{ route('maintenances.create') }}" class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-red-700 transition shadow-lg shadow-red-600/20">
            <i class="fa-solid fa-plus mr-2"></i> Add Record
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-[10px] uppercase tracking-[0.2em] border-b border-gray-200">
                    <th class="p-6 font-bold">Vehicle</th>
                    <th class="p-6 font-bold">Service Type</th>
                    <th class="p-6 font-bold">Cost</th>
                    <th class="p-6 font-bold">Service Date</th>
                    <th class="p-6 font-bold">Next Service</th>
                    <th class="p-6 font-bold text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($maintenances as $log)
                <tr class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors">
                    <td class="p-6">
                        <span class="font-black text-gray-900">{{ $log->car->brand }}</span> 
                        <span class="text-gray-500 text-xs ml-1">{{ $log->car->model_name }}</span>
                    </td>
                    <td class="p-6 font-bold text-red-600 uppercase text-xs">{{ $log->service_type }}</td>
                    <td class="p-6 font-black text-gray-900">Rs. {{ number_format($log->cost) }}</td>
                    <td class="p-6 text-sm font-medium">{{ $log->service_date }}</td>
                    <td class="p-6">
                        <span class="bg-gray-100 px-3 py-1 rounded-full text-[10px] font-bold text-gray-500 border border-gray-200">
                            {{ $log->next_service_date ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="p-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('maintenances.edit', $log->id) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition-colors border border-gray-200">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>

                            <form action="{{ route('maintenances.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-lg bg-gray-50 text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors border border-gray-200">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection