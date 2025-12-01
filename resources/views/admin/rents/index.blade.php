@extends('layouts.app')

@section('content')
    <div class="flex bg-bg min-h-screen">
        @include('layouts.partials.sidebar')

        <div class="flex-1 p-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-8">
                    <div>
                        <h1
                            class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight mb-2 flex items-center gap-3">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary-main to-primary-light rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-contract text-white text-xl"></i>
                            </div>
                            Kelola Sewa
                        </h1>
                        <p class="text-slate-600 text-sm font-medium">Pantau dan kelola semua transaksi rental kendaraan
                            secara real-time</p>
                    </div>
                    <a href="{{ route('admin.rents.create') }}"
                        class="mt-4 md:mt-0 px-6 py-2.5 bg-primary-main hover:bg-primary-dark text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                        <i class="fas fa-plus text-sm"></i> Tambah
                    </a>
                </div>

                <!-- Stats Cards - Compact -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div
                        class="bg-white rounded-lg p-4 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-slate-600 text-xs font-semibold mb-1">TOTAL SEWA</p>
                                <p class="text-2xl font-black text-slate-900">{{ $rents->count() }}</p>
                            </div>
                            <div
                                class="w-10 h-10 bg-primary-accent rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-car text-primary-dark text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-lg p-4 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-slate-600 text-xs font-semibold mb-1">PENDING</p>
                                <p class="text-2xl font-black text-yellow-600">
                                    {{ $rents->where('rent_status', 'pending')->count() }}</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-hourglass-half text-yellow-600"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-lg p-4 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-slate-600 text-xs font-semibold mb-1">AKTIF</p>
                                <p class="text-2xl font-black text-blue-600">
                                    {{ $rents->where('rent_status', 'active')->count() }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-play-circle text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white rounded-lg p-4 shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-slate-600 text-xs font-semibold mb-1">SELESAI</p>
                                <p class="text-2xl font-black text-green-600">
                                    {{ $rents->where('rent_status', 'completed')->count() }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 p-4 mb-6">
                <form method="GET" action="{{ route('admin.rents.index') }}" class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="md:col-span-2">
                            <input type="search" name="q" value="{{ request('q') }}"
                                placeholder="Cari nama user, email, brand..."
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-white text-sm
                                      focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent transition-all" />
                        </div>

                        <div>
                            <select name="status"
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 bg-white text-sm
                                       focus:outline-none focus:ring-2 focus:ring-primary-light focus:border-transparent transition-all">
                                <option value="">Semua status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="flex-1 px-3 py-2 bg-primary-main hover:bg-primary-dark text-white font-semibold rounded-lg text-sm transition-all duration-300">
                                <i class="fas fa-filter"></i>
                            </button>
                            <a href="{{ route('admin.rents.index') }}"
                                class="flex-1 px-3 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold rounded-lg text-sm transition-all">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-md border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-4 py-3 text-left font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    User</th>
                                <th class="px-4 py-3 text-left font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    Kendaraan</th>
                                <th class="px-4 py-3 text-left font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    Periode</th>
                                <th class="px-4 py-3 text-right font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    Harga</th>
                                <th class="px-4 py-3 text-center font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    Status</th>
                                <th class="px-4 py-3 text-center font-bold text-slate-900 uppercase tracking-wide text-xs">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200">
                            @forelse ($rents as $rent)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-slate-900 text-sm">{{ $rent->user->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $rent->user->email }}</div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-8 h-8 bg-primary-accent rounded flex items-center justify-center flex-shrink-0">
                                                @if ($rent->vehicle->vehicle_type === 'car')
                                                    <i class="fas fa-car text-primary-dark text-sm"></i>
                                                @else
                                                    <i class="fa-solid fa-motorcycle text-primary-dark text-sm"></i>
                                                @endif
                                            </div>
                                            <span class="font-medium text-slate-800">{{ $rent->vehicle->brand }}</span>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="text-xs text-slate-700">
                                            {{ \Carbon\Carbon::parse($rent->rent_date)->format('d M') }} -
                                            {{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <span class="font-bold text-slate-900">Rp
                                            {{ number_format($rent->total_price, 0, ',', '.') }}</span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $statusConfig = [
                                                'Pending Verification' => [
                                                    'bg-yellow-100',
                                                    'text-yellow-700',
                                                    'icon' => 'fa-clock',
                                                ],
                                                'active' => [
                                                    'bg-blue-100',
                                                    'text-blue-700',
                                                    'icon' => 'fa-play-circle',
                                                ],
                                                'Verified' => [
                                                    'bg-green-100',
                                                    'text-green-700',
                                                    'icon' => 'fa-check-circle',
                                                ],
                                            ];
                                            $status = $statusConfig[$rent->rent_status] ?? [
                                                'bg-slate-100',
                                                'text-slate-700',
                                                'icon' => 'fa-question-circle',
                                            ];
                                        @endphp

                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold {{ $status[0] }} {{ $status[1] }}">
                                            <i class="fas {{ $status['icon'] }} text-xs"></i>
                                            {{ ucfirst($rent->rent_status) }}
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <div
                                            class="flex items-center justify-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('admin.rents.show', $rent->id) }}"
                                                class="p-2 bg-primary-light text-primary-dark rounded hover:bg-primary-main hover:text-white text-xs transition-all"
                                                title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.rents.edit', $rent->id) }}"
                                                class="p-2 bg-blue-100 text-blue-600 rounded hover:bg-blue-600 hover:text-white text-xs transition-all"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.rents.destroy', $rent->id) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-red-100 text-red-600 rounded hover:bg-red-600 hover:text-white text-xs transition-all"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-400">
                                        <i class="fas fa-inbox text-3xl mb-2 block"></i>
                                        <p class="font-semibold">Tidak ada data sewa</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-4 py-3 border-t border-slate-200 bg-slate-50">
                    {{ $rents->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
