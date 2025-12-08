@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-linear-to-br from-teal-50 via-white to-teal-50">
            <div class="relative max-w-7xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-linear-to-br from-primary-main to-primary-dark flex items-center justify-center shadow-lg">
                        <i class="fas fa-credit-card text-white text-lg"></i>
                    </div>
                    <h1 class="text-sm font-bold tracking-widest uppercase text-primary-main">Pembayaran</h1>
                </div>

                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4 leading-tight">
                    Selesaikan Pembayaran
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl font-light">
                    Tinjau detail pesanan Anda dan selesaikan pembayaran dengan aman.
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Order Summary -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Vehicle Details Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-6 py-5 border-b border-gray-100 bg-linear-to-r from-teal-50 to-white">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                                </svg>
                                Detail Kendaraan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row gap-6">
                                <!-- Vehicle Image -->
                                <div class="w-full sm:w-48 h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if ($rent->vehicle->photo)
                                        <img src="{{ asset('storage/' . $rent->vehicle->photo) }}" alt="{{ $rent->vehicle->brand }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Vehicle Info -->
                                <div class="flex-1">
                                    <h4 class="text-2xl font-bold text-gray-900 mb-2">{{ $rent->vehicle->brand ?? 'Vehicle' }}</h4>
                                    <p class="text-gray-600 mb-4 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                        </svg>
                                        {{ $rent->vehicle->plate_number ?? '-' }}
                                        <span class="mx-2">•</span>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ ucfirst($rent->vehicle->transmission ?? '') }}
                                    </p>

                                    <!-- Rental Details -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Tanggal Sewa</span>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($rent->rent_date)->format('d M Y') }}</p>
                                        </div>

                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <div class="flex items-center gap-2 mb-1">
                                                <svg class="w-4 h-4 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-700">Tanggal Kembali</span>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-900">{{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Alert -->
                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
                            <div class="flex gap-3">
                                <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h3 class="font-semibold text-red-800 mb-1">Terjadi Kesalahan</h3>
                                    <p class="text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Payment Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <div class="px-6 py-5 border-b border-gray-100 bg-linear-to-r from-teal-600 to-teal-700">
                            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                Ringkasan Pembayaran
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Order ID -->
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-1">ID Pesanan</p>
                                <p class="font-mono font-bold text-gray-900 text-lg">{{ $payment->order_id }}</p>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Harga Harian</span>
                                    <span class="font-semibold">Rp {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Durasi Sewa</span>
                                    <span class="font-semibold">{{ $rent->rent_date->diffInDays($rent->return_date) + 1 }} hari</span>
                                </div>

                                <div class="flex justify-between items-center py-3 border-b-2 border-gray-200">
                                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                    <span class="text-2xl font-bold text-teal-600">Rp {{ number_format($rent->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Payment Button -->
                            <button id="pay-button"
                                class="w-full px-6 py-4 rounded-lg font-bold text-white text-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl bg-linear-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 disabled:opacity-50 disabled:cursor-not-allowed"
                                onclick="initiatePayment()">
                                <span id="button-text" class="flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 010 2h3a1 1 0 011 1v3a1 1 0 01-2 0V6h-3a1 1 0 010-2zm0 8a1 1 0 010 2h3v2a1 1 0 102 0v-3a1 1 0 011-1h3a1 1 0 010 2h-3z" clip-rule="evenodd"/>
                                    </svg>
                                    Bayar Sekarang
                                </span>
                                <span id="loading-text" class="hidden flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 animate-spin" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                                    </svg>
                                    Memproses Pembayaran...
                                </span>
                            </button>

                            <!-- Security Notice -->
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 text-sm text-gray-500 mb-2">
                                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Pembayaran Aman & Terjamin</span>
                                </div>
                                <p class="text-xs text-gray-400">Powered by Midtrans</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.location.href = '{{ route('customer.payments.finish', $payment->id) }}';
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = '{{ route('customer.payments.finish', $payment->id) }}';
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Payment failed! Please try again.');
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        };
    </script>
@endsection
