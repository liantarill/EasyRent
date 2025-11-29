@extends('layouts.app')

@push('styles')
<style>
:root {
    --bg: #f5f7fb;
    --card: #ffffff;
    --text: #0f172a;
    --muted: #6b7280;
    --border: #e5e7eb;
    --shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

body {
    background: var(--bg);
    overflow-x: hidden;
    box-sizing: border-box;
}

.admin-dashboard {
    display: flex;
    min-height: 100vh;
    background: var(--bg);
    color: var(--text);
    overflow-x: hidden;
}

.dashboard-main {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    flex: 1;
    padding: 24px 24px 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.search-bar {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: var(--shadow);
}

.search-bar input {
    width: 100%;
    border: none;
    outline: none;
    font-size: 14px;
    color: var(--text);
}

.search-icon {
    color: #9ca3af;
}

.profile-chip {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--card);
    padding: 10px 14px;
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: var(--shadow);
}

.profile-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.profile-name {
    font-weight: 700;
    font-size: 14px;
}

.profile-email {
    font-size: 12px;
    color: var(--muted);
}

.avatar {
    width: 36px;
    height: 36px;
    display: grid;
    place-items: center;
    border-radius: 12px;
    background: #2563eb;
    color: #fff;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 16px;
}

.metric-card {
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    box-shadow: var(--shadow);
}

.metric-icon {
    width: 44px;
    height: 44px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    font-weight: 700;
}

.metric-label {
    margin: 0;
    font-size: 13px;
    color: var(--muted);
}

.metric-value-row {
    display: flex;
    align-items: center;
    gap: 8px;
}

.metric-value {
    font-size: 22px;
    font-weight: 800;
    margin: 0;
}

.content-grid {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
    gap: 20px;
    width: 100%;
    box-sizing: border-box;
}

.primary-column {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    box-shadow: var(--shadow);
    padding: 18px;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 12px;
}

.card-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 800;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.filters select,
.filters input {
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 8px 10px;
    font-size: 13px;
    background: #f9fafb;
}

.table-wrapper {
    overflow-x: auto;
}

table {
    width: 100%;
    table-layout: auto;
    border-collapse: separate;
    border-spacing: 0;
}

table thead {
    background: #f9fafb;
}

table th,
table td {
    text-align: left;
    padding: 12px 14px;
    font-size: 13px;
    border-bottom: 1px solid var(--border);
    white-space: normal;
    word-break: break-word;
    vertical-align: middle;
}

.nowrap {
    white-space: nowrap;
}

table th:first-child,
table td:first-child {
    border-left: 1px solid var(--border);
}

table th:last-child,
table td:last-child {
    border-right: 1px solid var(--border);
}

.table-wrapper table tr:last-child td {
    border-bottom: 1px solid var(--border);
}

.table-head-light th {
    background: #fbfbfb;
    font-weight: 700;
}

.tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    border: 1px solid transparent;
    white-space: nowrap;
}

.tag-available {
    background: #ecfdf3;
    color: #16a34a;
    border-color: #bbf7d0;
}

.tag-rented,
.tag-pending {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.tag-ongoing {
    background: #eef2ff;
    color: #4338ca;
    border-color: #c7d2fe;
}

.tag-returned {
    background: #ecfeff;
    color: #0ea5e9;
    border-color: #bae6fd;
}

.tag-maintenance {
    background: #fefce8;
    color: #ca8a04;
    border-color: #fef08a;
}

.table-link {
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
}

.action-link {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    line-height: 1.2;
}

.actions {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 6px;
}

.availability-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.availability-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: #f9fafb;
}

.car-name {
    font-weight: 700;
    margin-bottom: 4px;
}

.car-plate {
    font-size: 12px;
    color: var(--muted);
}

@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .topbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .profile-chip {
        align-self: flex-end;
    }
}
</style>
@endpush

@section('content')
@php
    $statCards = [
        ['label' => 'Total Mobil', 'value' => 24, 'icon' => 'M', 'icon_bg' => '#e0f2fe', 'icon_fg' => '#1d4ed8'],
        ['label' => 'Mobil Tersedia', 'value' => 16, 'status' => 'available', 'icon' => 'T', 'icon_bg' => '#fef3c7', 'icon_fg' => '#d97706'],
        ['label' => 'Transaksi Aktif', 'value' => 8, 'status' => 'ongoing', 'icon' => 'A', 'icon_bg' => '#ecfdf3', 'icon_fg' => '#15803d'],
        ['label' => 'Pembayaran Pending', 'value' => 5, 'status' => 'pending', 'icon' => 'P', 'icon_bg' => '#fee2e2', 'icon_fg' => '#b91c1c'],
    ];

    $transactions = [
        ['code' => 'ER-001', 'renter' => 'Budi Santoso', 'vehicle' => 'Toyota Avanza', 'start' => '15 Nov 2024', 'end' => '18 Nov 2024', 'total' => 450000, 'status' => 'Pending'],
        ['code' => 'ER-002', 'renter' => 'Sari Wulandari', 'vehicle' => 'Honda Brio', 'start' => '12 Nov 2024', 'end' => '14 Nov 2024', 'total' => 300000, 'status' => 'Ongoing'],
        ['code' => 'ER-003', 'renter' => 'Ahmad Rizki', 'vehicle' => 'Mitsubishi Xpander', 'start' => '10 Nov 2024', 'end' => '12 Nov 2024', 'total' => 600000, 'status' => 'Returned'],
    ];

    $payments = [
        ['code' => 'ER-001', 'renter' => 'Budi Santoso', 'method' => 'Transfer BCA', 'date' => '15 Nov 2024', 'amount' => 450000],
        ['code' => 'ER-004', 'renter' => 'Lisa Permata', 'method' => 'Transfer Mandiri', 'date' => '14 Nov 2024', 'amount' => 350000],
    ];

    $availability = [
        ['name' => 'Toyota Avanza', 'plate' => 'B 1234 ABC', 'status' => 'Available'],
        ['name' => 'Honda Brio', 'plate' => 'B 6781 FTR', 'status' => 'Rented'],
        ['name' => 'Mitsubishi Xpander', 'plate' => 'B 8972 QHI', 'status' => 'Available'],
        ['name' => 'Daihatsu Terios', 'plate' => 'B 3456 JKL', 'status' => 'Maintenance'],
        ['name' => 'Suzuki Ertiga', 'plate' => 'B 7890 MNO', 'status' => 'Available'],
        ['name' => 'Toyota Innova', 'plate' => 'B 3456 JKL', 'status' => 'Rented'],
        ['name' => 'Honda Jazz', 'plate' => 'B 1876 STU', 'status' => 'Available'],
        ['name' => 'Nissan Grand Livina', 'plate' => 'B 9753 VWX', 'status' => 'Available'],
    ];
@endphp
    <div class="admin-dashboard">
        @include('layouts.partials.sidebar')

        <div class="dashboard-main">
            <div class="topbar">
                <div class="search-bar">
                    <span class="search-icon">&#128269;</span>
                    <input type="text" placeholder="Cari transaksi, mobil, atau penyewa...">
                </div>

                <div class="profile-chip">
                    <div class="profile-text">
                        <span class="profile-name">Admin Rental</span>
                        <span class="profile-email">admin@easyrent.com</span>
                    </div>
                    <div class="avatar">AR</div>
                </div>
            </div>

            <div class="metrics-grid">
                @foreach ($statCards as $card)
                    <div class="metric-card">
                        <div class="metric-icon" style="background: {{ $card['icon_bg'] }}; color: {{ $card['icon_fg'] }};">
                            {{ $card['icon'] }}
                        </div>
                        <div>
                            <p class="metric-label">{{ $card['label'] }}</p>
                            <div class="metric-value-row">
                                <span class="metric-value">{{ $card['value'] }}</span>
                                @if (isset($card['status']))
                                    <span class="tag tag-{{ $card['status'] }}">{{ ucfirst($card['status']) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="content-grid">
                <div class="primary-column">
                    <div class="card">
                        <div class="card-header">
                            <h3>Transaksi Terbaru</h3>
                            <div class="filters">
                                <select>
                                    <option>Status Sewa</option>
                                    <option>Pending</option>
                                    <option>Ongoing</option>
                                    <option>Returned</option>
                                </select>
                                <select>
                                    <option>Status Bayar</option>
                                    <option>Terbayar</option>
                                    <option>Pending</option>
                                </select>
                                <input type="text" placeholder="mm/dd/yyyy">
                                <input type="text" placeholder="Kata kunci...">
                            </div>
                        </div>
                        <div class="table-wrapper">
                            <table class="table-head-light">
                                <thead>
                                    <tr>
                                        <th>Kode Order</th>
                                        <th>Penyewa</th>
                                        <th>Mobil</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Selesai</th>
                                        <th>Total</th>
                                        <th>Status Sewa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        @php
                                            $statusClass = 'tag-' . strtolower($item['status']);
                                        @endphp
                                        <tr>
                                            <td>{{ $item['code'] }}</td>
                                            <td>{{ $item['renter'] }}</td>
                                            <td>{{ $item['vehicle'] }}</td>
                                            <td>{{ $item['start'] }}</td>
                                            <td>{{ $item['end'] }}</td>
                                            <td><span class="nowrap">Rp {{ number_format($item['total'], 0, ',', '.') }}</span></td>
                                            <td><span class="tag {{ $statusClass }}">{{ $item['status'] }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>Pembayaran Menunggu Verifikasi</h3>
                        </div>
                        <div class="table-wrapper">
                            <table class="table-head-light">
                                <thead>
                                    <tr>
                                        <th>Kode Order</th>
                                        <th>Penyewa</th>
                                        <th>Metode</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment['code'] }}</td>
                                            <td>{{ $payment['renter'] }}</td>
                                            <td>{{ $payment['method'] }}</td>
                                            <td>{{ $payment['date'] }}</td>
                                            <td><span class="nowrap">Rp {{ number_format($payment['amount'], 0, ',', '.') }}</span></td>
                                            <td><a href="#" class="table-link">Lihat Bukti</a></td>
                                            <td class="actions">
                                                <a href="#" class="table-link action-link" style="color: #16a34a;">&#10003; Verif</a>
                                                <a href="#" class="table-link action-link" style="color: #dc2626;">&#10005; Tolak</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column">
                    <div class="card availability-card">
                        <div class="card-header">
                            <h3>Ketersediaan Mobil</h3>
                        </div>
                        <div class="availability-list">
                            @foreach ($availability as $car)
                                <div class="availability-item">
                                    <div>
                                        <div class="car-name">{{ $car['name'] }}</div>
                                        <div class="car-plate">{{ $car['plate'] }}</div>
                                    </div>
                                    <span class="tag tag-{{ strtolower($car['status']) }}">{{ $car['status'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
