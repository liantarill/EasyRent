@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#f6fafb] text-gray-900">
        @include('layouts.partials.navbar')

        @php
            $totalTransaksi = $rentCount ?? 0;
            $sedangBerjalan = $ongoingRentCount ?? 0;
            $selesai = $finishedRentCount ?? 0;
            $menungguPembayaran = $pendingPaymentCount ?? 0;
            $recentRents = $recentRents ?? [];
        @endphp

        <div class="max-w-6xl mx-auto px-6 lg:px-10 pt-28 pb-14 space-y-10">
            <section
                class="bg-linear-to-r from-[#e9f9f4] via-[#f5fbff] to-[#f0f9ff] rounded-3xl p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-white/70">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="space-y-3 max-w-3xl">
                        <p class="text-sm font-semibold tracking-wide text-[#00b894] uppercase">Selamat datang,
                            {{ auth()->user()->name }}</p>
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight">Kelola penyewaan Anda
                            dengan mudah di EasyRent</h1>
                        <p class="text-gray-600">Pantau status sewa, pembayaran, dan temukan kendaraan yang cocok tanpa
                            berpindah halaman.</p>
                    </div>
                    <div class="bg-white rounded-2xl px-5 py-4 shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Akun</div>
                        <div class="text-lg font-semibold text-gray-900">Customer</div>
                        <div class="mt-1 inline-flex items-center gap-2 text-[#00b894] text-sm font-semibold">
                            <span class="w-2 h-2 rounded-full bg-[#00b894]"></span> Aktif
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([['label' => 'Total Transaksi', 'value' => $totalTransaksi, 'color' => '#00b894'], ['label' => 'Sedang Berjalan', 'value' => $sedangBerjalan, 'color' => '#3b82f6'], ['label' => 'Selesai', 'value' => $selesai, 'color' => '#10b981'], ['label' => 'Menunggu Pembayaran', 'value' => $menungguPembayaran, 'color' => '#f59e0b']] as $card)
                    <div class="rounded-2xl bg-white shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center text-white font-bold"
                            style="background: {{ $card['color'] }};">
                            {{ strtoupper(substr($card['label'], 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                            <p class="text-2xl font-extrabold text-gray-900">{{ $card['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </section>

            <section class="grid gap-4 md:grid-cols-3">
                <a href="{{ route('customer.vehicles.index') }}"
                    class="group rounded-2xl bg-white p-5 border border-gray-100 shadow-sm hover:-translate-y-1 transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-[#00b894]/10 text-[#00b894] grid place-items-center text-lg font-bold">
                            ??</div>
                        <div>
                            <p class="text-sm text-gray-500">Cari Kendaraan</p>
                            <p class="text-base font-semibold text-gray-900">Lihat semua kendaraan</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customer.rents.index') }}"
                    class="group rounded-2xl bg-white p-5 border border-gray-100 shadow-sm hover:-translate-y-1 transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-[#3b82f6]/10 text-[#3b82f6] grid place-items-center text-lg font-bold">
                            ??</div>
                        <div>
                            <p class="text-sm text-gray-500">Transaksi</p>
                            <p class="text-base font-semibold text-gray-900">Riwayat & status</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customer.profile') }}"
                    class="group rounded-2xl bg-white p-5 border border-gray-100 shadow-sm hover:-translate-y-1 transition-all duration-200 hover:shadow-md">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-[#6366f1]/10 text-[#6366f1] grid place-items-center text-lg font-bold">
                            ??</div>
                        <div>
                            <p class="text-sm text-gray-500">Profil</p>
                            <p class="text-base font-semibold text-gray-900">Kelola akun Anda</p>
                        </div>
                    </div>
                </a>
            </section>

            <section class="rounded-3xl bg-white border border-gray-100 shadow-sm overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-4 border-b border-gray-100">
                    <div class="text-lg font-semibold text-gray-900">Transaksi Terbaru</div>
                    <form class="flex flex-wrap gap-3 w-full lg:w-auto" action="{{ route('customer.rents.index') }}"
                        method="GET">
                        <select name="status"
                            class="rounded-xl border-gray-200 text-sm px-3 py-2 focus:ring-2 focus:ring-[#00b894] focus:border-[#00b894]">
                            <option value="">Status Sewa</option>
                            <option value="pending">Pending</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="returned">Returned</option>
                        </select>
                        <select name="payment_status"
                            class="rounded-xl border-gray-200 text-sm px-3 py-2 focus:ring-2 focus:ring-[#00b894] focus:border-[#00b894]">
                            <option value="">Status Bayar</option>
                            <option value="paid">Terbayar</option>
                            <option value="pending">Pending</option>
                        </select>
                        <input type="text" name="date" placeholder="mm/dd/yyyy"
                            class="rounded-xl border-gray-200 text-sm px-3 py-2 focus:ring-2 focus:ring-[#00b894] focus:border-[#00b894]" />
                        <input type="text" name="q" placeholder="Kata kunci..."
                            class="rounded-xl border-gray-200 text-sm px-3 py-2 focus:ring-2 focus:ring-[#00b894] focus:border-[#00b894] flex-1 min-w-[180px]" />
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-[#fbfbfb]">
                            <tr class="text-gray-500">
                                <th class="px-6 py-3 text-left font-semibold">Kode Order</th>
                                <th class="px-6 py-3 text-left font-semibold">Mobil</th>
                                <th class="px-6 py-3 text-left font-semibold">Mulai</th>
                                <th class="px-6 py-3 text-left font-semibold">Selesai</th>
                                <th class="px-6 py-3 text-left font-semibold">Total</th>
                                <th class="px-6 py-3 text-left font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($recentRents as $rent)
                                <tr class="text-gray-800">
                                    <td class="px-6 py-4 font-semibold">{{ $rent->payment->order_id ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        {{ $rent->vehicle->brand ?? '-' }}
                                        {{ $rent->vehicle->plate_number ?? '' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $rent->formatted_rent_date ?? ($rent->rent_date ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $rent->formatted_return_date ?? ($rent->return_date ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="whitespace-nowrap">
                                            {{ $rent->formatted_total ?? 'Rp ' . number_format($rent->total_price ?? 0, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"
                                            style="color: {{ $rent->status_color ?? '#6b7280' }}; background: {{ $rent->status_bg ?? '#f3f4f6' }};">
                                            {{ $rent->display_status ?? ($rent->rent_status ?? '-') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-6 text-center text-gray-500">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <a href="{{ route('customer.profile') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-[#00b894] hover:underline">Perbarui
                    data profil</a>
                <form action="{{ route('logout') }}" method="POST" class="inline-flex">
                    @csrf
                    <button class="text-sm font-semibold text-red-500 hover:text-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
