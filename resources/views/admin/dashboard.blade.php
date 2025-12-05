@extends('layouts.app')

@push('styles')
    <!-- No custom CSS needed — Tailwind utilities used throughout -->
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="flex">
            @include('layouts.partials.sidebar')

            <main class="flex-1 max-w-6xl mx-auto w-full p-6 lg:p-8">
                <!-- Topbar -->
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 mb-6">
                    <div
                        class="flex-1 flex items-center gap-3 bg-white border border-gray-200 rounded-xl shadow-md px-4 py-2">
                        <span class="text-gray-400 text-lg">🔍</span>
                        <input class="w-full outline-none text-sm text-slate-900 bg-transparent" type="text"
                            placeholder="Cari transaksi, mobil, atau penyewa...">
                    </div>

                    <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl shadow-md px-3 py-2">
                        <div class="flex flex-col leading-tight">
                            <span class="font-semibold text-sm">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-gray-500">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="w-9 h-9 grid place-items-center rounded-lg bg-blue-600 text-white font-bold uppercase">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Metrics -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                    @foreach ($statCards as $card)
                        <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-4 shadow-md">
                            <div class="w-11 h-11 grid place-items-center rounded-lg"
                                style="background: {{ $card['icon_bg'] }}; color: {{ $card['icon_fg'] }};">
                                <i class="{{ $card['icon'] }}"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 mb-1">{{ $card['label'] }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xl font-extrabold">{{ $card['value'] }}</span>
                                    @if (isset($card['status']))
                                        <span
                                            class="text-xs font-semibold py-1 px-2 rounded-full bg-gray-100">{{ ucfirst($card['status']) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr)_minmax(280px,1fr)] gap-6">
                    <div class="flex flex-col gap-6">
                        <!-- Recent Transactions -->
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-5">
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-base font-extrabold">Transaksi Terbaru</h3>
                                <div class="flex flex-wrap gap-2">
                                    <select class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50">
                                        <option>Status Sewa</option>
                                        <option>Pending</option>
                                        <option>Ongoing</option>
                                        <option>Returned</option>
                                    </select>
                                    <select class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50">
                                        <option>Status Bayar</option>
                                        <option>Terbayar</option>
                                        <option>Pending</option>
                                    </select>
                                    <input class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50"
                                        type="text" placeholder="mm/dd/yyyy">
                                    <input class="text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50"
                                        type="text" placeholder="Kata kunci...">
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100 text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold">Kode Order</th>
                                            <th class="px-4 py-3 text-left font-semibold">Penyewa</th>
                                            <th class="px-4 py-3 text-left font-semibold">Mobil</th>
                                            <th class="px-4 py-3 text-left font-semibold">Tgl Mulai</th>
                                            <th class="px-4 py-3 text-left font-semibold">Tgl Selesai</th>
                                            <th class="px-4 py-3 text-left font-semibold">Total</th>
                                            <th class="px-4 py-3 text-left font-semibold">Status Sewa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach ($transactions as $item)
                                            @php $statusClass = 'tag-' . strtolower($item['status']); @endphp
                                            <tr>
                                                <td class="px-4 py-3">{{ $item->payment->order_id }}</td>
                                                <td class="px-4 py-3">{{ $item->user->name }}</td>
                                                <td class="px-4 py-3">{{ $item->vehicle->brand }}</td>
                                                <td class="px-4 py-3">
                                                    {{ \Carbon\Carbon::parse($item->rent_date)->format('d M Y') }}
                                                </td>
                                                <td class="px-4 py-3">
                                                    {{ \Carbon\Carbon::parse($item->return_date)->format('d M Y') }} </td>

                                                </td>
                                                <td class="px-4 py-3"><span class="whitespace-nowrap">Rp
                                                        {{ number_format($item->total_price, 0, ',', '.') }}</span></td>
                                                <td class="px-4 py-3"><span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100">{{ $item->rent_status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payments Awaiting Verification -->
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-5">
                            <div class="mb-4">
                                <h3 class="text-base font-extrabold">Pembayaran Menunggu Verifikasi</h3>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100 text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold">Kode Order</th>
                                            <th class="px-4 py-3 text-left font-semibold">Penyewa</th>
                                            <th class="px-4 py-3 text-left font-semibold">Metode</th>
                                            <th class="px-4 py-3 text-left font-semibold">Tanggal</th>
                                            <th class="px-4 py-3 text-left font-semibold">Jumlah</th>
                                            <th class="px-4 py-3 text-left font-semibold">Bukti</th>
                                            <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td class="px-4 py-3">{{ $payment['code'] }}</td>
                                                <td class="px-4 py-3">{{ $payment['renter'] }}</td>
                                                <td class="px-4 py-3">{{ $payment['method'] }}</td>
                                                <td class="px-4 py-3">{{ $payment['date'] }}</td>
                                                <td class="px-4 py-3"><span class="whitespace-nowrap">Rp
                                                        {{ number_format($payment['amount'], 0, ',', '.') }}</span></td>
                                                <td class="px-4 py-3"><a href="#"
                                                        class="text-blue-600 font-semibold">Lihat Bukti</a></td>
                                                <td class="px-4 py-3 flex flex-col items-start gap-2">
                                                    <a href="#" class="text-green-600 font-semibold">✓ Verif</a>
                                                    <a href="#" class="text-red-600 font-semibold">✕ Tolak</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar column -->
                    <aside class="space-y-4">
                        <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-5">
                            <div class="mb-3 flex items-center justify-between">
                                <h3 class="text-base font-extrabold">Ketersediaan Mobil</h3>
                            </div>
                            <div class="flex flex-col gap-3">
                                @foreach ($availability as $car)
                                    <div
                                        class="flex items-center justify-between p-3 border border-gray-100 rounded-lg bg-gray-50">
                                        <div>
                                            <div class="font-semibold">{{ $car['name'] }}</div>
                                            <div class="text-xs text-gray-500">{{ $car['plate'] }}</div>
                                        </div>
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100">{{ $car['status'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </div>
@endsection
