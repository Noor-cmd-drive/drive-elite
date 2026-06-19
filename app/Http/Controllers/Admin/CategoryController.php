<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Saari categories dikhane ke liye
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // 2. Nayi category add karne ka form dikhane ke liye
    public function create()
    {
        return view('admin.categories.create');
    }

    // 3. Form ka data database mein save karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Category has been successfully created.');
    }

    /**
     * 🚀 NEW: Category edit karne ka form dikhane ke liye
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * 🚀 NEW: Edited data ko database mein update karne ke liye
     */
    public function update(Request $request, Category $category)
    {
        // Validation: Name unique hona chahiye lekin apni ID ko chorr kar
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')
                         ->with('success', 'Category has been successfully updated.');
    }

    // 4. Delete karne ke liye
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success', 'Category has been permanently deleted.');
    }
}