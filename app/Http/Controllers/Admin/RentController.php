<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rents = Rent::all();

        $rents = Rent::with(['user', 'approver', 'vehicle'])->get();

        return view('admin.rents.index', compact('rents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'              => 'required|uuid|exists:users,id',
            'approved_by'          => 'nullable|uuid|exists:users,id',
            'vehicle_id'           => 'required|exists:vehicles,id',
            'rent_date'            => 'required|date',
            'return_date'          => 'required|date|after_or_equal:rent_date',
            'daily_price_snapshot' => 'required|numeric|min:0',
            'total_price'          => 'required|numeric|min:0',
            'rent_status'          => 'required|in:Pending Verification,Verified,Rejected',
        ]);


        Rent::create($request->all());

        return redirect()->route('admin.rents.index')->with('success', 'Rent created.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Rent $rent)
    // {
    //     $rent->load('payment');
    //     return view('admin.rents.show', compact('rent'));
    // }

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
    public function update(Request $request, Rent $rent)
    {
        $request->validate([
            'approved_by' => 'nullable|uuid|exists:users,id',
            'rent_status' => 'required|in:Pending Verification,Verified,Rejected',
        ]);


        $data = $request->all();

        if ($request->rent_status === 'Verified') {
            $data['approved_by'] = Auth::id();
        } else {
            $data['approved_by'] = null;
        }

        $rent->update($data);

        return redirect()->back()->with('success', 'Rent updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
