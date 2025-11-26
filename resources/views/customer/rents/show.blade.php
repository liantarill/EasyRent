@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                {{ session('info') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start gap-6">
                <div class="w-40 h-28 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                    @if ($rent->vehicle->photo)
                        <img src="{{ asset('storage/' . $rent->vehicle->photo) }}" alt="{{ $rent->vehicle->brand }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>

                <div class="flex-1">
                    <h2 class="text-2xl font-semibold">{{ $rent->vehicle->brand ?? 'Vehicle' }}</h2>
                    <p class="text-sm text-gray-500">{{ $rent->vehicle->plate_number ?? '-' }} •
                        {{ $rent->vehicle->transmission ?? '' }}</p>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm text-gray-700">
                        <div><strong>Rent Date</strong><br>{{ $rent->rent_date->format('d M Y') }}</div>
                        <div><strong>Return Date</strong><br>{{ $rent->return_date->format('d M Y') }}</div>

                        <div><strong>Daily Price</strong><br>Rp
                            {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</div>
                        <div><strong>Total Price</strong><br>Rp {{ number_format($rent->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="w-48 text-right flex-shrink-0">
                    <div class="mb-3">
                        <span
                            class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                        @if ($rent->rent_status === 'Verified') bg-green-100 text-green-700
                        @elseif($rent->rent_status === 'Rejected') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                            {{ $rent->rent_status }}
                        </span>
                    </div>

                    {{-- Payment status --}}
                    @if ($rent->payment)
                        <div class="text-sm">
                            <div><strong>Payment:</strong></div>
                            <div class="text-xs text-gray-500">{{ $rent->payment->method }}</div>
                            <div class="mt-1">
                                @php
                                    $paymentStatus = strtolower($rent->payment->status);
                                @endphp
                                @if ($paymentStatus === 'paid')
                                    <span
                                        class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Paid
                                    </span>
                                @elseif(in_array($paymentStatus, ['pending', 'pending payment']))
                                    <span
                                        class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        {{ ucfirst($rent->payment->status) }}
                                    </span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        {{ ucfirst($rent->payment->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <hr class="my-6">

            {{-- Action area --}}
            @php
                $hasPaid = $rent->payment && strtolower($rent->payment->status) === 'paid';
                $hasPending =
                    $rent->payment && in_array(strtolower($rent->payment->status), ['pending', 'pending payment']);
                $hasFailed = $rent->payment && in_array(strtolower($rent->payment->status), ['failed', 'expired']);
            @endphp

            @if ($hasPaid)
                <div class="bg-green-50 border border-green-200 rounded p-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <div class="text-green-700 font-semibold">Payment Completed</div>
                            <div class="text-green-600 text-sm">Thank you for your payment!</div>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        @if ($hasPending)
                            <div class="mb-2">
                                <span class="font-semibold">Payment Pending</span><br>
                                Complete your payment to confirm the rental.
                            </div>
                        @elseif($hasFailed)
                            <div class="mb-2">
                                <span class="font-semibold text-red-600">Payment
                                    {{ ucfirst($rent->payment->status) }}</span><br>
                                Please try again to complete your rental.
                            </div>
                        @else
                            <div class="mb-2">
                                <span class="font-semibold">Payment Required</span><br>
                                Complete payment to confirm your rental.
                            </div>
                        @endif

                        @if ($rent->payment)
                            <div class="text-xs text-gray-400">Order ID: {{ $rent->payment->order_id }}</div>
                        @endif
                    </div>

                    <form action="{{ route('customer.payments.checkout', $rent->id, $rent->payment->snap_token) }}"
                        method="GET">
                        <input type="hidden" name="rent_date" value="{{ $rent->rent_date->format('Y-m-d') }}">
                        <input type="hidden" name="return_date" value="{{ $rent->return_date->format('Y-m-d') }}">

                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold transition">
                            @if ($hasPending || $hasFailed)
                                Retry Payment
                            @else
                                Pay Now
                            @endif
                        </button>
                    </form>
                </div>
            @endif

            {{-- Payment details --}}
            @if ($rent->payment)
                <div class="mt-6 bg-gray-50 p-4 rounded">
                    <div class="text-sm font-semibold mb-2">Payment Details</div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div class="text-gray-600">Order ID:</div>
                        <div class="font-mono text-xs">{{ $rent->payment->order_id }}</div>

                        <div class="text-gray-600">Amount:</div>
                        <div>Rp {{ number_format($rent->payment->amount, 0, ',', '.') }}</div>

                        <div class="text-gray-600">Method:</div>
                        <div>{{ ucfirst($rent->payment->method) }}</div>

                        <div class="text-gray-600">Status:</div>
                        <div>{{ ucfirst($rent->payment->status) }}</div>

                        @if ($rent->payment->updated_at)
                            <div class="text-gray-600">Last Updated:</div>
                            <div>{{ $rent->payment->updated_at->format('d M Y H:i') }}</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        {{-- Back button --}}
        <div class="mt-4">
            <a href="{{ route('customer.rents.index') }}"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to My Rentals
            </a>
        </div>
    </div>
@endsection
