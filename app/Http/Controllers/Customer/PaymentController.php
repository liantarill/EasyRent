<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    // public function __construct() {}
    public function checkout(Request $request, Rent $rent)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $snapToken = null;
        $orderId = 'RENT-' . $rent->id . '-' . time();
        $totalDays = (new DateTime($request->rent_date))
            ->diff(new DateTime($request->return_date))
            ->days + 1;

        // Create or update payment record
        $payment = Payment::updateOrCreate(
            ['rent_id' => $rent->id],
            [
                'order_id' => $orderId,
                'method' => 'cash',
                'amount' => $rent->total_price,
                'status' => 'Pending',
            ]
        );

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $rent->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? '08123456789',
            ],
            'item_details' => [
                [
                    'id' => 'VEHICLE-' . $rent->vehicle_id,
                    'price' => (int) $rent->daily_price_snapshot,
                    'quantity' => $totalDays,
                    'name' => $rent->vehicle->name . ' Rental',
                ]
            ],
            'callbacks' => [
                'finish' => route('customer.payments.finish', $payment->id),
            ]
        ];
        // dd($params);
        try {
            // Get Snap Token from Midtrans
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to initialize payment: ' . $e->getMessage());
        }


        return view('customer.payments.show', compact('rent', 'snapToken'));
    }

    public function finish(Payment $payment)
    {
        $payment->load('rent.vehicle');

        return view('customer.payments.finish', compact('payment'));
    }
}
