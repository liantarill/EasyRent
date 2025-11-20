@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12">
        <div class="w-full max-w-md bg-white rounded-xl shadow p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Reset your password</h2>
            <p class="text-sm text-gray-500 mb-6">Enter your email to receive a password reset link.</p>

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('forgot-password.sendResetEmail') }}" class="space-y-4">
                @csrf

                <label class="block">


                    <input type="hidden" name="type" value="reset">
                    <span class="text-sm text-gray-700">Email</span>
                    <input type="email" name="email" required autofocus value="{{ old('email') }}"
                        class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:border-primary-main">
                </label>
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit"
                    class="w-full py-2 rounded bg-primary-main text-white font-semibold hover:bg-primary-dark">
                    Send reset link
                </button>
            </form>
        </div>
    </div>
@endsection
