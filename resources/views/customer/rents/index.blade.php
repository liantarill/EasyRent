@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        @include('layouts.partials.navbar')

        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-br from-teal-50 via-white to-teal-50 opacity-60"></div>
            <div class="relative max-w-6xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 rounded-full bg-linear-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-history text-white text-lg"></i>
                    </div>
                    <h1 class="text-sm font-bold tracking-widest uppercase text-teal-600">Riwayat Penyewaan</h1>
                </div>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4 leading-tight">
                    Kelola Semua Pesanan Rental Anda
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl font-light">
                    Lihat status penyewaan, tracking pembayaran, dan detail kendaraan dengan mudah. Semua informasi ada di
                    satu tempat.
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="px-4 sm:px-6 lg:px-8 pb-20">
            <div class="max-w-6xl mx-auto">
                @if ($rents->count() == 0)
                    <!-- Empty State -->
                    <div class="text-center py-20">
                        <div
                            class="w-20 h-20 mx-auto mb-6 rounded-full bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="fas fa-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum ada penyewaan</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            Mulai petualangan Anda dengan menyewa kendaraan premium kami hari ini
                        </p>
                        <a href="{{ route('customer.vehicles.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-3 bg-linear-to-r from-teal-500 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-teal-500/20 transition-all duration-300">
                            <i class="fas fa-car"></i>
                            Jelajahi Armada
                        </a>
                    </div>
                @else
                    <!-- Stats Bar -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-6 hover:border-teal-300 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium mb-1">Total Penyewaan</p>
                                    <p class="text-3xl font-black text-gray-900">{{ $rents->count() }}</p>
                                </div>
                                <i class="fas fa-car text-3xl text-teal-100"></i>
                            </div>
                        </div>

                        @php
                            $pending = $rents->filter(fn($r) => $r->rent_status === 'Pending Verification')->count();
                            $verified = $rents->filter(fn($r) => $r->rent_status === 'Verified')->count();
                        @endphp

                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-6 hover:border-yellow-300 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium mb-1">Menunggu Verifikasi</p>
                                    <p class="text-3xl font-black text-gray-900">{{ $pending }}</p>
                                </div>
                                <i class="fas fa-clock text-3xl text-yellow-100"></i>
                            </div>
                        </div>

                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-6 hover:border-green-300 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium mb-1">Pesanan Diverifikasi</p>
                                    <p class="text-3xl font-black text-gray-900">{{ $verified }}</p>
                                </div>
                                <i class="fas fa-check-circle text-3xl text-green-100"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Rental Cards Grid -->
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($rents as $rent)
                            <div
                                class="group relative bg-white rounded-2xl border border-gray-200 hover:border-teal-300 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-teal-500/10">
                                <!-- Status Badge -->
                                @php
                                    $status = $rent->rent_status;
                                    $statusIcon = match ($status) {
                                        'Pending Verification' => 'fa-hourglass-half',
                                        'Verified' => 'fa-check-circle',
                                        'Rejected' => 'fa-times-circle',
                                        default => 'fa-question-circle',
                                    };
                                    $badgeColor = match ($status) {
                                        'Pending Verification' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        'Verified' => 'bg-green-50 text-green-700 border-green-200',
                                        'Rejected' => 'bg-red-50 text-red-700 border-red-200',
                                        default => 'bg-gray-50 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <div class="absolute top-4 right-4 z-10">
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                        <i class="fas {{ $statusIcon }}"></i>
                                        {{ $status }}
                                    </span>
                                </div>

                                <!-- Vehicle Image -->
                                <div class="relative h-48 bg-linear-to-br from-gray-100 to-gray-200 overflow-hidden">
                                    @if (optional($rent->vehicle)->photo)
                                        <img src="{{ asset('storage/' . $rent->vehicle->photo) }}"
                                            alt="{{ $rent->vehicle->brand }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-car text-5xl text-gray-300"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <!-- Vehicle Name -->
                                    <h3
                                        class="text-xl font-black text-gray-900 mb-1 group-hover:text-teal-600 transition-colors">
                                        {{ $rent->vehicle->brand ?? 'Kendaraan tidak tersedia' }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                                        <i class="fas fa-tag text-teal-500"></i>
                                        {{ $rent->vehicle->plate_number ?? '-' }}
                                    </p>

                                    <!-- Rental Details -->
                                    <div class="space-y-3 mb-6 text-sm">
                                        <div class="flex items-center justify-between text-gray-600">
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-calendar-alt text-teal-500 w-4"></i>
                                                Mulai
                                            </span>
                                            <span class="font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($rent->rent_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between text-gray-600">
                                            <span class="flex items-center gap-2">
                                                <i class="fas fa-calendar-check text-teal-500 w-4"></i>
                                                Kembali
                                            </span>
                                            <span class="font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Price Section -->
                                    <div class="border-t border-gray-200 pt-4 mb-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-gray-600 text-sm">Harga Per Hari</span>
                                            <span class="font-bold text-teal-600">
                                                Rp {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="font-semibold text-gray-900">Total</span>
                                            <span class="text-2xl font-black text-gray-900">
                                                Rp {{ number_format($rent->total_price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Payment Status -->
                                    <div class="mb-4">
                                        @if ($rent->payment)
                                            @php
                                                $paymentStatus = strtolower($rent->payment->status);
                                                $paymentBadge = match (true) {
                                                    $paymentStatus === 'paid' => [
                                                        'bg-green-50',
                                                        'text-green-700',
                                                        'icon' => 'fa-check',
                                                        'label' => 'Pembayaran Lunas',
                                                    ],
                                                    in_array($paymentStatus, ['pending', 'pending payment']) => [
                                                        'bg-yellow-50',
                                                        'text-yellow-700',
                                                        'icon' => 'fa-clock',
                                                        'label' => 'Pembayaran Tertunda',
                                                    ],
                                                    default => [
                                                        'bg-red-50',
                                                        'text-red-700',
                                                        'icon' => 'fa-times',
                                                        'label' => 'Pembayaran Gagal',
                                                    ],
                                                };
                                            @endphp
                                            <div
                                                class="{{ $paymentBadge[0] }} {{ $paymentBadge[1] }} rounded-lg px-3 py-2 flex items-center gap-2 text-sm font-semibold">
                                                <i class="fas {{ $paymentBadge['icon'] }}"></i>
                                                {{ $paymentBadge['label'] }}
                                            </div>
                                        @else
                                            <div
                                                class="bg-gray-50 text-gray-700 rounded-lg px-3 py-2 flex items-center gap-2 text-sm font-semibold">
                                                <i class="fas fa-exclamation-circle"></i>
                                                Belum Dibayar
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Action Button -->
                                    <a href="{{ route('customer.rents.show', $rent->id) }}"
                                        class="block w-full text-center px-4 py-3 bg-linear-to-r from-teal-500 to-teal-600 text-white font-bold rounded-xl hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-300 group-hover:translate-y-0.5">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $rents->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
