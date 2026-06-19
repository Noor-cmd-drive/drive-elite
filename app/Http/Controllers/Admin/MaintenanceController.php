<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use App\Models\Car;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('car')->latest()->get();
        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $cars = Car::all();
        return view('admin.maintenances.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_type' => 'required|string',
            'cost' => 'required|numeric',
            'service_date' => 'required|date',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenances.index')->with('success', 'Maintenance record added successfully!');
    }

    /**
     * 🚀 NEW: Maintenance edit form dikhane ke liye
     */
    public function edit(Maintenance $maintenance)
    {
        $cars = Car::all(); // Dropdown ke liye saari gariyan
        return view('admin.maintenances.edit', compact('maintenance', 'cars'));
    }

    /**
     * 🚀 NEW: Data update karne ke liye
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'service_type' => 'required|string',
            'cost' => 'required|numeric',
            'service_date' => 'required|date',
            'next_service_date' => 'nullable|date',
        ]);

        $maintenance->update($request->all());

        return redirect()->route('maintenances.index')->with('success', 'Maintenance record updated successfully!');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return back()->with('success', 'Record deleted successfully!');
    }
}