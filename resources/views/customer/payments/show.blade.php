@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Rent Details</div>



                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <h5>Vehicle: {{ $rent->vehicle->name }}</h5>
                        <p>Rent Date: {{ $rent->rent_date->format('d M Y') }}</p>
                        <p>Return Date: {{ $rent->return_date->format('d M Y') }}</p>
                        <p>Total Price: Rp {{ number_format($rent->total_price, 0, ',', '.') }}</p>
                        <p>Status: <span class="badge badge-info">{{ $rent->rent_status }}</span></p>

                        @if ($rent->payment)
                            <p>Payment Status:
                                <span
                                    class="badge badge-{{ $rent->payment->status == 'settlement' ? 'success' : 'warning' }}">
                                    {{ ucfirst($rent->payment->status) }}
                                </span>
                            </p>
                        @endif

                        @if ($snapToken && (!$rent->payment || !in_array($rent->payment->status, ['settlement', 'capture'])))
                            <button id="pay-button" class="btn btn-primary">Pay Now</button>
                        @elseif($rent->payment && in_array($rent->payment->status, ['settlement', 'capture']))
                            <div class="alert alert-success">Payment completed successfully!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($snapToken)
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
        </script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href = '{{ route('customer.payments.show', $rent->id) }}';
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route('customer.payments.show', $rent->id) }}';
                    },
                    onError: function(result) {
                        alert('Payment failed!');
                    }
                });
            };
        </script>
    @endif
@endsection
