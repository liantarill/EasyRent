@props(['filters'])

@php
    $id = 'vehicleFilter_' . uniqid();
    $COLLAPSED_KEY = $id . '_collapsed';
@endphp

<aside id="{{ $id }}"
    class="z-20 w-full min-h-screen hidden lg:flex lg:w-72 lg:sticky  top-0   h-fit transition-all duration-200 ease-in-out">
    <div class="bg-white border overflow-visible border-gray-100 pt-25 rounded-2xl shadow-sm relative">
        <!-- Header -->
        <div class="flex items-center justify-between gap-2 p-4 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-primary-main text-lg"></i>
                <h2 class="text-lg font-bold text-gray-900 hide-when-collapsed transition-opacity duration-200">
                    Filter Pencarian
                </h2>
            </div>

            <!-- Toggle Button (rotates based on state) -->
            <button id="{{ $id }}_ToggleBtn" type="button"
                class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-gray-100 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary-main"
                aria-expanded="true" title="Toggle filter">
                <span class="sr-only">Toggle filter</span>
                <i class="fas fa-chevron-left transition-transform duration-300"></i>
            </button>
        </div>

        <!-- Body -->
        <div id="{{ $id }}_Body" class="p-6 filter-body">
            @if (empty($filters['rent_date']) || empty($filters['return_date']))
                <div
                    class="mb-4 p-3 bg-yellow-100 border border-yellow-300 text-yellow-800 text-sm font-semibold rounded-lg flex items-center">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                    Silahkan pilih tanggal sewa terlebih dahulu untuk melihat ketersediaan kendaraan.
                </div>
            @endif
            <form method="GET" class="space-y-5">
                <!-- Search -->
                <div class="transition-opacity duration-200 hide-when-collapsed">
                    <label for="{{ $id }}_search" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-search text-primary-main mr-2"></i>
                        <span class="hide-when-collapsed">Cari Kendaraan</span>
                    </label>
                    <input type="text" id="{{ $id }}_search" name="search"
                        value="{{ $filters['search'] ?? '' }}" placeholder="Merek / Plat Nomor"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition" />
                </div>

                <!-- Hidden Date Inputs -->
                <input type="hidden" id="{{ $id }}_rent_date" name="rent_date"
                    value="{{ $filters['rent_date'] ?? '' }}">
                <input type="hidden" id="{{ $id }}_return_date" name="return_date"
                    value="{{ $filters['return_date'] ?? '' }}">

                <!-- Date Range -->
                <div class="transition-opacity duration-200 hide-when-collapsed">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-primary-main mr-2"></i>
                        <span class="hide-when-collapsed">Tanggal Sewa</span>
                    </label>
                    <button type="button" id="dateRangeBtn"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-left text-sm bg-white hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-primary-main">
                        <span id="dateRangeDisplay" class="text-gray-600 font-medium">
                            @if (($filters['rent_date'] ?? '') && ($filters['return_date'] ?? ''))
                                {{ \Carbon\Carbon::parse($filters['rent_date'])->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($filters['return_date'])->format('d M Y') }}
                            @else
                                Pilih Tanggal Sewa
                            @endif
                        </span>
                    </button>
                </div>

                <!-- Type Filter -->
                <div class="transition-opacity duration-200 hide-when-collapsed">
                    <label for="{{ $id }}_type" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-cube text-primary-main mr-2"></i>
                        <span class="hide-when-collapsed">Tipe Kendaraan</span>
                    </label>
                    <select id="{{ $id }}_type" name="type"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition bg-white">
                        <option value="">Semua Tipe</option>
                        <option value="car" @selected(($filters['type'] ?? '') === 'car')>Mobil</option>
                        <option value="motorcycle" @selected(($filters['type'] ?? '') === 'motorcycle')>Motor</option>
                    </select>
                </div>

                <!-- Transmission Filter -->
                <div class="transition-opacity duration-200 hide-when-collapsed">
                    <label for="{{ $id }}_transmission"
                        class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-cog text-primary-main mr-2"></i>
                        <span class="hide-when-collapsed">Transmisi</span>
                    </label>
                    <select id="{{ $id }}_transmission" name="transmission"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-main focus:border-transparent transition bg-white">
                        <option value="">Semua</option>
                        <option value="automatic" @selected(($filters['transmission'] ?? '') === 'automatic')>Automatic</option>
                        <option value="manual" @selected(($filters['transmission'] ?? '') === 'manual')>Manual</option>
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 pt-2 hide-when-collapsed transition-opacity duration-200">
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
    </div>
</aside>

{{-- styles & script only once per page --}}
@once
    @push('styles')
        <style>
            /* Collapsed state */
            [id^="vehicleFilter_"].collapsed {
                width: 64px !important;
                min-width: 64px !important;
                max-width: 64px !important;
            }

            [id^="vehicleFilter_"].collapsed .hide-when-collapsed {
                opacity: 0 !important;
                pointer-events: none !important;
                transform: translateX(-6px);
                position: absolute !important;
                width: 0 !important;
                height: 0 !important;
                overflow: hidden !important;
            }

            /* Rotate toggle button icon when collapsed */
            [id^="vehicleFilter_"].collapsed [id$="_ToggleBtn"] i {
                transform: rotate(180deg);
            }

            /* Icon alignment */
            [id^="vehicleFilter_"] .fa-filter {
                min-width: 20px;
            }

            /* Smooth transitions */
            [id^="vehicleFilter_"] {
                transition: width 0.3s ease-in-out, min-width 0.3s ease-in-out, max-width 0.3s ease-in-out;
            }

            [id^="vehicleFilter_"] .hide-when-collapsed {
                transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
            }

            /* Prevent content from expanding container when collapsed */
            [id^="vehicleFilter_"].collapsed .filter-body {
                width: 0;
                overflow: hidden;
                padding: 0 !important;
            }

            [id^="vehicleFilter_"].collapsed .border-b {
                margin-bottom: 0;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            (function() {
                // Initialize all vehicle filter components
                document.querySelectorAll('[id^="vehicleFilter_"]').forEach(function(aside) {
                    const id = aside.id;
                    const COLLAPSED_KEY = id + '_collapsed';

                    const toggleBtn = document.getElementById(id + '_ToggleBtn');

                    if (!toggleBtn) {
                        console.warn('Toggle button not found for', id);
                        return;
                    }

                    // Apply state from localStorage
                    try {
                        const isCollapsed = localStorage.getItem(COLLAPSED_KEY) === '1';
                        if (isCollapsed) {
                            aside.classList.add('collapsed');
                        }
                        // let stored = localStorage.getItem(COLLAPSED_KEY);

                        // // DEFAULT = collapsed
                        // let isCollapsed = stored === null ? true : stored === '1';

                        // if (isCollapsed) {
                        //     aside.classList.add('collapsed');
                        // }

                    } catch (e) {
                        console.warn('localStorage not available:', e);
                    }

                    function setCollapsed(state) {
                        if (state) {
                            aside.classList.add('collapsed');
                            toggleBtn.setAttribute('aria-expanded', 'false');
                            toggleBtn.setAttribute('title', 'Expand filter');
                        } else {
                            aside.classList.remove('collapsed');
                            toggleBtn.setAttribute('aria-expanded', 'true');
                            toggleBtn.setAttribute('title', 'Collapse filter');
                        }

                        try {
                            localStorage.setItem(COLLAPSED_KEY, state ? '1' : '0');
                        } catch (e) {
                            console.warn('localStorage write failed:', e);
                        }

                        // Dispatch event for external listeners
                        window.dispatchEvent(new CustomEvent('filter-toggle', {
                            detail: {
                                filterId: id,
                                collapsed: state
                            }
                        }));
                    }

                    // Toggle button click
                    toggleBtn.addEventListener('click', function() {
                        const isCurrentlyCollapsed = aside.classList.contains('collapsed');
                        setCollapsed(!isCurrentlyCollapsed);
                    });

                    // Optional: double-click on header to toggle
                    const header = aside.querySelector('.fa-filter')?.closest('div');
                    if (header) {
                        header.addEventListener('dblclick', function() {
                            const isCurrentlyCollapsed = aside.classList.contains('collapsed');
                            setCollapsed(!isCurrentlyCollapsed);
                        });
                        // Add cursor pointer hint
                        header.style.cursor = 'pointer';
                        header.title = 'Double-click to toggle';
                    }
                });
            })
            ();
        </script>
    @endpush
@endonce
