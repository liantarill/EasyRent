<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of available vehicles for customer.
     */
    public function index(Request $request)
    {
        $vehiclesQuery = Vehicle::query()->where('status', 'Available');

        $search = $request->string('search')->trim()->toString();
        if ($search !== '') {
            $searchTerm = Str::lower($search);

            $vehiclesQuery->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(brand) LIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(plate_number) LIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(vehicle_type) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        $type = $request->string('type')->trim()->toString();
        if ($type !== '') {
            $vehiclesQuery->where('vehicle_type', $type);
        }

        $transmission = $request->string('transmission')->trim()->toString();
        if ($transmission !== '') {
            $vehiclesQuery->where('transmission', $transmission);
        }

        $vehicles = $vehiclesQuery->latest()->paginate(9)->withQueryString();

        return view('customer.vehicles.index', [
            'vehicles' => $vehicles,
            'filters' => compact('search', 'type', 'transmission'),
        ]);
    }

    /**
     * Display detail for a specific vehicle.
     */
    public function show(Vehicle $vehicle)
    {
        return view('customer.vehicles.show', compact('vehicle'));
    }
}
