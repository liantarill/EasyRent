@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-950">
        @include('layouts.partials.navbar')

        <div class="max-w-5xl mx-auto px-6 md:px-10 pt-32 pb-16 space-y-8 text-white">
            <header>
                <h1 class="text-3xl font-bold">Dashboard Customer EasyRent</h1>
                <p class="text-gray-400 mt-2">Selamat datang, {{ auth()->user()->name }}.</p>
            </header>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-xl bg-gray-900 border border-gray-800 p-6">
                    <p class="text-sm text-gray-400">Total Transaksi</p>
                    <p class="text-4xl font-semibold mt-2">{{ $rentCount ?? 0 }}</p>
                </div>

                <div class="rounded-xl bg-gray-900 border border-gray-800 p-6">
                    <p class="text-sm text-gray-400">Status Akun</p>
                    <p class="text-2xl font-semibold mt-2">Aktif</p>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <a href="{{ route('customer.vehicles.index') }}"
                    class="rounded-xl bg-gray-900 border border-gray-800 p-5 hover:border-primary-main transition">
                    <h2 class="text-lg font-semibold">Lihat Kendaraan</h2>
                    <p class="text-gray-400 text-sm mt-1">Tampilkan semua kendaraan yang tersedia.</p>
                </a>

                <a href="{{ route('customer.rents.index') }}"
                    class="rounded-xl bg-gray-900 border border-gray-800 p-5 hover:border-primary-main transition">
                    <h2 class="text-lg font-semibold">Transaksi Saya</h2>
                    <p class="text-gray-400 text-sm mt-1">Lihat riwayat penyewaan Anda.</p>
                </a>

                <a href="{{ route('customer.profile') }}"
                    class="rounded-xl bg-gray-900 border border-gray-800 p-5 hover:border-primary-main transition">
                    <h2 class="text-lg font-semibold">Profil Saya</h2>
                    <p class="text-gray-400 text-sm mt-1">Perbarui data pribadi.</p>
                </a>

                <form action="{{ route('logout') }}" method="POST"
                    class="rounded-xl bg-gray-900 border border-gray-800 p-5 hover:border-red-500 transition">
                    @csrf
                    <button class="text-left w-full">
                        <h2 class="text-lg font-semibold text-red-400">Logout</h2>
                        <p class="text-gray-400 text-sm mt-1">Keluar dari akun.</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
