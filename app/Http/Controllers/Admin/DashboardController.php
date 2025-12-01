<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Rent;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Summary / metric cards
        $totalVehicles     = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'Available')->count();
        $ongoingRents      = Rent::where('rent_status', 'Ongoing')->count();
        $pendingPayments   = Payment::where('status', 'pending')->count();

        $statCards = [
            ['label' => 'Total Mobil', 'value' => $totalVehicles, 'icon' => 'fa-solid fa-car', 'icon_bg' => '#e0f2fe', 'icon_fg' => '#1d4ed8'],
            ['label' => 'Mobil Tersedia', 'value' => $availableVehicles, 'status' => 'available', 'icon' => 'fas fa-check-circle', 'icon_bg' => '#fef3c7', 'icon_fg' => '#d97706'],
            ['label' => 'Transaksi Aktif', 'value' => $ongoingRents, 'status' => 'ongoing', 'icon' => 'fa-solid fa-forward', 'icon_bg' => '#ecfdf3', 'icon_fg' => '#15803d'],
            ['label' => 'Pembayaran Pending', 'value' => $pendingPayments, 'status' => 'pending', 'icon' => 'fa-solid fa-hourglass-half', 'icon_bg' => '#fee2e2', 'icon_fg' => '#b91c1c'],
        ];

        // Transactions (Rents) — include related user, vehicle and payment
        $transactionsQuery = Rent::with(['user', 'vehicle', 'payment'])
            ->orderBy('created_at', 'desc');

        // optional filters from request (status, date, search)
        if ($request->filled('status')) {
            $transactionsQuery->where('rent_status', $request->status);
        }
        if ($request->filled('from')) {
            $transactionsQuery->whereDate('rent_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $transactionsQuery->whereDate('return_date', '<=', $request->to);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $transactionsQuery->whereHas('user', fn($qU) => $qU->where('name', 'like', "%{$q}%"))
                ->orWhereHas('vehicle', fn($qV) => $qV->where('brand', 'like', "%{$q}%"))
                ->orWhere('id', 'like', "%{$q}%");
        }

        $transactions = $transactionsQuery->paginate(5);

        // Payments waiting verification
        $payments = Payment::where('status', 'pending')
            ->with(['rent.user'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Vehicle availability list
        $availability = Vehicle::select('id', 'brand as name', 'plate_number as plate', 'status')
            ->orderBy('brand')
            ->get();

        return view('admin.dashboard', compact(
            'statCards',
            'transactions',
            'payments',
            'availability'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
