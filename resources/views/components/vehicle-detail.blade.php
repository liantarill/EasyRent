@props(['vehicle', 'rentDate' => null, 'returnDate' => null])

@php
    $customer = auth()->user();
    $canRent = $customer && $customer->hasCompletedProfile();
@endphp

<!-- Modal Overlay -->
<div id="vehicleDetailModal-{{ $vehicle->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" role="dialog"
    aria-modal="true">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-gray-900/80 bg-opacity-75 transition-opacity modal-backdrop"></div>

    <!-- Modal Container -->
    <div class="flex min-h-screen items-center justify-center p-3 sm:p-4">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-2xl transform transition-all animate-slideUp"
            style="max-height: 85vh; overflow-y-auto;">

            <!-- Modal Header with Close Button -->
            <div
                class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 sm:px-6 py-3 sm:py-4 rounded-t-xl flex items-center justify-between">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Detail Kendaraan</h2>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors close-modal"
                    data-modal-id="vehicleDetailModal-{{ $vehicle->id }}">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 sm:p-6" style="background-color: #f9fafb;">
                <!-- Photo Gallery Section -->
                @if ($vehicle->photo)
                    <div class="mb-4 rounded-lg overflow-hidden shadow-md">
                        <div class="relative bg-gray-900 aspect-video">
                            <img src="{{ asset('storage/' . $vehicle->photo) }}" alt="{{ $vehicle->brand }}"
                                class="w-full h-full object-cover">
                            <div class="absolute top-3 right-3 px-3 py-1 rounded-lg font-semibold text-xs sm:text-sm"
                                style="background-color: rgba(20, 184, 166, 0.9); color: white;">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z">
                                        </path>
                                    </svg>
                                    Foto
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div
                        class="mb-4 rounded-lg overflow-hidden shadow-md bg-white border-2 border-dashed border-gray-300">
                        <div class="flex items-center justify-center aspect-video bg-gray-50">
                            <div class="text-center">
                                <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-300 mb-1" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z">
                                    </path>
                                </svg>
                                <p class="text-xs sm:text-sm text-gray-500 font-medium">Foto tidak tersedia</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Title Section -->
                <div class="mb-4">
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $vehicle->brand }}</h1>
                </div>

                <!-- Info Grid -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 sm:p-5 space-y-3">
                        <!-- Row 1 -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pb-3 border-b border-gray-100">
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Tahun</p>
                                <p class="text-sm sm:text-base font-semibold text-gray-900">{{ $vehicle->year }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Jenis</p>
                                <span class="inline-block px-2 py-1 rounded text-xs font-medium"
                                    style="background-color: #ccfbf1; color: #0d9488;">
                                    {{ ucfirst($vehicle->vehicle_type) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Transmisi</p>
                                <p class="text-sm sm:text-base font-semibold text-gray-900">
                                    {{ ucfirst($vehicle->transmission) }}</p>
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pb-3 border-b border-gray-100">
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Bahan Bakar</p>
                                <p class="text-sm sm:text-base font-semibold text-gray-900">
                                    {{ ucfirst($vehicle->fuel_type) }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Penumpang</p>
                                <p class="text-sm sm:text-base font-semibold text-gray-900">{{ $vehicle->capacity }}
                                    orang</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Plat</p>
                                <p class="text-sm sm:text-base font-mono font-bold" style="color: #14b8a6;">
                                    {{ $vehicle->plate_number }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        @if ($vehicle->description)
                            <div class="pt-3 border-t border-gray-100">
                                <p class="text-xs font-medium text-gray-500 mb-1">Deskripsi</p>
                                <p class="text-sm text-gray-700 leading-relaxed">{{ $vehicle->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pricing & Action Section -->
                <div class="mt-4 bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100"
                        style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);">
                        <h3 class="text-base sm:text-lg font-bold text-white">Harga Sewa</h3>
                    </div>
                    <div class="p-4 sm:p-5">
                        <div class="flex items-baseline justify-between mb-4">
                            <p class="text-gray-600 text-sm">Per Hari</p>
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $vehicle->formatted_price }}</p>
                        </div>
                        <div class="mb-4">
                            <span
                                class="inline-block px-3 py-1 rounded text-xs font-semibold 
                            {{ $vehicle->is_rented > 0 ? 'text-red-700 bg-red-200' : 'text-primary-main bg-primary-accent ' }}">
                                {{-- style="background-color: #ccfbf1; color: #0d9488;"> --}}
                                {{ $vehicle->is_rented ? 'Rented' : 'Available' }}
                            </span>
                        </div>

                        @if ($canRent)
                            @if (!$vehicle->is_rented && $rentDate && $returnDate)
                                <form action="{{ route('customer.rents.create', $vehicle->id) }}" method="GET">
                                    <button type="submit"
                                        class="w-full px-4 py-2.5 sm:py-3 rounded-lg font-semibold text-white text-sm sm:text-base transition-all duration-300 transform hover:scale-105 active:scale-95 shadow-md"
                                        style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);">
                                        <span class="flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z">
                                                </path>
                                            </svg>
                                            Sewa Sekarang
                                        </span>
                                    </button>
                                </form>
                            @endif
                        @else
                            <div class="rounded-lg border-l-4 p-3 sm:p-4 space-y-2"
                                style="border-left-color: #f59e0b; background-color: #fffbeb; color: #78350f;">
                                <div class="flex gap-2">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0 mt-0.5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <h3 class="font-semibold text-sm mb-1">Profil belum lengkap</h3>
                                        <p class="text-xs mb-2">Lengkapi data diri Anda terlebih dahulu.</p>
                                        <a href="{{ route('customer.profile') }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded text-xs font-medium transition-colors"
                                            style="background-color: #fcd34d; color: #78350f;">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
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

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Open modal
                document.querySelectorAll('[data-modal-target]').forEach(trigger => {
                    trigger.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modalId = this.getAttribute('data-modal-target');
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.classList.remove('hidden');
                            document.body.style.overflow = 'hidden';
                        }
                    });
                });

                // Close modal
                document.querySelectorAll('.close-modal, .modal-backdrop').forEach(closeBtn => {
                    closeBtn.addEventListener('click', function() {
                        const modalId = this.getAttribute('data-modal-id') || this.closest(
                            '[id^="vehicleDetailModal-"]').id;
                        const modal = document.getElementById(modalId);
                        if (modal) {
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    });
                });

                // Close on ESC key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        document.querySelectorAll('[id^="vehicleDetailModal-"]').forEach(modal => {
                            if (!modal.classList.contains('hidden')) {
                                modal.classList.add('hidden');
                                document.body.style.overflow = 'auto';
                            }
                        });
                    }
                });
            });
        </script>

        <style>
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-slideUp {
                animation: slideUp 0.3s ease-out;
            }
        </style>
    @endpush
@endonce
