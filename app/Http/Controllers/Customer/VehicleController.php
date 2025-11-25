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
        $data = $request->validate([
            'search'       => 'nullable|string',
            'type'         => 'nullable|in:car,motorcycle',
            'transmission' => 'nullable|in:automatic,manual',
            'rent_date'    => 'nullable|date',
            'return_date'  => 'nullable|date|after_or_equal:rent_date',
        ]);

        $vehiclesQuery = Vehicle::query()->where('status', 'Available');

        // Search (case-insensitive)
        $search = $request->string('search')->trim()->toString();
        if ($search !== '') {
            $searchTerm = Str::lower($search);

            $vehiclesQuery->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(brand) LIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(plate_number) LIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(vehicle_type) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        // Vehicle type filter
        $type = $request->string('type')->trim()->toString();
        if ($type !== '') {
            $vehiclesQuery->where('vehicle_type', $type);
        }

        // Transmission filter
        $transmission = $request->string('transmission')->trim()->toString();
        if ($transmission !== '') {
            $vehiclesQuery->where('transmission', $transmission);
        }

        // Availability date filter: hanya apply jika kedua tanggal diberikan
        $rentDateInput   = $data['rent_date'] ?? null;
        $returnDateInput = $data['return_date'] ?? null;

        if ($rentDateInput && $returnDateInput) {
            $rentDate   = Carbon::parse($rentDateInput)->startOfDay();
            $returnDate = Carbon::parse($returnDateInput)->endOfDay();

            $vehiclesQuery->whereDoesntHave('rents', function ($q) use ($rentDate, $returnDate) {
                // anggap 'Pending Verification' dan 'Verified' berarti booking memblokir kendaraan
                $q->whereIn('rent_status', ['Pending Verification', 'Verified'])
                    ->where(function ($q2) use ($rentDate, $returnDate) {
                        // overlap condition:
                        // existing.rent_date <= requested_return AND existing.return_date >= requested_rent
                        $q2->where('rent_date', '<=', $returnDate->toDateString())
                            ->where('return_date', '>=', $rentDate->toDateString());
                    });
            });
        }

        $vehicles = $vehiclesQuery->latest()->paginate(9)->withQueryString();

        // Kirim kembali filters agar form tetap terisi
        $filters = [
            'search'       => $search,
            'type'         => $type,
            'transmission' => $transmission,
            'rent_date'    => $rentDateInput,
            'return_date'  => $returnDateInput,
        ];

        return view('customer.vehicles.index', [
            'vehicles' => $vehicles,
            'filters'  => $filters,
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
