@extends('admin.layout')

@section('header_title', 'Edit Vehicle Specifications')

@section('content')
    <div class="mb-6">
        <a href="{{ route('cars.index') }}" class="text-gray-500 hover:text-gray-800 transition font-medium">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Fleet
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-5xl mx-auto relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-red-600"></div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Update Vehicle Details</h2>
            <p class="text-gray-500 text-sm">Modify the specifications for {{ $car->brand }} {{ $car->model_name }}.</p>
        </div>
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm">
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Select Category *</label>
                    <select name="category_id" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $car->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Brand (Make) *</label>
                    <input type="text" name="brand" value="{{ $car->brand }}" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Model Name *</label>
                    <input type="text" name="model_name" value="{{ $car->model_name }}" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Assigned City / Location *</label>
                    <select name="city" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Global Coverage" {{ $car->city == 'Global Coverage' ? 'selected' : '' }}>Global Coverage</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ $car->city == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Manufacturing Year *</label>
                    <input type="number" name="year" value="{{ $car->year }}" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Daily Rent (Rs.) *</label>
                    <input type="number" name="daily_rent" value="{{ $car->daily_rent }}" required class="w-full rounded-lg border-gray-300 focus:border-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Seats *</label>
                    <input type="number" name="seats" value="{{ $car->seats }}" required class="w-full rounded-lg border-gray-300 focus:border-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fuel Type *</label>
                    <select name="fuel_type" required class="w-full rounded-lg border-gray-300 focus:border-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Petrol" {{ $car->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                        <option value="Diesel" {{ $car->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybrid" {{ $car->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Electric (EV)" {{ $car->fuel_type == 'Electric (EV)' ? 'selected' : '' }}>Electric (EV)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Transmission *</label>
                    <select name="transmission" required class="w-full rounded-lg border-gray-300 focus:border-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Automatic" {{ $car->transmission == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="Manual" {{ $car->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>

                <div class="flex items-center mt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_available" value="1" class="sr-only peer" {{ $car->is_available ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700">Currently Available</span>
                    </label>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Vehicle Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-lg border-gray-300 focus:border-red-500 shadow-sm px-4 py-3 bg-gray-50">{{ $car->description }}</textarea>
                </div>

                <div class="md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Update Image <span class="text-gray-400 font-normal">(Leave empty to keep current image)</span></label>
                    <div class="flex items-center gap-6">
                        <img src="{{ asset('storage/' . $car->image) }}" class="w-32 h-32 object-cover rounded-xl shadow-sm border border-gray-200">
                        <input type="file" name="image" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                </div>

            </div> 
            
            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                <button type="submit" class="bg-gray-900 hover:bg-red-600 text-white font-bold py-2.5 px-8 rounded-lg shadow-md transition flex items-center">
                    <i class="fa-solid fa-arrows-rotate mr-2"></i> Update Details
                </button>
            </div>
        </form>
    </div>
@endsection