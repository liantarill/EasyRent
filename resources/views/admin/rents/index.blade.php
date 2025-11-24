@extends('layouts.app')

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
        }

        table th,
        table td {
            border: 1px solid black;
            /* border tiap sel */
            padding: 8px;
            /* jarak isi sel */
            text-align: left;
        }

        table thead {
            background-color: #f2f2f2;
            /* warna header opsional */
        }
    </style>
@endpush

@section('content')
    <div class="flex">
        @include('layouts.partials.sidebar')

        <table>
            <thead>
                <th>user</th>
                <th>brand</th>
                <th>rent_date</th>
                <th>return_date</th>
                <th>total_price</th>
                <th>rent_status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($rents as $rent)
                    <tr>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ $rent->vehicle->brand }}</td>
                        <td>{{ $rent->rent_date }}</td>
                        <td>{{ $rent->return_date }}</td>
                        <td>{{ $rent->total_price }}</td>
                        <td>{{ $rent->rent_status }}</td>
                        <td>
                            <a href="{{ route('admin.rents.show', $rent->id) }}">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
