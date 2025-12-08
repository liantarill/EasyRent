<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Rent;
use App\Models\Vehicle;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::now()->startOfDay();

        // Total transaksi
        $rentCount = Rent::where('user_id', $user->id)->count();

        // Sedang berjalan = rent_date ≤ today ≤ return_date
        $ongoingRentCount = Rent::where('user_id', $user->id)
            ->whereDate('rent_date', '<=', now())
            ->whereDate('return_date', '>=', now())
            ->count();

        // Selesai (return_date < today)
        $finishedRentCount = Rent::where('user_id', $user->id)
            ->whereDate('return_date', '<', now())
            ->count();

        // Menunggu pembayaran → karena tidak ada payment_status di migrasi kamu,
        // kita asumsikan Pending Verification = pending pembayaran
        $pendingPaymentCount = Rent::where('user_id', $user->id)
            ->where('rent_status', 'Pending Verification')
            ->count();

        // Transaksi terbaru
        $recentRents = Rent::with('vehicle')
            ->where('user_id', $user->id)
            ->latest()
            ->take(8)
            ->get();

        $statusMap = [
            'pending'   => ['Pending', '#f59e0b', '#fef9c3'],
            'ongoing'   => ['Ongoing', '#3b82f6', '#e0e7ff'],
            'returned'  => ['Returned', '#10b981', '#d1fae5'],
            'verified'  => ['Verified', '#06b6d4', '#ecfeff'],
            'rejected'  => ['Rejected', '#ef4444', '#fee2e2'],
            'cancelled' => ['Cancelled', '#6b7280', '#f3f4f6'],
            'upcoming'  => ['Upcoming', '#6366f1', '#eef2ff'],
        ];

        // Ambil transaksi terbaru dan preprocess status untuk Blade
        $recentRents = Rent::with('vehicle')
            ->where('user_id', $user->id)
            ->latest()
            ->take(8)
            ->get()
            ->map(function ($rent) use ($today, $statusMap) {
                // Normalisasi fields
                $rentDate   = $rent->rent_date ? Carbon::parse($rent->rent_date)->startOfDay() : null;
                $returnDate = $rent->return_date ? Carbon::parse($rent->return_date)->startOfDay() : null;
                $rawStatus  = trim((string) ($rent->rent_status ?? ''));

                // Tentukan display status berdasarkan rent_status dan tanggal
                $key = null;

                // First handle explicit statuses from DB
                if (strcasecmp($rawStatus, 'Pending Verification') === 0) {
                    $key = 'pending';
                } elseif (strcasecmp($rawStatus, 'Rejected') === 0) {
                    $key = 'rejected';
                } elseif (strcasecmp($rawStatus, 'Cancelled') === 0) {
                    $key = 'cancelled';
                } elseif (strcasecmp($rawStatus, 'Verified') === 0) {
                    // Jika verified, gunakan tanggal untuk lebih spesifik:
                    if ($rentDate && $returnDate) {
                        if ($rentDate->lte($today) && $returnDate->gte($today)) {
                            $key = 'ongoing';
                        } elseif ($returnDate->lt($today)) {
                            $key = 'returned';
                        } elseif ($rentDate->gt($today)) {
                            $key = 'upcoming';
                        }
                    }
                    // fallback ke 'verified' jika tanggal tidak tersedia / tidak match
                    $key = $key ?? 'verified';
                }

                // Jika belum ditentukan, beri prioritas pada tanggal (mis. data legacy)
                if ($key === null) {
                    if ($rentDate && $returnDate) {
                        if ($rentDate->lte($today) && $returnDate->gte($today)) {
                            $key = 'ongoing';
                        } elseif ($returnDate->lt($today)) {
                            $key = 'returned';
                        } elseif ($rentDate->gt($today)) {
                            $key = 'upcoming';
                        }
                    }
                }

                // Default jika masih null
                $key = $key ?? 'pending';

                $style = $statusMap[$key] ?? ['-', '#6b7280', '#f3f4f6'];

                // properti untuk Blade
                $rent->display_status = $style[0];
                $rent->status_color   = $style[1];
                $rent->status_bg      = $style[2];

                // juga sertakan formatted dates & total supaya Blade lebih sederhana
                $rent->formatted_rent_date   = $rentDate ? $rentDate->format('d M Y') : ($rent->rent_date ?? '-');
                $rent->formatted_return_date = $returnDate ? $returnDate->format('d M Y') : ($rent->return_date ?? '-');
                $rent->formatted_total       = 'Rp ' . number_format($rent->total_price ?? 0, 0, ',', '.');

                return $rent;
            });


        return view('customer.dashboard', compact(
            'rentCount',
            'ongoingRentCount',
            'finishedRentCount',
            'pendingPaymentCount',
            'recentRents'
        ));
    }
    // return view('customer.dashboard');

}
