@extends('admin.layout')

@section('header_title', 'Add New Vehicle to Fleet')

@section('content')
    <div class="mb-6">
        <a href="{{ route('cars.index') }}" class="text-gray-500 hover:text-gray-800 transition font-medium">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Fleet
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-5xl mx-auto relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-gray-900"></div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Vehicle Details</h2>
            <p class="text-gray-500 text-sm">Provide complete details and specifications for the new vehicle.</p>
        </div>
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    <span class="font-bold">Oops! Please fix the errors below:</span>
                </div>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Select Category *</label>
                    <select name="category_id" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="">-- Select a Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Brand (Make) *</label>
                    <input type="text" name="brand" required placeholder="e.g. Toyota, Honda, Audi" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Model Name *</label>
                    <input type="text" name="model_name" required placeholder="e.g. Corolla, Civic, A4" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Assigned City / Location *</label>
                    <select name="city" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Global Coverage">Global Coverage (All Pakistan)</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Manufacturing Year *</label>
                    <input type="number" name="year" required min="2000" max="2026" placeholder="e.g. 2024" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Daily Rent (Rs.) *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rs.</span>
                        <input type="number" name="daily_rent" required min="0" placeholder="5000" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm pl-10 py-2.5 bg-gray-50">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Number of Seats *</label>
                    <input type="number" name="seats" required min="1" max="15" placeholder="e.g. 4" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fuel Type *</label>
                    <select name="fuel_type" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="Electric (EV)">Electric (EV)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Transmission *</label>
                    <select name="transmission" required class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-2.5 bg-gray-50">
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                    </select>
                </div>

                <!-- 🚀 ACCESSIBILITY: Wheelchair Accessible Checkbox (NEW) -->
                <div class="flex items-center mt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_wheelchair_accessible" value="1" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700"><i class="fa-solid fa-wheelchair text-blue-600 mr-1"></i> Wheelchair Accessible</span>
                    </label>
                </div>

                <div class="flex items-center mt-8">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_available" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                        <span class="ml-3 text-sm font-semibold text-gray-700">Currently Available for Rent</span>
                    </label>
                </div>

                <div class="md:col-span-2 mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Vehicle Description & Features</label>
                    <textarea name="description" rows="4" placeholder="Briefly describe the car, its condition, and extra features (e.g. Sunroof, Bluetooth, Leather seats)..." class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm px-4 py-3 bg-gray-50"></textarea>
                </div>

                <div class="md:col-span-2 mt-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Car Image <span class="text-red-500">*</span> <span class="text-gray-400 font-normal">(Max 2MB)</span></label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition overflow-hidden relative group">
                            
                            <div id="upload-content" class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                <i id="upload-icon" class="fa-solid fa-cloud-arrow-up text-4xl text-gray-400 mb-3 transition-colors"></i>
                                <p id="upload-text" class="mb-2 text-sm text-gray-500"><span class="font-bold text-gray-900 group-hover:text-red-600 transition">Click to browse</span> or drag and drop</p>
                                <p class="text-xs text-gray-400 font-medium">PNG, JPG or WEBP</p>
                            </div>

                            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden" alt="Selected Car Preview">
                            <div id="preview-overlay" class="absolute inset-0 bg-gray-900/60 hidden flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <i class="fa-solid fa-pen-to-square text-2xl mb-2"></i>
                                <span class="text-sm font-bold">Change Image</span>
                            </div>
                            
                            <input id="dropzone-file" type="file" name="image" required accept="image/png, image/jpeg, image/jpg, image/webp" class="hidden" />
                        </label>
                    </div>
                    <p id="file-error" class="text-red-500 text-sm font-bold mt-2 hidden"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Image is too large! Maximum allowed size is 2MB.</p>
                </div>

            </div> 
            
            <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <button type="reset" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                    Clear Data
                </button>
                <button type="submit" class="bg-gray-900 hover:bg-gray-800 text-white font-bold py-2.5 px-8 rounded-lg shadow-md transition flex items-center">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Save Vehicle
                </button>
            </div>

        </form>
    </div>

    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const errorText = document.getElementById('file-error');
            const uploadContent = document.getElementById('upload-content');
            const imagePreview = document.getElementById('image-preview');
            const previewOverlay = document.getElementById('preview-overlay');
            
            if (file) {
                if (file.size > 2097152) {
                    errorText.classList.remove('hidden'); 
                    this.value = ''; 
                    uploadContent.classList.remove('hidden');
                    imagePreview.classList.add('hidden');
                    previewOverlay.classList.add('hidden');
                    return;
                }

                errorText.classList.add('hidden'); 
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    previewOverlay.classList.remove('hidden');
                    uploadContent.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection