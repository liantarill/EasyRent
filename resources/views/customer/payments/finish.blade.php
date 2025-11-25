@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow p-6">
            @if (strtolower($payment->status) === 'paid')
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-green-700">Payment Successful!</h2>
                    <p class="text-gray-600 mt-2">Your rental has been confirmed</p>
                </div>
            @else
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-semibold text-yellow-700">Payment {{ ucfirst($payment->status) }}</h2>
                    <p class="text-gray-600 mt-2">
                        @if (strtolower($payment->status) === 'pending')
                            Your payment is being processed
                        @else
                            Please check your payment status
                        @endif
                    </p>
                </div>
            @endif

            <hr class="my-6">

            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Order ID:</span>
                    <span class="font-semibold">{{ $payment->order_id }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Vehicle:</span>
                    <span class="font-semibold">{{ $payment->rent->vehicle->brand }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Rent Period:</span>
                    <span class="font-semibold">
                        {{ \Carbon\Carbon::parse($payment->rent->rent_date)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($payment->rent->return_date)->format('d M Y') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Amount:</span>
                    <span class="font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Payment Method:</span>
                    <span class="font-semibold">{{ ucfirst($payment->method) }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-600">Status:</span>
                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ strtolower($payment->status) === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex gap-3 justify-center">
                <a href="{{ route('customer.rents.show', $payment->rent->id) }}"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    View Rent Details
                </a>
                <a href="{{ route('customer.rents.index') }}"
                    class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    View All Rentals
                </a>
            </div>
        </div>
    </div>
@endsection
