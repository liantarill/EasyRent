@extends('layouts.app')

@section('content')
    <div>
        <p>Customer: {{ $rent->user->name }}</p>
    </div>

    <div>
        <p>Brand: {{ $rent->vehicle->brand }}</p>
    </div>

    <p>Nomor Kendaraan: {{ $rent->vehicle->plate_number }}</p>

    <p>Rent Date: {{ $rent->rent_date }}</p>

    <p>Return Date: {{ $rent->return_date }}</p>

    <p>Daily Price: {{ $rent->daily_price_snapshot }}</p>

    <p>Total Price: {{ $rent->total_price }}</p>



    <p>Rent Status: {{ $rent->rent_status }} </p>

    <p>Metode Pembayaran: {{ $rent->payment->method ?? 'Belum bayar' }}</p>

    <p>Status Pembayaran: {{ $rent->payment?->status ?? 'Belum Dibayar' }}</p>


    </p>
@endsection
