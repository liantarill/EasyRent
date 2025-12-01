@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        @include('layouts.partials.navbar')

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
            <!-- Back Button -->
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-semibold mb-12 transition-colors">
                <i class="fas fa-chevron-left"></i>
                Kembali
            </a>

            <!-- Header -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-14 h-14 rounded-full bg-linear-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <h1 class="text-5xl font-black text-gray-900">
                        Pesan {{ $vehicle->brand }}
                    </h1>
                </div>
                <p class="text-xl text-gray-600 max-w-2xl font-light">
                    Pilih tanggal penyewaan dan selesaikan pemesanan Anda dengan mudah
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="lg:col-span-2">
                    <form action="{{ route('customer.rents.store', $vehicle->id) }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Vehicle Preview Card -->
                        <div
                            class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-teal-300 transition-colors">
                            <div
                                class="h-40 bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden">
                                @if ($vehicle->photo)
                                    <img src="{{ asset('storage/' . $vehicle->photo) }}" alt="{{ $vehicle->brand }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-car text-6xl text-gray-300"></i>
                                @endif
                            </div>

                            <div class="p-6">
                                <h2 class="text-2xl font-black text-gray-900 mb-2">{{ $vehicle->brand }}</h2>
                                <p class="text-gray-600 mb-4 flex items-center gap-2">
                                    <i class="fas fa-tag text-teal-500"></i>
                                    {{ $vehicle->plate_number }}
                                </p>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 mb-1">Tahun</p>
                                        <p class="font-bold text-gray-900">{{ $vehicle->year }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 mb-1">Transmisi</p>
                                        <p class="font-bold text-gray-900">{{ $vehicle->transmission }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 mb-1">Bahan Bakar</p>
                                        <p class="font-bold text-gray-900">{{ $vehicle->fuel_type }}</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-600 mb-1">Kapasitas</p>
                                        <p class="font-bold text-gray-900">{{ $vehicle->capacity }} Penumpang</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Selection Section -->
                        <div class="space-y-6">
                            <h3 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                                <i class="fas fa-calendar-days text-teal-500"></i>
                                Pilih Tanggal Penyewaan
                            </h3>

                            <!-- Rent Date -->
                            <div>
                                <label for="rent_date"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-play-circle text-teal-500 mr-2"></i>
                                    Tanggal Mulai Sewa
                                </label>
                                <div class="relative">
                                    <input type="date" id="rent_date" name="rent_date" value="{{ old('rent_date') }}"
                                        min="{{ \Carbon\Carbon::today()->toDateString() }}" required
                                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold @error('rent_date') border-red-500 @enderror">
                                    <i
                                        class="fas fa-calendar-alt absolute right-4 top-4 text-gray-400 pointer-events-none text-lg"></i>
                                </div>
                                @error('rent_date')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Return Date -->
                            <div>
                                <label for="return_date"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-stop-circle text-orange-500 mr-2"></i>
                                    Tanggal Pengembalian
                                </label>
                                <div class="relative">
                                    <input type="date" id="return_date" name="return_date"
                                        value="{{ old('return_date') }}"
                                        min="{{ \Carbon\Carbon::today()->toDateString() }}" required
                                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold @error('return_date') border-red-500 @enderror">
                                    <i
                                        class="fas fa-calendar-alt absolute right-4 top-4 text-gray-400 pointer-events-none text-lg"></i>
                                </div>
                                @error('return_date')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Price Info -->
                            <div class="bg-linear-to-br from-teal-50 to-cyan-50 border-2 border-teal-200 rounded-xl p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-gray-700 font-semibold flex items-center gap-2">
                                        <i class="fas fa-tag text-teal-600"></i>
                                        Harga Per Hari
                                    </span>
                                    <span class="text-2xl font-black text-teal-600">
                                        Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Pilih kedua tanggal untuk melihat total harga</p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-8 py-4 bg-linear-to-r from-teal-600 to-teal-500 text-white font-black text-lg rounded-xl hover:shadow-xl hover:shadow-teal-500/30 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-check-circle"></i>
                            Lanjutkan & Buat Pesanan
                        </button>
                    </form>
                </div>

                <!-- Info Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Info Card 1 -->
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 hover:border-teal-300 transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-full bg-linear-to-br from-teal-100 to-cyan-100 flex items-center justify-center">
                                <i class="fas fa-info-circle text-teal-600 text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900">Informasi Penting</h3>
                        </div>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Verifikasi data akan dilakukan setelah pemesanan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Pembayaran dapat dilakukan sebelum pengambilan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Asuransi sudah termasuk dalam harga</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Info Card 2 -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:border-orange-300 transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-full bg-linear-to-br from-orange-100 to-amber-100 flex items-center justify-center">
                                <i class="fas fa-headset text-orange-600 text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900">Butuh Bantuan?</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-4">
                            Tim customer service kami siap membantu Anda 24/7
                        </p>
                        <div class="space-y-2">
                            <a href="tel:0812345678"
                                class="block text-center px-4 py-2 bg-orange-50 text-orange-600 font-bold rounded-lg hover:bg-orange-100 transition-colors">
                                <i class="fas fa-phone mr-2"></i>
                                (021) 1234-5678
                            </a>
                            <a href="mailto:support@rental.com"
                                class="block text-center px-4 py-2 bg-blue-50 text-blue-600 font-bold rounded-lg hover:bg-blue-100 transition-colors">
                                <i class="fas fa-envelope mr-2"></i>
                                easyrent@gmail.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
