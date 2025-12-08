@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    {{--
        NOTE: Make sure Font Awesome is loaded (e.g. in layouts/app.blade.php):
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    --}}

    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section
            class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-linear-to-br from-teal-50 via-white to-teal-50">
            <div class="relative max-w-7xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 rounded-full bg-linear-to-br from-primary-main to-primary-dark flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-credit-card text-white text-lg"></i>
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
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-6 py-5 border-b border-gray-100 bg-linear-to-r from-teal-50 to-white">
                            <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-circle-plus text-teal-600 w-5 h-5"></i>
                                Detail Kendaraan
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row gap-6">
                                <!-- Vehicle Image -->
                                <div class="w-full sm:w-48 h-32 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if ($rent->vehicle->photo)
                                        <img src="{{ asset('storage/' . $rent->vehicle->photo) }}"
                                            alt="{{ $rent->vehicle->brand }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-image text-4xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Vehicle Info -->
                                <div class="flex-1">
                                    <h4 class="text-2xl font-bold text-gray-900 mb-2">
                                        {{ $rent->vehicle->brand ?? 'Vehicle' }}</h4>
                                    <p class="text-gray-600 mb-4 flex items-center gap-2">
                                        <i class="fa-solid fa-car w-4 h-4"></i>
                                        {{ $rent->vehicle->plate_number ?? '-' }}
                                        <span class="mx-2">•</span>
                                        <i class="fa-solid fa-gear w-4 h-4"></i>
                                        {{ ucfirst($rent->vehicle->transmission ?? '') }}
                                    </p>

                                    <!-- Rental Details -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class="fa-solid fa-calendar-days text-teal-600 w-4 h-4"></i>
                                                <span class="text-sm font-medium text-gray-700">Tanggal Sewa</span>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($rent->rent_date)->format('d M Y') }}</p>
                                        </div>

                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <div class="flex items-center gap-2 mb-1">
                                                <i class="fa-solid fa-calendar-days text-teal-600 w-4 h-4"></i>
                                                <span class="text-sm font-medium text-gray-700">Tanggal Kembali</span>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}</p>
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
                                <i class="fa-solid fa-circle-xmark text-red-400 flex-shrink-0 mt-0.5 w-5 h-5"></i>
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
                                <i class="fa-solid fa-wallet w-5 h-5"></i>
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
                                    <span class="font-semibold">Rp
                                        {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</span>
                                </div>

                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-gray-600">Durasi Sewa</span>
                                    <span class="font-semibold">{{ $rent->rent_date->diffInDays($rent->return_date) + 1 }}
                                        hari</span>
                                </div>

                                <div class="flex justify-between items-center py-3 border-b-2 border-gray-200">
                                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                    <span class="text-2xl font-bold text-teal-600">Rp
                                        {{ number_format($rent->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Payment Button -->
                            <button id="pay-button"
                                class="w-full px-6 py-4 rounded-lg font-bold text-white text-lg transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-lg hover:shadow-xl bg-linear-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 disabled:opacity-50 disabled:cursor-not-allowed"
                                onclick="initiatePayment()">
                                <span id="button-text" class="flex items-center justify-center gap-3">
                                    <i class="fa-solid fa-bolt"></i>
                                    Bayar Sekarang
                                </span>
                                <span id="loading-text" class="hidden flex items-center justify-center gap-3">
                                    <i class="fa-solid fa-spinner animate-spin"></i>
                                    Memproses Pembayaran...
                                </span>
                            </button>

                            <!-- Security Notice -->
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 text-sm text-gray-500 mb-2">
                                    <i class="fa-solid fa-shield-halved text-green-500 w-4 h-4"></i>
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
        // Toggle button text when processing (optional helper)
        function setLoading(loading) {
            const btn = document.getElementById('pay-button');
            const buttonText = document.getElementById('button-text');
            const loadingText = document.getElementById('loading-text');

            if (loading) {
                buttonText.classList.add('hidden');
                loadingText.classList.remove('hidden');
                btn.disabled = true;
            } else {
                buttonText.classList.remove('hidden');
                loadingText.classList.add('hidden');
                btn.disabled = false;
            }
        }

        document.getElementById('pay-button').addEventListener('click', function(e) {
            e.preventDefault();
            setLoading(true);

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
                    setLoading(false);
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    setLoading(false);
                }
            });
        });
    </script>
@endsection
