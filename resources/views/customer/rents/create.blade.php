@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto p-6 bg-white rounded shadow">
        <h1 class="text-xl font-bold mb-4">Sewa: {{ $vehicle->brand }} ({{ $vehicle->plate_number }})</h1>

        <form action="{{ route('customer.rents.store', $vehicle->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="rent_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" id="rent_date" name="rent_date" value="{{ old('rent_date') }}"
                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required
                    class="mt-1 block w-full border rounded px-3 py-2" />
                @error('rent_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}"
                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required
                    class="mt-1 block w-full border rounded px-3 py-2" />
                @error('return_date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-600">Harga per hari: <strong>Rp
                        {{ number_format($vehicle->price_per_day, 0, ',', '.') }}</strong></p>
            </div>

            <button type="submit" class="bg-primary-main text-white px-4 py-2 rounded hover:opacity-95">
                Lanjutkan & Buat Pesanan
            </button>
        </form>
    </div>
@endsection
