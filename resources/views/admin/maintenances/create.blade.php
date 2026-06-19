@extends('admin.layout')

@section('content')
<div class="p-6 max-w-4xl">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tighter">New <span class="text-red-600">Service Record</span></h2>
            <p class="text-gray-500 font-medium text-sm mt-1">Add a new maintenance log for your fleet.</p>
        </div>
        <a href="{{ route('maintenances.index') }}" class="text-gray-500 hover:text-red-600 transition-colors font-medium text-sm">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Logs
        </a>
    </div>

    <form action="{{ route('maintenances.store') }}" method="POST" class="bg-white p-10 rounded-2xl border border-gray-200 shadow-sm space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Select Vehicle</label>
                <select name="car_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all">
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Service Type</label>
                <input type="text" name="service_type" placeholder="e.g. Oil Change, Tire Rotation" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all" required>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Total Cost (PKR)</label>
                <input type="number" name="cost" placeholder="0.00" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all" required>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Service Date</label>
                <input type="date" name="service_date" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all" required>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Next Service Date (Optional)</label>
                <input type="date" name="next_service_date" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 mb-2">Additional Notes</label>
                <textarea name="notes" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-4 px-6 text-gray-900 focus:ring-2 focus:ring-red-600 focus:bg-white outline-none transition-all placeholder-gray-400" placeholder="Mechanic instructions or details..."></textarea>
            </div>
        </div>

        <button type="submit" class="w-full bg-red-600 text-white py-5 rounded-xl font-black uppercase tracking-widest hover:bg-red-700 transition shadow-lg shadow-red-600/20 mt-4">
            Authorize & Save Record
        </button>
    </form>
</div>
@endsection