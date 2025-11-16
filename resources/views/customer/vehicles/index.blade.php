@extends('layouts.app')

@section('content')
    @include('layouts.partials.navbar')

    <div style="max-width: 960px; margin: 120px auto 60px; padding: 0 16px;">
        <h1 style="margin-bottom: 8px;">Daftar Kendaraan Tersedia</h1>
        <p style="color: #444; margin-bottom: 24px;">Semua data kendaraan ditampilkan apa adanya agar mudah dibaca.</p>

        <form method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px;">
            <div style="flex: 1 1 220px;">
                <label for="search" style="display: block; font-size: 14px; margin-bottom: 4px;">Cari</label>
                <input type="text" id="search" name="search" value="{{ $filters['search'] ?? '' }}"
                    placeholder="Merek / Plat"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="flex: 1 1 160px;">
                <label for="type" style="display: block; font-size: 14px; margin-bottom: 4px;">Tipe</label>
                <select id="type" name="type" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Semua</option>
                    <option value="car" @selected(($filters['type'] ?? '') === 'car')>Mobil</option>
                    <option value="motorcycle" @selected(($filters['type'] ?? '') === 'motorcycle')>Motor</option>
                </select>
            </div>

            <div style="flex: 1 1 160px;">
                <label for="transmission" style="display: block; font-size: 14px; margin-bottom: 4px;">Transmisi</label>
                <select id="transmission" name="transmission"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Semua</option>
                    <option value="automatic" @selected(($filters['transmission'] ?? '') === 'automatic')>Automatic</option>
                    <option value="manual" @selected(($filters['transmission'] ?? '') === 'manual')>Manual</option>
                </select>
            </div>

            <div style="display: flex; align-items: flex-end; gap: 8px;">
                <button type="submit"
                    style="padding: 9px 20px; border: 1px solid #222; background: #222; color: #fff; border-radius: 4px; cursor: pointer;">Filter</button>
                <a href="{{ route('customer.vehicles.index') }}"
                    style="padding: 9px 16px; border: 1px solid #ccc; border-radius: 4px; text-decoration: none; color: #333;">Reset</a>
            </div>
        </form>

        @if ($vehicles->isEmpty())
            <div style="border: 1px dashed #bbb; padding: 32px; text-align: center;">
                <strong>Tidak ada kendaraan yang cocok.</strong>
                <p style="margin-top: 8px; color: #555;">Ubah filter atau hubungi admin untuk ketersediaan terbaru.</p>
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
                <thead>
                    <tr style="background: #f4f4f4;">
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Merek</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Tipe</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Tahun</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Transmisi</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Harga / Hari</th>
                        <th style="border: 1px solid #ddd; padding: 10px; text-align: left;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 10px;">{{ $vehicle->brand }}</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">{{ ucfirst($vehicle->vehicle_type) }}</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">{{ $vehicle->year }}</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">{{ ucfirst($vehicle->transmission) }}</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">{{ $vehicle->formatted_price }}</td>
                            <td style="border: 1px solid #ddd; padding: 10px;">
                                <a href="{{ route('customer.vehicles.show', $vehicle) }}"
                                    style="display: inline-block; padding: 6px 12px; border: 1px solid #222; border-radius: 4px; text-decoration: none; color: #222;">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                {{ $vehicles->links() }}
            </div>
        @endif
    </div>
@endsection
