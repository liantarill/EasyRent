@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    @php
        $customer = auth()->user();
        $canRent = $customer && $customer->hasCompletedProfile();
    @endphp

    <div style="max-width: 720px; margin: 120px auto 60px; padding: 0 16px;">
        <a href="{{ route('customer.vehicles.index') }}"
            style="display: inline-block; margin-bottom: 20px; text-decoration:none;">
            &larr; Kembali ke daftar kendaraan
        </a>

        @if ($errors->any())
            <div>
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color:red;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 style="margin-bottom: 8px;">{{ $vehicle->brand }}</h1>
        <p style="color: #555; margin-bottom: 24px;">Detail kendaraan lengkap tersedia di bawah.</p>

        <div style="border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 24px;">
            <h2 style="margin-bottom: 12px;">Info Kendaraan</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="width: 40%; padding: 8px; border: 1px solid #eee;">Merek / Model</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ $vehicle->brand }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Jenis</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ ucfirst($vehicle->vehicle_type) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Tahun</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ $vehicle->year }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Plat Nomor</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ $vehicle->plate_number }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Transmisi</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ ucfirst($vehicle->transmission) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Bahan Bakar</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ ucfirst($vehicle->fuel_type) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Kapasitas</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ $vehicle->capacity }} Kursi</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee;">Deskripsi</td>
                        <td style="padding: 8px; border: 1px solid #eee;">{{ $vehicle->description ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="border: 1px solid #ddd; border-radius: 6px; padding: 20px; margin-bottom: 24px;">
            <h2 style="margin-bottom: 12px;">Harga & Status</h2>
            <p style="margin: 0 0 8px;">Harga sewa per hari: <strong>{{ $vehicle->formatted_price }}</strong></p>
            <p style="margin: 0 0 12px;">Status: <strong>{{ $vehicle->status }}</strong></p>

            @if ($canRent)
                <form action="{{ route('customer.rents.create', $vehicle->id) }}" method="GET">
                    <button type="submit"
                        style="padding: 10px 18px; background: #222; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
                        Sewa Sekarang
                    </button>
                </form>
            @else
                <div style="padding: 16px; border: 1px solid #f2c94c; border-radius: 6px; background: #fff9e6;">
                    <p style="margin: 0 0 8px; color: #8a6d1d; font-weight: 600;">Profil Anda belum lengkap.</p>
                    <p style="margin: 0 0 12px; color: #8a6d1d;">Lengkapi data diri sebelum melakukan peminjaman.</p>
                    <a href="{{ route('customer.profile') }}"
                        style="display: inline-block; padding: 8px 14px; border-radius: 5px; border: 1px solid #8a6d1d; color: #8a6d1d; text-decoration: none;">
                        Lengkapi Profil
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
