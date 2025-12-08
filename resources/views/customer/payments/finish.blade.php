@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section
            class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-linear-to-br from-teal-50 via-white to-teal-50">
            <div class="relative max-w-7xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 rounded-full bg-linear-to-br from-primary-main to-primary-dark flex items-center justify-center shadow-lg">
                        @if (strtolower($payment->status) === 'paid')
                            <i class="fas fa-check text-white text-lg"></i>
                        @else
                            <i class="fas fa-clock text-white text-lg"></i>
                        @endif
                    </div>
                    <h1 class="text-sm font-bold tracking-widest uppercase text-primary-main">Status Pembayaran</h1>
                </div>

                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4 leading-tight">
                    @if (strtolower($payment->status) === 'paid')
                        Pembayaran Berhasil!
                    @else
                        Pembayaran {{ ucfirst($payment->status) }}
                    @endif
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl font-light">
                    @if (strtolower($payment->status) === 'paid')
                        Selamat! Sewa kendaraan Anda telah dikonfirmasi. Detail pesanan telah dikirim ke email Anda.
                    @else
                        @if (strtolower($payment->status) === 'pending')
                            Pembayaran Anda sedang diproses. Kami akan mengirim notifikasi setelah pembayaran selesai.
                        @else
                            Silakan periksa status pembayaran Anda atau hubungi customer service jika ada pertanyaan.
                        @endif
                    @endif
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="px-6 py-5 border-b border-gray-100
                            @if (strtolower($payment->status) === 'paid')
                                bg-linear-to-r from-green-50 to-emerald-50
                            @else
                                bg-linear-to-r from-yellow-50 to-amber-50
                            @endif">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            @if (strtolower($payment->status) === 'paid')
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                @if (strtolower($payment->status) === 'paid')
                                    Pembayaran Berhasil
                                @else
                                    Pembayaran {{ ucfirst($payment->status) }}
                                @endif
                            </h3>
                            <p class="text-gray-600 mt-1">
                                @if (strtolower($payment->status) === 'paid')
                                    Pesanan Anda telah dikonfirmasi dan kendaraan siap digunakan sesuai jadwal.
                                @else
                                    @if (strtolower($payment->status) === 'pending')
                                        Pembayaran sedang diproses oleh sistem pembayaran.
                                    @else
                                        Silakan periksa kembali atau hubungi support jika ada masalah.
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Order Details Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">ID Pesanan</p>
                                    <p class="font-mono font-bold text-gray-900">{{ $payment->order_id }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Kendaraan</p>
                                    <p class="font-semibold text-gray-900">{{ $payment->rent->vehicle->brand }}</p>
                                    <p class="text-sm text-gray-600">{{ $payment->rent->vehicle->plate_number }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Periode Sewa</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($payment->rent->rent_date)->format('d M Y') }}
                                    </p>
                                    <p class="text-sm text-gray-600">s/d
                                        {{ \Carbon\Carbon::parse($payment->rent->return_date)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Total Pembayaran</p>
                                    <p class="text-2xl font-bold text-teal-600">Rp
                                        {{ number_format($payment->amount, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Metode Pembayaran</p>
                                    <p class="font-semibold text-gray-900">{{ ucfirst($payment->method) }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <svg class="w-5 h-5 text-teal-600 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                                @if (strtolower($payment->status) === 'paid')
                                                    bg-green-100 text-green-700
                                                @else
                                                    bg-yellow-100 text-yellow-700
                                                @endif">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('customer.rents.show', $payment->rent->id) }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Detail Pesanan
                </a>

                <a href="{{ route('customer.rents.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-semibold text-white bg-linear-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Semua Transaksi
                </a>
            </div>

            @if (strtolower($payment->status) === 'paid')
                <!-- Success Message -->
                <div class="mt-8 text-center">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 border border-green-200 rounded-lg">
                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-green-800">Email konfirmasi telah dikirim ke alamat email
                            Anda</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection