@extends('layouts.app')

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            /* gabungkan border antar sel */
            border: 2px solid black;
            /* border luar tabel */
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
    <table>
        <thead>
            <th>id</th>
            <th>brand</th>
            <th>year</th>
            <th>plate_number</th>
            <th>transmission</th>
            <th>fuel type</th>
            <th>capacity</th>
            <th>price per day</th>
            <th>description</th>
            <th>photo</th>
            <th>vehicle type</th>
            <th>status</th>
            <th>aksi</th>

        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->brand }}</td>
                    <td>{{ $vehicle->year }}</td>
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->transmission }}</td>
                    <td>{{ $vehicle->fuel_type }}</td>
                    <td>{{ $vehicle->capacity }}</td>
                    <td>{{ $vehicle->price_per_day }}</td>
                    <td>{{ $vehicle->description }}</td>
                    <td>{{ $vehicle->photo }}</td>
                    <td>{{ $vehicle->vehicle_type }}</td>
                    <td>{{ $vehicle->status }}</td>
                    <td>
                        <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}">
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        {{-- <form action="{{ route('staff.vehicles.destroy', $patient->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                Hapus
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
