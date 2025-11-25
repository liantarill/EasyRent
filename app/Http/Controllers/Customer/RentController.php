<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\Vehicle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    /**
     * Display a listing of user's rents
     */
    public function index()
    {
        $rents = Rent::with(['vehicle', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.rents.index', compact('rents'));
    }

    public function create(Vehicle $vehicle)
    {
        return view('customer.rents.create', compact('vehicle'));
    }

    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'rent_date' => 'required|date|before_or_equal:return_date',
            'return_date' => 'required|date|after_or_equal:rent_date',
        ]);

        // Hitung jumlah hari
        $totalDays = (new DateTime($request->rent_date))
            ->diff(new DateTime($request->return_date))
            ->days + 1; // termasuk hari pertama

        // Hitung total harga
        $totalPrice = $vehicle->price_per_day * $totalDays;

        // Simpan ke database
        $rent = Rent::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'rent_date' => $request->rent_date,
            'return_date' => $request->return_date,
            'daily_price_snapshot' => $vehicle->price_per_day,
            'total_price' => $totalPrice
        ]);

        return redirect()->route('customer.payments.checkout', $rent->id)->with('success', 'Berhasil membuat sewa!');
    }

    public function show(Rent $rent)
    {
        // Authorize - ensure only the rent owner can view
        if ($rent->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Eager load relations
        $rent->load(['vehicle', 'user', 'payment']);

        return view('customer.rents.show', compact('rent'));
    }
}
