@extends('layouts.app')

@section('content')

    <div class="flex">
        @include('layouts.partials.sidebar')
        <div class="flex-1 bg-linear-to-br from-gray-50 via-white to-gray-100">
            <!-- Header -->
            <div class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
                <div class="max-w-6xl mx-auto px-6 py-8">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.vehicles.index') }}" class="text-teal-600 hover:text-teal-700">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Tambah Kendaraan Baru</h1>
                            <p class="text-gray-600 mt-2 font-light">Masukkan detail kendaraan baru</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-6xl mx-auto px-6 py-12">
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

                <!-- Form -->
                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data"
                    class="bg-white rounded-2xl shadow-lg p-8 border-0">
                    @csrf

                    <!-- Photo Section -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-image text-teal-600"></i>
                            Foto Kendaraan
                        </h2>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-upload text-teal-600 mr-2"></i>
                                Unggah Foto
                            </label>
                            <input type="file" name="photo" accept="image/*" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, WebP (Max: 2MB)</p>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Basic Information -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-info-circle text-teal-600"></i>
                            Informasi Dasar
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Brand -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-car text-teal-600 mr-2"></i>
                                    Brand
                                </label>
                                <input type="text" name="brand" value="{{ old('brand') }}" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            </div>

                            <!-- Year -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-calendar text-teal-600 mr-2"></i>
                                    Tahun
                                </label>
                                <input type="number" name="year" value="{{ old('year') }}" required min="1990"
                                    max="{{ date('Y') + 1 }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            </div>

                            <!-- Plate Number -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-certificate text-teal-600 mr-2"></i>
                                    Nomor Plat
                                </label>
                                <input type="text" name="plate_number" value="{{ old('plate_number') }}" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            </div>

                            <!-- Vehicle Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tag text-teal-600 mr-2"></i>
                                    Tipe Kendaraan
                                </label>
                                <select name="vehicle_type" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300">
                                    <option value="">-- Pilih Tipe --</option>
                                    <option value="car" @selected(old('vehicle_type') === 'car')>Mobil</option>
                                    <option value="motorcycle" @selected(old('vehicle_type') === 'motorcycle')>Motor</option>
                                    <option value="truck" @selected(old('vehicle_type') === 'truck')>Truk</option>
                                    <option value="bus" @selected(old('vehicle_type') === 'bus')>Bus</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Technical Specifications -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-wrench text-teal-600"></i>
                            Spesifikasi Teknis
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Transmission -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-cog text-teal-600 mr-2"></i>
                                    Transmisi
                                </label>
                                <select name="transmission" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300">
                                    <option value="">-- Pilih Transmisi --</option>
                                    <option value="manual" @selected(old('transmission') === 'manual')>Manual</option>
                                    <option value="automatic" @selected(old('transmission') === 'automatic')>Otomatis</option>
                                </select>
                            </div>

                            <!-- Fuel Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-gas-pump text-teal-600 mr-2"></i>
                                    Jenis Bahan Bakar
                                </label>
                                <select name="fuel_type" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300">
                                    <option value="">-- Pilih Bahan Bakar --</option>
                                    <option value="gasoline" @selected(old('fuel_type') === 'gasoline')>Bensin</option>
                                    <option value="diesel" @selected(old('fuel_type') === 'diesel')>Diesel</option>
                                    <option value="electric" @selected(old('fuel_type') === 'electric')>Listrik</option>
                                    <option value="hybrid" @selected(old('fuel_type') === 'hybrid')>Hybrid</option>
                                </select>
                            </div>

                            <!-- Capacity -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-users text-teal-600 mr-2"></i>
                                    Kapasitas Penumpang
                                </label>
                                <input type="number" name="capacity" value="{{ old('capacity') }}" required min="1"
                                    max="10"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-toggle-on text-teal-600 mr-2"></i>
                                    Status
                                </label>
                                <select name="status" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="available" @selected(old('status') === 'available')>Tersedia</option>
                                    <option value="rented" @selected(old('status') === 'rented')>Disewa</option>
                                    <option value="maintenance" @selected(old('status') === 'maintenance')>Maintenance</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr class="my-8 border-gray-200">

                    <!-- Pricing & Description -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <i class="fas fa-money-bill text-teal-600"></i>
                            Harga & Deskripsi
                        </h2>
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Price Per Day -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-tag text-teal-600 mr-2"></i>
                                    Harga Per Hari (Rp)
                                </label>
                                <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" required
                                    min="0" step="1000"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-align-left text-teal-600 mr-2"></i>
                                    Deskripsi
                                </label>
                                <textarea name="description" rows="5"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300">{{ old('description') }}</textarea>
                                <p class="text-xs text-gray-500 mt-2">Jelaskan fitur dan kondisi kendaraan secara detail
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4 pt-8 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class="fas fa-plus"></i>
                            Tambah Kendaraan
                        </button>
                        <a href="{{ route('admin.vehicles.index') }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-8 py-3 border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-300">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
