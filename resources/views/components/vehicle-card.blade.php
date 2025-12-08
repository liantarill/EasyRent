@props(['vehicle', 'rentDate' => null, 'returnDate' => null])

<div
    class="border border-gray-100 rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300">

    <!-- Photo Section -->
    <div class="relative h-40 bg-linear-to-br from-gray-50 to-gray-100 overflow-hidden">
        @if ($vehicle->photo)
            <img src="{{ asset('storage/' . $vehicle->photo) }}" alt="{{ $vehicle->brand }}"
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-300 text-4xl">
                @if ($vehicle->vehicle_type === 'car')
                    <i class="fa-solid fa-car"></i>
                @else
                    <i class="fa-solid fa-motorcycle"></i>
                @endif
            </div>
        @endif

        <!-- Updated badge styling with teal accent color -->
        {{-- <div
            class="absolute top-3 right-3 bg-primary-main text-white px-2.5 py-1 rounded-full text-xs font-semibold shadow-sm">
            {{ ucfirst($vehicle->vehicle_type) }}
        </div> --}}
        @if ($rentDate && $returnDate)
            <div
                class="absolute top-3 right-3 px-2.5 py-1 rounded-full text-xs font-semibold shadow-sm text-white {{ $vehicle->is_rented > 0 ? 'bg-red-600' : 'bg-primary-main ' }}">
                {{ $vehicle->is_rented > 0 ? 'Rented' : 'Available' }}
            </div>
        @endif

    </div>

    <!-- Content Section -->
    <div class="p-4">

        <!-- Brand heading with improved typography -->
        <h3 class="text-base font-semibold text-gray-900 mb-3 truncate">
            {{ $vehicle->brand }}
        </h3>

        <!-- Specs in compact 2x2 grid for better visibility -->
        <div class="grid grid-cols-2 gap-2 mb-3">
            <span class="flex items-center gap-1.5 text-xs text-gray-600 bg-gray-50 px-2 py-1.5 rounded">
                <i class="fa-solid fa-calendar-alt text-primary-main"></i> {{ $vehicle->year }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-600 bg-gray-50 px-2 py-1.5 rounded">
                <i class="fa-solid fa-gear text-primary-main"></i> {{ ucfirst($vehicle->transmission) }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-600 bg-gray-50 px-2 py-1.5 rounded">
                <i class="fa-solid fa-gas-pump text-primary-main"></i> {{ ucfirst($vehicle->fuel_type) }}
            </span>
            <span class="flex items-center gap-1.5 text-xs text-gray-600 bg-gray-50 px-2 py-1.5 rounded">
                <i class="fa-solid fa-users text-primary-main"></i> {{ $vehicle->capacity }}
            </span>
        </div>

        <!-- Description with line clamp for consistency -->
        @if ($vehicle->description)
            <p class="text-xs text-gray-500 mb-3 line-clamp-1">
                {{ $vehicle->description }}
            </p>
        @endif

        <!-- Price and actions section with improved spacing -->
        <div class="border-t border-gray-100 pt-3">
            <p class="text-xs text-gray-500 mb-1">Harga per hari</p>
            <p class="text-lg font-bold text-primary-main mb-3">
                {{ $vehicle->formatted_price }}
            </p>

            <!-- Buttons in compact vertical layout -->
            <div class="space-y-2 ">
                <!-- Detail Button -->
                <a href="#" data-modal-target="vehicleDetailModal-{{ $vehicle->id }}"
                    class="block w-full px-3 py-2 bg-gray-100 text-gray-700 rounded-md font-medium text-sm hover:bg-gray-200 transition text-center">
                    <i class="fa-solid fa-circle-info mr-1.5"></i> Detail
                </a>

                <!-- Rent Button -->
                @if (!$vehicle->is_rented && $rentDate && $returnDate)
                    <form action="{{ route('customer.rents.store', $vehicle->id) }}" method="POST"
                        @if (!$rentDate || !$returnDate) onsubmit="alert('Silakan pilih tanggal terlebih dahulu'); return false;" @endif>
                        @csrf
                        <input type="hidden" name="rent_date" value="{{ $rentDate }}">
                        <input type="hidden" name="return_date" value="{{ $returnDate }}">
                        <button type="submit"
                            class="btn-sewa block w-full px-3 py-2 bg-primary-main text-white rounded-md font-medium text-sm hover:bg-primary-dark transition">
                            <i class="fa-solid fa-car-side mr-1.5"></i> Sewa
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Vehicle Detail Modal -->
    <x-vehicle-detail :vehicle="$vehicle" />
</div>
