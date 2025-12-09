<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    /**
     * Display a listing of available vehicles for customer.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string',
            'type' => 'nullable|in:car,motorcycle',
            'transmission' => 'nullable|in:automatic,manual',
            'rent_date' => 'nullable|date',
            'return_date' => 'nullable|date|after_or_equal:rent_date',
        ]);

        $vehiclesQuery = Vehicle::query();

        // Search
        if (!empty($validated['search'])) {
            $search = Str::lower(trim($validated['search']));

            $vehiclesQuery->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(brand) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(plate_number) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(vehicle_type) LIKE ?', ["%{$search}%"]);
            });
        }

        // Type
        if (!empty($validated['type'])) {
            $vehiclesQuery->where('vehicle_type', $validated['type']);
        }

        // Transmission
        if (!empty($validated['transmission'])) {
            $vehiclesQuery->where('transmission', $validated['transmission']);
        }

        // Date filter
        $rentDate = $validated['rent_date'] ?? null;
        $returnDate = $validated['return_date'] ?? null;

        if ($rentDate && $returnDate) {
            $start = Carbon::parse($rentDate)->startOfDay();
            $end   = Carbon::parse($returnDate)->endOfDay();

            $vehiclesQuery
                ->withCount(['rents as is_rented' => function ($q) use ($start, $end) {
                    $q->whereIn('rent_status', ['Pending Verification', 'Verified'])
                        ->where(function ($date) use ($start, $end) {
                            $date->where('rent_date', '<=', $end)
                                ->where('return_date', '>=', $start);
                        });
                }]);
        }

        $vehicles = $vehiclesQuery->latest()->paginate(9)->withQueryString();

        return view('customer.vehicles.index', [
            'vehicles' => $vehicles,
            'filters'  => $validated,
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
