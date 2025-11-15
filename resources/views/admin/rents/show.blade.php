@extends('layouts.app')

@section('content')
    <div>
        <p>Customer: {{ $rent->user->name }}</p>
    </div>

    <div>
        <p>approved_by: {{ $rent->approver?->name }}</p>
    </div>

    <div>
        <p>Brand: {{ $rent->vehicle->brand }}</p>
    </div>

    <p>Nomor Kendaraan: {{ $rent->vehicle->plate_number }}</p>

    <p>Rent Date: {{ $rent->rent_date }}</p>

    <p>Return Date: {{ $rent->return_date }}</p>

    <p>Daily Price: {{ $rent->daily_price_snapshot }}</p>

    <p>Total Price: {{ $rent->total_price }}</p>


    <form action="{{ route('admin.rents.update', $rent->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>Rent Status:
            <select name="rent_status">
                @foreach (['Pending Verification', 'Verified', 'Rejected'] as $rent_status)
                    <option value="{{ $rent_status }}" @selected(old('rent_status', $rent->rent_status) === $rent_status)>
                        {{ ucfirst($rent_status) }}
                    </option>
                @endforeach
            </select>
            <button type="submit">Simpan</button>
        </p>
    </form>
    <br>
    <p>Payment Proof</p>
    <p>Metode Pembayaran: {{ $rent->payment->method ?? 'Belum bayar' }}</p>
    <p>Bukti Pembayaran:
        @if ($rent->payment && $rent->payment->proof)
            <img src="{{ asset('storage/' . $rent->payment->proof) }}" width="200">
        @else
            Tidak ada bukti pembayaran.
        @endif
    </p>

    <p>Status Pembayaran: {{ $rent->payment?->status ?? 'Belum Dibayar' }}</p>

    <form action="">
        <p>Status Pembayaran:
            <select name="" id="">
                @foreach (['Pending', 'Paid', 'Failed'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $rent->payment?->status) === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
    </form>

    </p>
@endsection
