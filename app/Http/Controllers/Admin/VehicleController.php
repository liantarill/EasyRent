<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'         => 'required|string|',
            'year'          => 'required|integer|',
            'plate_number'  => 'required|string|unique:vehicles,plate_number',
            'transmission'  => 'required|in:manual,automatic',
            'fuel_type'     => 'required|in:gasoline,diesel,electric',
            'capacity'      => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'vehicle_type'  => 'required|in:car,motorcycle',
            'status'        => 'required|in:Available,Rented,Maintenance',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('vehicles', 'public');
            $validated['photo'] = $path;
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'brand'         => 'required|string|',
            'year'          => 'required|integer|',
            'plate_number'  => 'required|string|unique:vehicles,plate_number,' . $vehicle->id,
            'transmission'  => 'required|in:manual,automatic',
            'fuel_type'     => 'required|in:gasoline,diesel,electric',
            'capacity'      => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'vehicle_type'  => 'required|in:car,motorcycle',
            'status'        => 'required|in:Available,Rented,Maintenance',
        ]);

        if ($request->hasFile('photo')) {
            if ($vehicle->photo && Storage::disk('public')->exists($vehicle->photo)) {
                Storage::disk('public')->delete($vehicle->photo);
            }

            $path = $request->file('photo')->store('vehicles', 'public');
            $validated['photo'] = $path;
        }


        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->back()->with('success', 'Kendaraan berhasil dihapus.');
    }
}
