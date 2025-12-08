@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        @include('layouts.partials.navbar')

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
            <!-- Success Messages -->
            @if (session('success'))
                <div
                    class="mb-6 flex items-center gap-3 bg-linear-to-r from-green-50 to-emerald-50 border border-green-300 rounded-xl p-4">
                    <div class="shrink-0">
                        <i class="fas fa-check-circle text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-green-900">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 flex items-center gap-3 bg-linear-to-r from-green-50 to-emerald-50 border border-green-300 rounded-xl p-4">
                    <div class="shrink-0">
                        <i class="fas fa-check-circle text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-green-900">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            @if (session('info'))
                <div
                    class="mb-6 flex items-center gap-3 bg-linear-to-r from-blue-50 to-cyan-50 border border-blue-300 rounded-xl p-4">
                    <div class="shrink-0">
                        <i class="fas fa-info-circle text-2xl text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-900">{{ session('info') }}</p>
                    </div>
                </div>
            @endif
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                        <div>
                            <h3 class="font-semibold text-red-900 mb-2">Terjadi Kesalahan:</h3>
                            <ul class="list-disc list-inside text-red-800 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Header Section -->
            <div class="mb-8">
                <a href="{{ route('customer.rents.index') }}"
                    class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-semibold mb-6 transition-colors">
                    <i class="fas fa-chevron-left"></i>
                    Kembali ke Daftar Penyewaan
                </a>

                <div class="flex items-start justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-5xl font-black text-gray-900 mb-2">
                            {{ $rent->vehicle->brand ?? 'Kendaraan' }}
                        </h1>
                        <p class="text-lg text-gray-600 flex items-center gap-2">
                            <i class="fas fa-tag text-teal-500"></i>
                            {{ $rent->vehicle->plate_number ?? '-' }}
                        </p>
                    </div>

                    <!-- Status Badge -->
                    @php
                        $status = $rent->rent_status;
                        $badgeColors = [
                            'Pending Verification' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                            'Verified' => 'bg-green-100 text-green-800 border-green-300',
                            'Rejected' => 'bg-red-100 text-red-800 border-red-300',
                            'Cancelled' => 'bg-red-100 text-red-800 border-red-300',
                        ];
                        $badgeClass = $badgeColors[$status] ?? 'bg-gray-100 text-gray-800 border-gray-300';
                    @endphp
                    <div class="border {{ $badgeClass }} rounded-2xl px-6 py-4">
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-1">Status Penyewaan</p>
                        <p class="text-2xl font-black">{{ $status }}</p>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column: Vehicle & Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Vehicle Image -->
                    <div class="relative rounded-2xl overflow-hidden bg-linear-to-br from-gray-100 to-gray-200 h-96">
                        @if ($rent->vehicle->photo)
                            <img src="{{ asset('storage/' . $rent->vehicle->photo) }}" alt="{{ $rent->vehicle->brand }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-car text-8xl text-gray-300"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Rental Timeline -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-teal-500"></i>
                            Timeline Penyewaan
                        </h2>

                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-12 h-12 rounded-full bg-linear-to-br from-teal-500 to-teal-600 flex items-center justify-center text-white font-bold">
                                        1
                                    </div>
                                    <div class="w-1 h-12 bg-gray-200 my-2"></div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-600 mb-1">Tanggal Mulai
                                    </p>
                                    <p class="text-2xl font-black text-gray-900">{{ $rent->rent_date->format('d M Y') }}
                                    </p>
                                    <p class="text-gray-600 mt-1">Pengambilan kendaraan</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-12 h-12 rounded-full bg-linear-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold">
                                        2
                                    </div>
                                    <div class="w-1 h-12 bg-gray-200 my-2"></div>
                                </div>
                                <div class="pb-6">
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-600 mb-1">Tanggal
                                        Kembali</p>
                                    <p class="text-2xl font-black text-gray-900">{{ $rent->return_date->format('d M Y') }}
                                    </p>
                                    <p class="text-gray-600 mt-1">Pengembalian kendaraan</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-12 h-12 rounded-full bg-linear-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-bold">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-600 mb-1">Durasi
                                        Penyewaan</p>
                                    <p class="text-2xl font-black text-gray-900">
                                        {{ $rent->return_date->diffInDays($rent->rent_date) }} Hari</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Specs -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6">
                        <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-info-circle text-teal-500"></i>
                            Spesifikasi Kendaraan
                        </h2>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="bg-linear-to-br from-teal-50 to-cyan-50 rounded-xl p-4 border border-teal-100">
                                <p class="text-xs font-bold uppercase text-teal-600 mb-1">Jenis Kendaraan</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->vehicle_type ?? '-' }}</p>
                            </div>
                            <div class="bg-linear-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                                <p class="text-xs font-bold uppercase text-blue-600 mb-1">Transmisi</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->transmission ?? '-' }}</p>
                            </div>
                            <div class="bg-linear-to-br from-purple-50 to-pink-50 rounded-xl p-4 border border-purple-100">
                                <p class="text-xs font-bold uppercase text-purple-600 mb-1">Bahan Bakar</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->fuel_type ?? '-' }}</p>
                            </div>
                            <div class="bg-linear-to-br from-orange-50 to-red-50 rounded-xl p-4 border border-orange-100">
                                <p class="text-xs font-bold uppercase text-orange-600 mb-1">Kapasitas</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->capacity ?? '-' }} Penumpang
                                </p>
                            </div>
                            <div class="bg-linear-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                                <p class="text-xs font-bold uppercase text-green-600 mb-1">Status</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->status ?? '-' }}</p>
                            </div>
                            <div class="bg-linear-to-br from-gray-50 to-slate-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-xs font-bold uppercase text-gray-600 mb-1">Tahun</p>
                                <p class="text-lg font-bold text-gray-900">{{ $rent->vehicle->year ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Pricing & Payment -->
                <div class="lg:col-span-1">
                    <!-- Price Summary -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-receipt text-teal-500"></i>
                            Detail Harga
                        </h2>

                        <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-tag text-gray-400 w-4"></i>
                                    Harga Per Hari
                                </span>
                                <span class="font-bold text-gray-900">Rp
                                    {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-gray-400 w-4"></i>
                                    Jumlah Hari
                                </span>
                                <span
                                    class="font-bold text-gray-900">{{ $rent->return_date->diffInDays($rent->rent_date) }}
                                    Hari</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mb-6">
                            <span class="text-lg font-bold text-gray-900">Total Harga</span>
                            <span
                                class="text-3xl font-black bg-linear-to-r from-teal-600 to-teal-500 bg-clip-text text-transparent">
                                Rp {{ number_format($rent->total_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Payment Status -->
                        @php
                            $hasPaid = $rent->payment && strtolower($rent->payment->status) === 'paid';
                            $hasPending =
                                $rent->payment &&
                                in_array(strtolower($rent->payment->status), ['pending', 'pending Payment']);
                            $hasFailed =
                                $rent->payment && in_array(strtolower($rent->payment->status), ['failed', 'expired']);
                            $hasCancelled = $rent->payment && strtolower($rent->payment->status) === 'cancelled';

                        @endphp

                        @if ($hasPaid)
                            <div
                                class="bg-linear-to-br from-green-50 to-emerald-50 border-2 border-green-300 rounded-xl p-4 mb-6">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white shrink-0 mt-0.5">
                                        <i class="fas fa-check text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-green-900">Pembayaran Berhasil</p>
                                        <p class="text-sm text-green-700 mt-1">Pesanan Anda telah dikonfirmasi</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($hasCancelled)
                            <div class="bg-linear-to-br from-red-50 to-red-50 border-2 border-red-300 rounded-xl p-4 mb-6">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white shrink-0 mt-0.5">
                                        <i class="fas fa-check text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-red-900">Pembayaran Dibatalkan</p>
                                        <p class="text-sm text-red-700 mt-1">Pesanan Anda telah dibatalkan</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div
                                class="bg-linear-to-br from-amber-50 to-orange-50 border-2 border-amber-300 rounded-xl p-4 mb-6">
                                <div class="flex items-start gap-3 mb-4">
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-600 flex items-center justify-center text-white shrink-0 mt-0.5">
                                        <i class="fas fa-exclamation text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-amber-900">
                                            @if ($hasPending)
                                                Pembayaran Tertunda
                                            @elseif($hasFailed)
                                                Pembayaran Gagal
                                            @else
                                                Pembayaran Diperlukan
                                            @endif
                                        </p>
                                        <p class="text-sm text-amber-700 mt-1">
                                            @if ($hasPending)
                                                Selesaikan pembayaran untuk mengkonfirmasi pesanan
                                            @elseif($hasFailed)
                                                Coba pembayaran lagi
                                            @else
                                                Lanjutkan pembayaran untuk mengkonfirmasi
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <form action="{{ route('customer.payments.checkout', $rent->id) }}" method="GET"
                                    class="space-y-2">
                                    <button type="submit"
                                        class="w-full px-4 py-3 bg-linear-to-r from-teal-600 to-teal-500 text-white font-semibold rounded-xl 
               hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-300 flex items-center justify-center gap-2">
                                        <i class="fas fa-credit-card"></i>
                                        @if ($hasPending || $hasFailed)
                                            Coba Pembayaran Lagi
                                        @else
                                            Bayar Sekarang
                                        @endif
                                    </button>
                                </form>

                                <form action="{{ route('payments.cancel', $rent->payment->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full mt-2 px-4 py-3 bg-linear-to-r from-red-700 to-red-600 text-white font-semibold rounded-xl flex items-center justify-center gap-2 shadow-md hover:shadow-red-500/30 transition-all duration-300">
                                        <i class="fas fa-times-circle"></i>
                                        Batalkan
                                    </button>
                                </form>


                                @if ($rent->payment)
                                    <p class="text-xs text-gray-500 mt-3 text-center">
                                        Order ID: <code
                                            class="bg-white px-2 py-1 rounded">{{ $rent->payment->order_id }}</code>
                                    </p>
                                @endif
                            </div>
                        @endif

                        <!-- Payment Details -->
                        @if ($rent->payment)
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-xs font-bold uppercase text-gray-600 mb-3">Rincian Pembayaran</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600 flex items-center gap-2">
                                            <i class="fas fa-id-card text-gray-400 w-4"></i>
                                            Order ID
                                        </span>
                                        <code
                                            class="text-xs text-gray-900 bg-white px-2 py-1 rounded">{{ $rent->payment->order_id }}</code>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600 flex items-center gap-2">
                                            <i class="fas fa-money-bill text-gray-400 w-4"></i>
                                            Metode
                                        </span>
                                        <span
                                            class="text-gray-900 font-semibold">{{ ucfirst($rent->payment->method) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600 flex items-center gap-2">
                                            <i class="fas fa-clock text-gray-400 w-4"></i>
                                            Update Terakhir
                                        </span>
                                        <span
                                            class="text-gray-900 font-semibold text-xs">{{ $rent->payment->updated_at->format('d M H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
