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


    <p>Status Pembayaran: {{ $rent->payment?->status ?? 'Belum Dibayar' }}</p>

    <a href="{{ route('admin.payments.show', $rent->payment->id) }}">Detail Pembayaran</a>


    </p>
@endsection
