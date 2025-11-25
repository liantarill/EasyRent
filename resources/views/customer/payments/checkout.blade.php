@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold mb-6">Complete Your Payment</h2>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="flex items-start gap-6 mb-6">
                <div class="w-40 h-28 bg-gray-100 rounded overflow-hidden">
                    @if ($rent->vehicle->photo)
                        <img src="{{ asset('storage/' . $rent->vehicle->photo) }}" alt="{{ $rent->vehicle->brand }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>

                <div class="flex-1">
                    <h3 class="text-xl font-semibold">{{ $rent->vehicle->brand ?? 'Vehicle' }}</h3>
                    <p class="text-sm text-gray-500">{{ $rent->vehicle->plate_number ?? '-' }} •
                        {{ $rent->vehicle->transmission ?? '' }}</p>

                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm text-gray-700">
                        <div><strong>Rent Date</strong><br>{{ \Carbon\Carbon::parse($rent->rent_date)->format('d M Y') }}
                        </div>
                        <div><strong>Return
                                Date</strong><br>{{ \Carbon\Carbon::parse($rent->return_date)->format('d M Y') }}</div>

                        <div><strong>Daily Price</strong><br>Rp
                            {{ number_format($rent->daily_price_snapshot, 0, ',', '.') }}</div>
                        <div><strong>Total Price</strong><br>Rp {{ number_format($rent->total_price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="text-center">
                <p class="text-gray-600 mb-4">Order ID: <strong>{{ $payment->order_id }}</strong></p>
                <p class="text-2xl font-bold text-gray-800 mb-6">
                    Total: Rp {{ number_format($rent->total_price, 0, ',', '.') }}
                </p>

                <button id="pay-button"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    window.location.href = '{{ route('customer.payments.finish', $payment->id) }}';
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    window.location.href = '{{ route('customer.payments.finish', $payment->id) }}';
                },
                onError: function(result) {
                    console.error('Payment error:', result);
                    alert('Payment failed! Please try again.');
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        };
    </script>
@endsection
