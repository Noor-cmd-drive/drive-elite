<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('category')->latest()->get(); 
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $categories = Category::all();
        // 🌟 Passing standard cities to view
        $cities = ['Islamabad', 'Lahore', 'Karachi', 'Faisalabad', 'Rawalpindi', 'Multan', 'Sargodha', 'Gujranwala', 'Bahawalpur', 'Hyderabad', 'Peshawar', 'Sialkot', 'Sukkur', 'Jhelum', 'Quetta'];
        return view('admin.cars.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model_name' => 'required|string|max:255',
            'city' => 'required|string', // 🌟 City validation
            'fuel_type' => 'required|string', // 🌟 NEW: Fuel Type validation
            'year' => 'required|integer',
            'daily_rent' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|in:Automatic,Manual',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $data['image'] = $imagePath;
        }

        Car::create($data);
        return redirect()->route('cars.index')->with('success', 'Vehicle has been successfully added to the fleet.');
    }

    // 🌟 Edit Function
    public function edit(Car $car)
    {
        $categories = Category::all();
        $cities = ['Islamabad', 'Lahore', 'Karachi', 'Faisalabad', 'Rawalpindi', 'Multan', 'Sargodha', 'Gujranwala', 'Bahawalpur', 'Hyderabad', 'Peshawar', 'Sialkot', 'Sukkur', 'Jhelum', 'Quetta'];
        return view('admin.cars.edit', compact('car', 'categories', 'cities'));
    }

    // 🌟 Update Function
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:255',
            'model_name' => 'required|string|max:255',
            'city' => 'required|string', // 🌟 City validation
            'fuel_type' => 'required|string', // 🌟 NEW: Fuel Type validation
            'year' => 'required|integer',
            'daily_rent' => 'required|numeric|min:0',
            'seats' => 'required|integer|min:1',
            'transmission' => 'required|in:Automatic,Manual',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Image is optional during update
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($car->image) { Storage::disk('public')->delete($car->image); }
            $imagePath = $request->file('image')->store('cars', 'public');
            $data['image'] = $imagePath;
        }

        $car->update($data);
        return redirect()->route('cars.index')->with('success', 'Vehicle details have been successfully updated.');
    }

    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Vehicle has been removed from the fleet.');
    }
}