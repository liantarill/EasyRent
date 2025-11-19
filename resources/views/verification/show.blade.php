@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-md">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Verify Your Email</h2>
            <p class="text-center text-gray-500 mb-6">Enter the 6-digit OTP sent to your email</p>

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-center">{{ session('error') }}</div>
            @endif

            <form action="{{ route('verify.update', $unique_id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="number" name="otp" placeholder="Enter OTP"
                    class="w-full p-3 border border-gray-300 rounded-lg mb-4 text-center focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
                @error('otp')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-lg transition-colors">
                    Verify
                </button>
            </form>
        </div>
    </div>
@endsection
