@extends('admin.layout')

@section('header_title', 'Fleet Management')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <p class="text-gray-500 font-medium text-sm">Monitor and manage all vehicles in your DriveElite fleet.</p>
        </div>
        <a href="{{ route('cars.create') }}" class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition duration-300 shadow-lg shadow-red-500/30 flex items-center group">
            <i class="fa-solid fa-plus mr-2 group-hover:rotate-90 transition duration-300"></i> Add New Vehicle
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-widest">
                        <th class="p-5 font-bold">Vehicle</th>
                        <th class="p-5 font-bold">Details & Location</th>
                        <th class="p-5 font-bold">Category</th>
                        <th class="p-5 font-bold">Rent/Day</th>
                        <th class="p-5 font-bold">Status</th>
                        <th class="p-5 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($cars as $car)
                        <tr class="hover:bg-gray-50/80 transition duration-200 group">
                            <td class="p-5">
                                <div class="relative w-20 h-14 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="p-5">
                                <p class="font-black text-gray-900 text-base">{{ $car->brand }} {{ $car->model_name }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <p class="text-xs text-gray-500 font-medium"><i class="fa-regular fa-calendar mr-1"></i> {{ $car->year }} <span class="mx-1">•</span> <i class="fa-solid fa-gear mr-1"></i> {{ $car->transmission }}</p>
                                    <span class="bg-blue-50 text-blue-600 text-[9px] font-bold px-2 py-0.5 rounded border border-blue-100 uppercase tracking-widest ml-2">
                                        <i class="fa-solid fa-location-dot mr-1"></i> {{ $car->city ?? 'Global' }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-5">
                                <span class="bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1.5 rounded-md border border-gray-200">{{ $car->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td class="p-5">
                                <p class="font-bold text-gray-900">Rs. {{ number_format($car->daily_rent) }}</p>
                            </td>
                            <td class="p-5">
                                @if($car->is_available)
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-50 text-green-600 border border-green-200">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5 animate-pulse"></div> Available
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 text-red-600 border border-red-200">
                                        <div class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></div> Rented
                                    </div>
                                @endif
                            </td>
                            <td class="p-5 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition duration-300">
                                    <a href="{{ route('cars.edit', $car->id) }}" class="text-gray-400 hover:text-blue-600 transition duration-200 p-2 bg-white rounded-lg shadow-sm border border-gray-100">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirm deletion of this vehicle?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition duration-200 p-2 bg-white rounded-lg shadow-sm border border-gray-100">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-16 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-4 border border-gray-100 shadow-inner">
                                    <i class="fa-solid fa-car-side text-3xl text-gray-300"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Your fleet is empty</h3>
                                <p class="text-sm text-gray-500 max-w-sm mx-auto">You haven't added any vehicles yet. Please ensure you have created categories before adding a vehicle.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection