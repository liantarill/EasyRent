@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    <div>
        <!-- Hero Section -->
        <section
            class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-linear-to-br from-teal-50 via-white to-teal-50">
            <div class="relative max-w-7xl mx-auto">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-12 h-12 rounded-full bg-linear-to-br from-primary-main to-primary-dark flex items-center justify-center shadow-lg">
                        <i class="fas fa-car text-white text-lg"></i>
                    </div>
                    <h1 class="text-sm font-bold tracking-widest uppercase text-primary-main">Kendaraan Kami</h1>
                </div>

                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-4 leading-tight">
                    Daftar Kendaraan Tersedia
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl font-light">
                    Temukan kendaraan impian Anda dengan berbagai pilihan tipe dan transmisi.
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <div class="bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Sidebar Filters -->
                    <aside class="w-full lg:w-72 lg:sticky lg:top-24 h-fit">
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow"
                            style="background: var(--color-bg);">
                            <div class="flex items-center gap-2 mb-5">
                                <i class="fas fa-filter text-primary-main text-lg"></i>
                                <h2 class="text-lg font-bold text-gray-900">Filter Pencarian</h2>
                            </div>

                            <form method="GET" class="space-y-5">
                                <!-- Search -->
                                <div>
                                    <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-search text-primary-main mr-2"></i>Cari Kendaraan
                                    </label>
                                    <input type="text" id="search" name="search"
                                        value="{{ $filters['search'] ?? '' }}" placeholder="Merek / Plat Nomor"
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition" />
                                </div>

                                <!-- Hidden Date Inputs -->
                                <input type="hidden" id="rent_date" name="rent_date"
                                    value="{{ $filters['rent_date'] ?? '' }}">
                                <input type="hidden" id="return_date" name="return_date"
                                    value="{{ $filters['return_date'] ?? '' }}">

                                <!-- Date Range -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-calendar text-primary-main mr-2"></i>Tanggal Sewa
                                    </label>
                                    <button type="button" id="dateRangeBtn"
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-left text-sm bg-white hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-primary-main">
                                        <span id="dateRangeDisplay" class="text-gray-600 font-medium">
                                            @if (($filters['rent_date'] ?? '') && ($filters['return_date'] ?? ''))
                                                {{ \Carbon\Carbon::parse($filters['rent_date'])->format('d M Y') }}

                                                {{ \Carbon\Carbon::parse($filters['return_date'])->format('d M Y') }}
                                            @else
                                                Pilih Tanggal Sewa
                                            @endif
                                        </span>
                                    </button>
                                </div>

                                <!-- Type Filter -->
                                <div>
                                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-cube text-primary-main mr-2"></i>Tipe Kendaraan
                                    </label>
                                    <select id="type" name="type"
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition bg-white">
                                        <option value="">Semua Tipe</option>
                                        <option value="car" @selected(($filters['type'] ?? '') === 'car')>Mobil</option>
                                        <option value="motorcycle" @selected(($filters['type'] ?? '') === 'motorcycle')>Motor</option>
                                    </select>
                                </div>

                                <!-- Transmission Filter -->
                                <div>
                                    <label for="transmission" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-cog text-primary-main mr-2"></i>Transmisi
                                    </label>
                                    <select id="transmission" name="transmission"
                                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition bg-white">
                                        <option value="">Semua</option>
                                        <option value="automatic" @selected(($filters['transmission'] ?? '') === 'automatic')>Automatic</option>
                                        <option value="manual" @selected(($filters['transmission'] ?? '') === 'manual')>Manual</option>
                                    </select>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-3 pt-2">
                                    <button type="submit"
                                        class="flex-1 px-4 py-2.5 rounded-lg bg-linear-to-r from-primary-main to-primary-dark text-white font-semibold hover:shadow-md active:scale-95 focus:outline-none focus:ring-2 focus:ring-primary-light transition">
                                        <i class="fas fa-check mr-2"></i>Filter
                                    </button>
                                    <a href="{{ route('customer.vehicles.index') }}"
                                        class="px-4 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-700 bg-white hover:bg-gray-50 active:scale-95 transition font-medium">
                                        <i class="fas fa-redo mr-1"></i>Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </aside>

                    <!-- Main Grid -->
                    <main class="flex-1">
                        @if ($vehicles->isEmpty())
                            <div
                                class="border-dashed border-2 border-gray-300 p-12 rounded-2xl bg-linear-to-br from-gray-50 to-white text-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                <strong class="text-lg text-gray-900 block">Tidak ada kendaraan yang cocok.</strong>
                                <p class="text-sm text-gray-600 mt-2">Ubah filter atau hubungi admin untuk ketersediaan
                                    terbaru.</p>
                            </div>
                        @else
                            <!-- Vehicle Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach ($vehicles as $vehicle)
                                    <x-vehicle-card :vehicle="$vehicle" :rent_date="$filters['rent_date'] ?? null" :return_date="$filters['return_date'] ?? null" />
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="mt-10">
                                {{ $vehicles->withQueryString()->links() }}
                            </div>
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </div>

    <x-date-range-modal :rent-date="$filters['rent_date'] ?? ''" :return-date="$filters['return_date'] ?? ''" />
@endsection
