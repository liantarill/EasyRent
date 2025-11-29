{{-- @extends('layouts.app')


@section('content')
    <div class="flex">
        @include('layouts.partials.sidebar')

        <table>
            <thead>
                <th>id</th>
                <th>brand</th>
                <th>year</th>
                <th>plate_number</th>
                <th>transmission</th>
                <th>fuel type</th>
                <th>capacity</th>
                <th>price per day</th>
                <th>description</th>
                <th>photo</th>
                <th>vehicle type</th>
                <th>status</th>
                <th>aksi</th>

            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->id }}</td>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->plate_number }}</td>
                        <td>{{ $vehicle->transmission }}</td>
                        <td>{{ $vehicle->fuel_type }}</td>
                        <td>{{ $vehicle->capacity }}</td>
                        <td>{{ $vehicle->price_per_day }}</td>
                        <td>{{ $vehicle->description }}</td>
                        <td>{{ $vehicle->photo }}</td>
                        <td>{{ $vehicle->vehicle_type }}</td>
                        <td>{{ $vehicle->status }}</td>
                        <td>
                            <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                                Edit
                            </a>

                        
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="flex">

        @include('layouts.partials.sidebar')

        <div class="flex-1 pb-6  bg-linear-to-br from-gray-50 via-white to-gray-100">
            <!-- Header Section -->
            <div class="sticky top-0 z-40 bg-bg border-gray-200 shadow-sm">
                <div class="max-w-6xl mx-auto px-6 py-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl font-black text-gray-900 tracking-tight flex items-center gap-3">
                                <i class="fas fa-car text-teal-600"></i>
                                Manajemen Kendaraan
                            </h1>
                            <p class="text-gray-600 mt-2 font-light">Kelola armada kendaraan Anda dengan mudah</p>
                        </div>
                        <a href="{{ route('admin.vehicles.create') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            <i class="fas fa-plus"></i>
                            Tambah Kendaraan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="max-w-6xl mx-auto px-6 py-12">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- Total Kendaraan Card -->
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-8 border-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-600 font-medium text-sm mb-2">Total Kendaraan</p>
                                <p class="text-4xl font-bold text-gray-900">{{ $vehicles->count() }}</p>
                            </div>
                            <div class="p-4 bg-teal-100 rounded-xl">
                                <i class="fas fa-car text-teal-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tersedia Card -->
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-8 border-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-600 font-medium text-sm mb-2">Tersedia</p>
                                <p class="text-4xl font-bold text-green-600">
                                    {{ $vehicles->where('status', 'Available')->count() }}</p>
                            </div>
                            <div class="p-4 bg-green-100 rounded-xl">
                                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Sedang Disewa Card -->
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 p-8 border-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-gray-600 font-medium text-sm mb-2">Sedang Disewa</p>
                                <p class="text-4xl font-bold text-orange-600">
                                    {{ $vehicles->where('status', 'Rented')->count() }}</p>
                            </div>
                            <div class="p-4 bg-orange-100 rounded-xl">
                                <i class="fas fa-clock text-orange-600 text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="mb-8 flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <form method="GET" action="{{ route('admin.vehicles.index') }}" class="w-full">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari brand atau nomor plat..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all duration-300" />
                        </form>
                    </div>
                </div>

                <!-- Vehicles Table - Simplified Index -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-0">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-teal-50 to-teal-100/50">
                                <tr class="border-b border-teal-200">
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Foto</th>
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Brand</th>
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Tipe</th>
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Plat Nomor</th>
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Status</th>
                                    <th class="text-teal-900 font-bold text-sm px-6 py-4 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($vehicles as $key => $vehicle)
                                    <tr
                                        class="border-b border-gray-100 hover:bg-gray-50/50 transition-colors duration-200 {{ $key % 2 === 0 ? 'bg-white' : 'bg-gray-50/30' }}">
                                        <!-- Photo -->
                                        <td class="px-6 py-4">
                                            @if ($vehicle->photo)
                                                <img src="{{ asset('storage/' . $vehicle->photo) }}"
                                                    alt="{{ $vehicle->brand }}"
                                                    class="h-12 w-12 rounded-lg object-cover border border-gray-200">
                                            @else
                                                <div
                                                    class="h-12 w-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Brand -->
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900">{{ $vehicle->brand }}</span>
                                        </td>

                                        <!-- Vehicle Type -->
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-block px-3 py-1 bg-teal-50 text-teal-700 border border-teal-200 rounded-full text-xs font-semibold">
                                                <i class="fas fa-tag"></i> {{ ucfirst($vehicle->vehicle_type) }}
                                            </span>
                                        </td>

                                        <!-- Plate Number -->
                                        <td class="px-6 py-4">
                                            <span
                                                class="font-mono font-semibold text-gray-900">{{ $vehicle->plate_number }}</span>
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4">
                                            @php
                                                $statusConfig = [
                                                    'Available' => [
                                                        'label' => 'Tersedia',
                                                        'color' => 'bg-green-100 text-green-800',
                                                        'icon' => 'fa-check-circle',
                                                    ],
                                                    'Rented' => [
                                                        'label' => 'Disewa',
                                                        'color' => 'bg-orange-100 text-orange-800',
                                                        'icon' => 'fa-clock',
                                                    ],
                                                    'Maintenance' => [
                                                        'label' => 'Maintenance',
                                                        'color' => 'bg-red-100 text-red-800',
                                                        'icon' => 'fa-wrench',
                                                    ],
                                                ];
                                                $status = $statusConfig[$vehicle->status] ?? [
                                                    'label' => 'Unknown',
                                                    'color' => 'bg-gray-100 text-gray-800',
                                                    'icon' => 'fa-question',
                                                ];
                                            @endphp
                                            <span
                                                class="inline-block px-3 py-1 {{ $status['color'] }} rounded-full text-xs font-semibold">
                                                <i class="fas {{ $status['icon'] }}"></i> {{ $status['label'] }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4">
                                            <div class="flex gap-3">
                                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-teal-600 hover:bg-teal-50 hover:text-teal-700 transition-colors duration-200"
                                                    title="Edit">
                                                    <i class="fas fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200"
                                                        title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <i class="fas fa-inbox text-gray-300 text-4xl"></i>
                                                <p class="text-gray-500 font-light">Tidak ada kendaraan yang ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
