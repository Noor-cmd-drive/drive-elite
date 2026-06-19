@extends('admin.layout')

@section('header_title', 'Vehicle Categories')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <p class="text-gray-500 font-medium text-sm">Manage and organize your DriveElite fleet classifications.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="bg-gradient-to-r from-gray-900 to-gray-800 hover:from-black hover:to-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition duration-300 shadow-md flex items-center group">
            <i class="fa-solid fa-plus mr-2 group-hover:rotate-90 transition duration-300"></i> Add New Category
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-widest">
                    <th class="p-5 font-bold">ID</th>
                    <th class="p-5 font-bold">Category Name</th>
                    <th class="p-5 font-bold">Description</th>
                    <th class="p-5 font-bold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-gray-700">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50/80 transition duration-200 group">
                        <td class="p-5 text-gray-400 font-semibold">#{{ $category->id }}</td>
                        <td class="p-5 font-bold text-gray-900">{{ $category->name }}</td>
                        <td class="p-5 text-sm text-gray-500">{{ $category->description ?? 'No description provided.' }}</td>
                        <td class="p-5 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:bg-blue-50 transition duration-200 px-3 py-1.5 bg-white rounded-lg shadow-sm border border-gray-100 flex items-center gap-1 text-xs font-bold uppercase tracking-wider">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:bg-red-50 transition duration-200 px-3 py-1.5 bg-white rounded-lg shadow-sm border border-gray-100 flex items-center gap-1 text-xs font-bold uppercase tracking-wider">
                                        <i class="fa-solid fa-trash-can"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                <i class="fa-solid fa-folder-open text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No Categories Found</h3>
                            <p class="text-sm text-gray-500">Get started by creating your first vehicle category.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection