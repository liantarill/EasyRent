@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-bg flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-6xl">
            <!-- Main Container with Two Columns -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white rounded-xl overflow-hidden shadow-2xl">

                <!-- Left: Dark Overlay Section -->
                <div
                    class="hidden lg:flex relative overflow-hidden bg-linear-to-br from-gray-900 via-gray-800 to-gray-900 items-center justify-center p-12">
                    <!-- Added dark overlay background with branded content section -->

                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <div
                            class="absolute top-0 left-0 w-96 h-96 bg-primary-main rounded-full mix-blend-multiply filter blur-3xl">
                        </div>
                        <div
                            class="absolute bottom-0 right-0 w-96 h-96 bg-primary-dark rounded-full mix-blend-multiply filter blur-3xl">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="relative z-10 text-center lg:text-left">
                        <div class="mb-4 inline-block lg:block">
                            <span class="text-primary-light font-bold text-sm tracking-widest uppercase">Security
                                Verified</span>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4 leading-tight">
                            Verify Your Identity
                        </h1>
                        <p class="text-gray-300 text-lg leading-relaxed max-w-md">
                            We'll send a one-time password to your email. This keeps your account secure and protected.
                        </p>


                    </div>
                </div>

                <!-- Right: Form Section -->
                <div class="flex flex-col justify-center p-8 lg:p-12">
                    <!-- Clean white form area with teal accents -->

                    <!-- Header -->
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-2 mb-4 px-3 py-1 bg-primary-accent rounded-full">
                            <div class="w-2 h-2 rounded-full bg-primary-main"></div>
                            <span class="text-xs font-semibold text-primary-dark uppercase tracking-wider">Step 1 of
                                2</span>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                            Send Verification Code
                        </h2>
                        <p class="text-gray-600 text-base">We'll send a secure one-time password to your email address.</p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm font-semibold text-red-800 mb-2">Please correct the following errors:</p>
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-700">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('failed'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-700">{{ session('failed') }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('verify.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">

                        <!-- Info Box -->
                        <div class="bg-primary-accent rounded-lg p-4 border border-primary-light">
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold text-gray-900">Verification will be sent to:</span><br>
                                <span
                                    class="text-primary-dark font-medium mt-1 block">{{ session('email') ?? 'your registered email' }}</span>
                            </p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-primary-main hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Send Verification Code
                        </button>

                        <!-- Help Text -->
                        <p class="text-xs text-gray-500 text-center">
                            Your code will arrive within seconds. Check your spam folder if needed.
                        </p>
                    </form>

                    <!-- Divider -->
                    <div class="my-6 border-t border-gray-200"></div>

                    <!-- Footer Link -->
                    <p class="text-xs text-gray-600 text-center">
                        Your data is encrypted and secure. <a href="#"
                            class="text-primary-main hover:text-primary-dark font-semibold">Learn more</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
