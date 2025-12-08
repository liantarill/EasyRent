 @extends('layouts.app')

@section('content')
    <div class="flex">

        @include('layouts.partials.sidebar')
        <div class="flex-1 min-h-screen bg-linear-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-4 mb-3">
                                <div
                                    class="w-14 h-14 bg-linear-to-br from-primary-main to-primary-light rounded-lg flex items-center justify-center">
                                    <i class="fas fa-file-contract text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">
                                        Detail Sewa
                                    </h1>
                                    <p class="text-sm text-gray-600 mt-1">ID Sewa: <span
                                            class="font-bold text-gray-900">#{{ $rent->id }}</span></p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.rents.index') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-slate-200 hover:bg-slate-300 text-gray-900 font-semibold rounded-lg transition-all text-sm">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-5">

                        <!-- Customer Information -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="px-6 py-4 bg-linear-to-r from-teal-50 to-teal-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-user-circle text-primary-main"></i>Customer
                                </h2>
                            </div>
                            <div class="px-6 py-4 space-y-3">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama</p>
                                    <p class="text-base font-bold text-gray-900 mt-1">{{ $rent->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Email</p>
                                    <p class="text-base text-gray-700 mt-1">{{ $rent->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Information -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="px-6 py-4 bg-linear-to-r from-blue-50 to-blue-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-car text-blue-600"></i>Kendaraan
                                </h2>
                            </div>
                            <div class="px-6 py-4">
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Brand</p>
                                        <p class="text-base font-bold text-gray-900 mt-2">{{ $rent->vehicle->brand }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tipe</p>
                                        <p class="text-base font-bold text-gray-900 mt-2">
                                            {{ $rent->vehicle->vehicle_type ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Nomor Plat
                                        </p>
                                        <p class="text-lg font-black text-blue-600 mt-2 tracking-widest">
                                            {{ $rent->vehicle->plate_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Timeline -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="px-6 py-4 bg-linear-to-r from-purple-50 to-purple-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-purple-600"></i>Periode Rental
                                </h2>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Mulai</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">
                                            <i
                                                class="fas fa-check-circle text-green-500 mr-2"></i>{{ date('d M Y', strtotime($rent->rent_date)) }}
                                        </p>
                                    </div>
                                    <i class="fas fa-arrow-right text-purple-600 text-lg mx-3"></i>
                                    <div class="flex-1 text-right">
                                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Kembali</p>
                                        <p class="text-lg font-bold text-gray-900 mt-1">
                                            {{ date('d M Y', strtotime($rent->return_date)) }}<i
                                                class="fas fa-times-circle text-red-500 ml-2"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Durasi</p>
                                    <p class="text-2xl font-black text-purple-600 mt-2">
                                        {{ \Carbon\Carbon::parse($rent->rent_date)->diffInDays($rent->return_date) }} <span
                                            class="text-sm font-semibold">Hari</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Status -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="px-6 py-4 bg-linear-to-r from-amber-50 to-amber-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-amber-600"></i>Status Rental
                                </h2>
                            </div>
                            <div class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-bold text-sm
                            @if ($rent->rent_status === 'Verified') bg-green-100 text-green-800
                            @elseif($rent->rent_status === 'Pending Verification') bg-yellow-100 text-yellow-800
                            @elseif($rent->rent_status === 'completed') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800 @endif">
                                    <i class="fas fa-circle text-xs"></i>{{ ucfirst($rent->rent_status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar - Pricing & Payment -->
                    <div class="space-y-5">

                        <!-- Pricing Card -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow sticky top-8">
                            <div class="px-6 py-4 bg-linear-to-r from-green-50 to-green-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-tag text-green-600"></i>Harga
                                </h2>
                            </div>
                            <div class="px-6 py-4 space-y-3">
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                    <span class="text-gray-700 font-semibold text-sm">Tarif Harian</span>
                                    <span class="text-base font-bold text-green-600">Rp
                                        {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                    <span class="text-gray-700 font-semibold text-sm">Jumlah Hari</span>
                                    <span
                                        class="text-base font-bold text-gray-900">{{ \Carbon\Carbon::parse($rent->rent_date)->diffInDays($rent->return_date) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-base font-bold text-gray-900">Total</span>
                                    <span class="text-2xl font-black text-green-600">Rp
                                        {{ number_format($rent->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Card -->
                        <div
                            class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="px-6 py-4 bg-linear-to-r from-indigo-50 to-indigo-100 border-b border-slate-100">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-credit-card text-indigo-600"></i>Pembayaran
                                </h2>
                            </div>
                            <div class="px-6 py-4 space-y-3">
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Metode</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1">
                                        <i class="fas fa-wallet text-indigo-600 mr-2"></i>
                                        {{ ucfirst($rent->payment->method) ?? 'Belum Dibayar' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Status</p>
                                    @php
                                        $statusClass = match ($rent->payment?->status ?? 'unpaid') {
                                            'Paid' => 'bg-green-100 text-green-800',
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'failed' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full font-bold text-xs {{ $statusClass }}">
                                        <i class="fas fa-circle text-xs"></i>
                                        {{ $rent->payment?->status ? ucfirst($rent->payment->status) : 'Belum Dibayar' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
