@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white">
        @include('layouts.partials.navbar')

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
            <!-- Back Button -->
            <a href="{{ route('customer.rents.create', $rent->vehicle->id) }}"
                class="inline-flex items-center gap-2 text-teal-600 hover:text-teal-700 font-semibold mb-12 transition-colors">
                <i class="fas fa-chevron-left"></i>
                Kembali
            </a>

            <!-- Header -->
            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-14 h-14 rounded-full bg-linear-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                        <i class="fas fa-clipboard-list text-white text-2xl"></i>
                    </div>
                    <h1 class="text-5xl font-black text-gray-900">
                        Lengkapi Detail Penyewaan
                    </h1>
                </div>
                <p class="text-xl text-gray-600 max-w-2xl font-light">
                    Berikan informasi tambahan untuk menyelesaikan pemesanan {{ $rent->vehicle->brand }}
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="lg:col-span-2">
                    <form action="{{ route('customer.rents.updateDetails', $rent->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Vehicle Summary -->
                        <div
                            class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:border-teal-300 transition-colors">
                            <div
                                class="h-32 bg-linear-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden">
                                @if ($rent->vehicle->photo)
                                    <img src="{{ asset('storage/' . $rent->vehicle->photo) }}" alt="{{ $rent->vehicle->brand }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-car text-6xl text-gray-300"></i>
                                @endif
                            </div>

                            <div class="p-6">
                                <h2 class="text-2xl font-black text-gray-900 mb-2">{{ $rent->vehicle->brand }}</h2>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Tanggal Sewa:</span>
                                        <p class="font-semibold">{{ $rent->rent_date->format('d M Y') }}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600">Tanggal Kembali:</span>
                                        <p class="font-semibold">{{ $rent->return_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Total Harga:</span>
                                        <span class="text-2xl font-black text-teal-600">
                                            Rp {{ number_format($rent->total_price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details Section -->
                        <div class="space-y-6">
                            <h3 class="text-2xl font-black text-gray-900 flex items-center gap-3">
                                <i class="fas fa-info-circle text-teal-500"></i>
                                Informasi Tambahan
                            </h3>

                            <!-- Purpose -->
                            <div>
                                <label for="purpose"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-question-circle text-teal-500 mr-2"></i>
                                    Tujuan Penyewaan
                                </label>
                                <select id="purpose" name="purpose"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold @error('purpose') border-red-500 @enderror">
                                    <option value="">Pilih tujuan penyewaan (opsional)</option>
                                    <option value="wisata" {{ old('purpose', $rent->purpose) == 'wisata' ? 'selected' : '' }}>
                                        Wisata</option>
                                    <option value="bisnis" {{ old('purpose', $rent->purpose) == 'bisnis' ? 'selected' : '' }}>
                                        Bisnis</option>
                                    <option value="keluarga" {{ old('purpose', $rent->purpose) == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                    <option value="transportasi" {{ old('purpose', $rent->purpose) == 'transportasi' ? 'selected' : '' }}>Transportasi</option>
                                    <option value="lainnya" {{ old('purpose', $rent->purpose) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('purpose')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pickup Location -->
                            <div>
                                <label for="pickup_location"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-map-marker-alt text-teal-500 mr-2"></i>
                                    Lokasi Pengambilan
                                </label>
                                <input type="text" id="pickup_location" name="pickup_location"
                                    value="{{ old('pickup_location', $rent->pickup_location) }}"
                                    placeholder="Contoh: Bandara Soekarno-Hatta, Jakarta"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold @error('pickup_location') border-red-500 @enderror">
                                @error('pickup_location')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Dropoff Location -->
                            <div>
                                <label for="dropoff_location"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-map-marker text-orange-500 mr-2"></i>
                                    Lokasi Pengembalian
                                </label>
                                <input type="text" id="dropoff_location" name="dropoff_location"
                                    value="{{ old('dropoff_location', $rent->dropoff_location) }}"
                                    placeholder="Contoh: Bandara Soekarno-Hatta, Jakarta"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold @error('dropoff_location') border-red-500 @enderror">
                                @error('dropoff_location')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Notes -->
                            <div>
                                <label for="notes"
                                    class="block text-sm font-bold uppercase tracking-widest text-gray-700 mb-3">
                                    <i class="fas fa-sticky-note text-blue-500 mr-2"></i>
                                    Catatan Khusus
                                </label>
                                <textarea id="notes" name="notes" rows="4"
                                    placeholder="Tambahkan catatan khusus jika ada (opsional)"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all duration-300 text-gray-900 font-semibold resize-none @error('notes') border-red-500 @enderror">{{ old('notes', $rent->notes) }}</textarea>
                                @error('notes')
                                    <p class="text-red-600 text-sm font-semibold mt-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-8 py-4 bg-linear-to-r from-teal-600 to-teal-500 text-white font-black text-lg rounded-xl hover:shadow-xl hover:shadow-teal-500/30 hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                            <i class="fas fa-credit-card"></i>
                            Lanjutkan ke Pembayaran
                        </button>
                    </form>
                </div>

                <!-- Info Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Progress Card -->
                    <div
                        class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 hover:border-teal-300 transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-full bg-linear-to-br from-teal-100 to-cyan-100 flex items-center justify-center">
                                <i class="fas fa-tasks text-teal-600 text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900">Progres Pemesanan</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-600">Pilih Tanggal</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-teal-500 flex items-center justify-center">
                                    <i class="fas fa-circle text-white text-xs"></i>
                                </div>
                                <span class="text-sm font-semibold text-teal-600">Lengkapi Detail</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-circle text-gray-500 text-xs"></i>
                                </div>
                                <span class="text-sm text-gray-500">Pembayaran</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 hover:border-orange-300 transition-colors">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 rounded-full bg-linear-to-br from-orange-100 to-amber-100 flex items-center justify-center">
                                <i class="fas fa-lightbulb text-orange-600 text-lg"></i>
                            </div>
                            <h3 class="font-bold text-gray-900">Tips</h3>
                        </div>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Informasi lokasi akan membantu kami menyiapkan kendaraan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Catatan khusus akan diproses oleh tim kami</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check text-teal-500 mt-1 shrink-0"></i>
                                <span>Semua field bersifat opsional</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection