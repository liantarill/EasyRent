@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-950">
        @include('layouts.partials.navbar')

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-8 ">
            <h2 class="text-2xl font-semibold text-white mb-6">Riwayat Penyewaan</h2>

            @if ($rents->count() == 0)
                <div class="rounded-md bg-blue-50 border border-blue-100 p-4">
                    <p class="text-blue-800">Anda belum memiliki riwayat penyewaan.</p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($rents as $rent)
                        <div class="bg-white shadow-sm rounded-2xl border p-4 flex flex-col">
                            <div class="flex items-start gap-4">
                                {{-- Gambar kendaraan (jika tersedia) --}}
                                <div
                                    class="w-20 h-16 shrink-0 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                                    @if (optional($rent->vehicle)->image_url)
                                        <img src="{{ $rent->vehicle->image_url }}" alt="{{ $rent->vehicle->name }}"
                                            class="object-cover w-full h-full">
                                    @else
                                        <svg class="w-8 h-8 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M3 7v10a1 1 0 001 1h3l.5-2H20a1 1 0 001-1V7a1 1 0 00-1-1H4a1 1 0 00-1 1z" />
                                        </svg>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-800">
                                        {{ $rent->vehicle->brand ?? 'Kendaraan tidak tersedia' }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Rp {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }} / hari
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 flex-1">
                                <dl class="text-sm text-gray-600 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-xs text-gray-500">Tanggal Sewa</dt>
                                        <dd class="font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($rent->rent_date)->format('d M Y') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-xs text-gray-500">Tanggal Kembali</dt>
                                        <dd class="font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-xs text-gray-500">Total</dt>
                                        <dd class="font-semibold text-gray-900">Rp
                                            {{ number_format($rent->total_price, 0, ',', '.') }}</dd>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <dt class="text-xs text-gray-500">Pembayaran</dt>
                                        <dd>
                                            @if ($rent->payment)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sudah
                                                    bayar</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">Belum
                                                    bayar</span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                {{-- Status badge --}}
                                @php
                                    $status = $rent->rent_status;
                                    $statusClasses = [
                                        'Pending Verification' => 'bg-yellow-100 text-yellow-800',
                                        'Verified' => 'bg-green-100 text-green-800',
                                        'Rejected' => 'bg-red-100 text-red-800',
                                    ];
                                    $badgeClass = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
                                @endphp

                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
                                    {{ $status }}
                                </span>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('customer.rents.show', $rent->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium border border-transparent shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $rents->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
