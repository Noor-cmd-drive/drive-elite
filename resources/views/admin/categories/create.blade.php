@extends('admin.layout')

@section('header_title', 'Create Category')

@section('content')
    <div class="mb-6">
        <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-900 transition font-medium text-sm flex items-center w-fit">
            <i class="fa-solid fa-arrow-left-long mr-2"></i> Return to Categories
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-3xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-gray-900 to-gray-500"></div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Category Details</h2>
            <p class="text-gray-500 text-sm mt-1">Define a new vehicle classification for the DriveElite fleet.</p>
        </div>
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-xl shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    <span class="font-bold">Please correct the following errors:</span>
                </div>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf 
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Classification Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" required placeholder="e.g. Premium SUV, Economy, Executive Sedan" class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900 shadow-sm px-4 py-3 bg-gray-50 transition duration-200">
            </div>

            <div class="mb-8">
                <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description <span class="text-gray-400 font-normal">(Optional)</span></label>
                <textarea name="description" id="description" rows="4" placeholder="Briefly describe what type of vehicles belong in this category..." class="w-full rounded-xl border-gray-200 focus:border-gray-900 focus:ring-gray-900 shadow-sm px-4 py-3 bg-gray-50 transition duration-200"></textarea>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="bg-gray-900 hover:bg-black text-white font-bold py-3 px-8 rounded-xl shadow-md transition duration-300 flex items-center">
                    <i class="fa-solid fa-check mr-2"></i> Save Category
                </button>
                <button type="reset" class="px-6 py-3 text-gray-500 font-semibold rounded-xl hover:bg-gray-50 transition duration-200">
                    Reset
                </button>
            </div>
        </form>
    </div>
@endsection