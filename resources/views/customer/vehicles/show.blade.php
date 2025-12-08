@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')
    @php
        $customer = auth()->user();
        $canRent = $customer && $customer->hasCompletedProfile();
    @endphp
    <div class="min-h-screen" style="background-color: #f9fafb;">
        <!-- Back Button & Header -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6">
            <a href="{{ route('customer.vehicles.index') }}"
                class="inline-flex items-center gap-2 mb-8 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="font-medium">Kembali ke daftar kendaraan</span>
            </a>

            <!-- Added error alert with teal styling -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg border-l-4"
                    style="border-left-color: #0d9488; background-color: #f0fdfa; color: #0f766e;">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold mb-2">Terjadi kesalahan:</h3>
                            <ul class="space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <!-- Photo Gallery Section -->
            @if ($vehicle->photo)
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="relative bg-gray-900 aspect-video">
                        <img src="{{ asset('storage/' . $vehicle->photo) }}" alt="{{ $vehicle->brand }}"
                            class="w-full h-full object-cover">
                        <!-- Photo overlay badge -->
                        <div class="absolute top-4 right-4 px-4 py-2 rounded-lg font-semibold text-sm"
                            style="background-color: rgba(20, 184, 166, 0.9); color: white;">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z">
                                    </path>
                                </svg>
                                Galeri Foto
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <!-- Placeholder for missing photo -->
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg bg-white border-2 border-dashed border-gray-300">
                    <div class="flex items-center justify-center aspect-video bg-gray-50">
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z">
                                </path>
                            </svg>
                            <p class="text-gray-500 font-medium">Foto kendaraan tidak tersedia</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Title Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $vehicle->brand }}</h1>
                <p class="text-gray-600 text-lg">Detail kendaraan lengkap tersedia di bawah</p>
            </div>

            <!-- Main Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column - Vehicle Info & Description -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Vehicle Information Card -->
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div class="px-6 py-5 border-b border-gray-100"
                            style="background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%);">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-5 h-5" style="color: #14b8a6;" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 012-2 1 1 0 000-2H3a3 3 0 00-3 3v7a3 3 0 003 3h14a3 3 0 003-3V5a3 3 0 00-3-3h-1a1 1 0 000 2h1a1 1 0 011 1v7a1 1 0 01-1 1H3a1 1 0 01-1-1V5z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Info Kendaraan
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="grid sm:grid-cols-2 gap-6">
                                <!-- Brand / Model -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Merek / Model</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $vehicle->brand }}</p>
                                </div>

                                <!-- Type -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Jenis</p>
                                    <div class="inline-block px-3 py-1 rounded-full text-sm font-medium"
                                        style="background-color: #ccfbf1; color: #0d9488;">
                                        {{ ucfirst($vehicle->vehicle_type) }}
                                    </div>
                                </div>

                                <!-- Year -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Tahun Produksi</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $vehicle->year }}</p>
                                </div>

                                <!-- Plate Number -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Plat Nomor</p>
                                    <p class="text-lg font-mono font-bold text-gray-900" style="color: #14b8a6;">
                                        {{ $vehicle->plate_number }}</p>
                                </div>

                                <!-- Transmission -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Transmisi</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($vehicle->transmission) }}</p>
                                </div>

                                <!-- Fuel Type -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Bahan Bakar</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ ucfirst($vehicle->fuel_type) }}</p>
                                </div>

                                <!-- Capacity -->
                                <div class="pb-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-500 mb-1">Kapasitas Penumpang</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-lg font-semibold text-gray-900">{{ $vehicle->capacity }}</p>
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="pt-4 border-t border-gray-100">
                                <p class="text-sm font-medium text-gray-500 mb-2">Deskripsi</p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $vehicle->description ?? 'Tidak ada deskripsi tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Pricing & Action -->
                <div class="lg:col-span-1">
                    <!-- Pricing Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <div class="px-6 py-5 border-b border-gray-100"
                            style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M8.16 5.314l4.897-1.596A1 1 0 0114.25 5v.7a1 1 0 01-.056.312l-1.285 4.227a1 1 0 00.075 1.028l2.849 4.035a1 1 0 01-1.624 1.205l-2.95-4.186a1 1 0 00-.818-.366h-.03a1 1 0 00-.817.366L5.75 16.51a1 1 0 01-1.624-1.205l2.85-4.035a1 1 0 00.074-1.028l-1.285-4.227A1 1 0 005.75 5.7V5a1 1 0 00-1.597-.918l4.897 1.596a.5.5 0 01.11.036z">
                                    </path>
                                </svg>
                                Harga & Status
                            </h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Price -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Harga Sewa Per Hari</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $vehicle->formatted_price }}</p>
                            </div>

                            <!-- Status Badge -->
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Status Kendaraan</p>
                                <span class="inline-block px-4 py-2 rounded-lg font-semibold text-sm"
                                    style="background-color: #ccfbf1; color: #0d9488;">
                                    {{ $vehicle->status }}
                                </span>
                            </div>

                            <!-- CTA Button -->
                            @if ($canRent)
                                <!-- Enhanced rent button with teal styling and hover effects -->
                                <form action="{{ route('customer.rents.create', $vehicle->id) }}" method="GET"
                                    class="pt-4">
                                    <button type="submit"
                                        class="w-full px-6 py-3 rounded-lg font-semibold text-white transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-md hover:shadow-lg"
                                        style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                            Sewa Sekarang
                                        </span>
                                    </button>
                                </form>
                            @else
                                <!-- Profile incomplete warning card with improved styling -->
                                <div class="rounded-lg border-l-4 p-4 space-y-3"
                                    style="border-left-color: #f59e0b; background-color: #fffbeb; color: #78350f;">
                                    <div class="flex gap-3">
                                        <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <h3 class="font-semibold mb-1">Profil Anda belum lengkap</h3>
                                            <p class="text-sm mb-3">Lengkapi data diri Anda sebelum melakukan peminjaman
                                                kendaraan.</p>
                                            <a href="{{ route('customer.profile') }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                                                style="background-color: #fcd34d; color: #78350f;">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                                Lengkapi Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
