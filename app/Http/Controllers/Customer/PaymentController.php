<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
                'status' => 'Pending',
                'snap_token' => null,
                'amount' => $rent->total_price,
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
                'phone' => Auth::user()->phone_number ?? '0',
            ],
            'item_details' => [
                [
                    'id' => 'VEHICLE-' . $rent->vehicle_id,
                    'price' => (int) $rent->total_price,
                    'quantity' => $totalDays,
                    'name' => $rent->vehicle->brand . ' Rental',
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


        return view('customer.payments.checkout', compact('rent', 'snapToken', 'payment'));
    }

    public function finish(Payment $payment)
    {
        $payment->load('rent.vehicle');
        return view('customer.payments.finish', compact('payment'));
    }

    public function notification(Request $request)
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
            $fraudStatus = $notification->fraud_status ?? null;

            Log::info('Midtrans Notification', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $notification->payment_type ?? null,
            ]);

            // Find payment by order_id
            $payment = Payment::where('order_id', $orderId)->first();

            if (!$payment) {
                Log::warning('Payment not found for order_id: ' . $orderId);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            // Update payment status based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $payment->update(['status' => 'Paid']);
                    // Update rent status to Verified
                    $payment->rent->update(['rent_status' => 'Verified']);
                }
            } elseif ($transactionStatus == 'settlement') {
                $payment->update(['status' => 'Paid']);
                // Update rent status to Verified
                $payment->rent->update(['rent_status' => 'Verified']);
            } elseif ($transactionStatus == 'pending') {
                $payment->update(['status' => 'Pending']);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $payment->update(['status' => 'Failed']);
            }

            return response()->json([
                'message' => 'Notification handled successfully',
                'order_id' => $orderId,
                'status' => $transactionStatus
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => 'Error processing notification'], 500);
        }
    }
}
