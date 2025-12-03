@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    {{-- Page wrapper: flex layout (sidebar + main) --}}
    <div class="min-h-screen bg-bg text-gray-900">
        <div class="flex lg:gap-8">
            {{-- SIDEBAR: sibling dari main, tidak memaksa reflow --}}
            <aside class="flex-none" aria-hidden="false">
                <x-vehicle-filter :filters="$filters" />
            </aside>

            {{-- MAIN: akan mengisi sisa ruang, gunakan min-w-0 supaya konten bisa terpotong tanpa overflow --}}
            <main class="flex-1 min-w-0">
                <div class="max-w-6xl mx-auto px-6 lg:px-10 pt-28 pb-14 space-y-10">
                    <!-- Hero Section -->
                    <section
                        class="bg-linear-to-r from-[#e9f9f4] via-[#f5fbff] to-[#f0f9ff] rounded-3xl p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-white/70">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div class="space-y-3 max-w-3xl">
                                <p class="text-sm font-semibold tracking-wide text-[#00b894] uppercase">Kendaraan Kami</p>
                                <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight">Daftar Kendaraan
                                    Tersedia
                                </h1>
                                <p class="text-gray-600">Temukan kendaraan impian Anda dengan berbagai pilihan tipe dan
                                    transmisi.
                                </p>
                            </div>
                            <div class="bg-white rounded-2xl px-5 py-4 shadow-sm border border-gray-100">
                                <div class="text-sm text-gray-500">Total Kendaraan</div>
                                <div class="text-lg font-semibold text-gray-900">{{ $vehicles->total() }}</div>
                                <div class="mt-1 inline-flex items-center gap-2 text-[#00b894] text-sm font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-[#00b894]"></span> Tersedia
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Main Content -->
                    <div class="flex flex-col lg:flex-row gap-4">
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
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($vehicles as $vehicle)
                                        <x-vehicle-card :vehicle="$vehicle" :rent_date="$filters['rent_date'] ?? null" :return_date="$filters['return_date'] ?? null" />
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                <div class="mt-6">
                                    {{ $vehicles->withQueryString()->links() }}
                                </div>
                            @endif
                        </main>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <x-date-range-modal :rent-date="$filters['rent_date'] ?? ''" :return-date="$filters['return_date'] ?? ''" />
@endsection
