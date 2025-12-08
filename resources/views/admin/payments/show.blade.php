@extends('layouts.app')

@section('content')
    <p>amount {{ $payment->amount }}</p>
    <p>method {{ $payment->method }}</p>
    <p>payment_proof {{ $payment->payment_proof ?? 'Tidak ada bukti bayar' }}</p>
    <p>verified_by {{ $payment->verifier->name ?? 'Not verified yet' }}</p>

    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Status :
            <select name="status">
                @foreach (['Pending', 'Paid', 'Failed'] as $status)
                    <option value="{{ $status }}" @selected(old('status', $payment->status) === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Simpan</button>
    </form>
@endsection
