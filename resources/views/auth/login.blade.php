@extends('layouts.app')


@push('styles')
    <style>
        body::before {
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url("{{ asset('images/bg.jpg') }}");
            background-size: cover;
            background-position: center;
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
    </style>
@endpush
@section('content')
    <nav id="nav"
        class="bg-black/60 backdrop-blur-lg border-b border-primary-main/10 fixed top-0 right-0 left-0 z-50 transition-all duration-150 ease-linear">
        <div class="flex justify-between items-center px-6 md:px-16 py-5">
            <a href="/"
                class="text-white font-black text-2xl tracking-widest hover:text-primary-light transition-colors duration-300">
                EASY<span class="text-primary-main">RENT</span>
            </a>
        </div>
    </nav>
    <div class="min-h-screen flex items-center justify-center  p-4">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 right-10 w-40 h-40 bg-primary-light opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-40 h-40 bg-primary-light opacity-10 rounded-full blur-3xl">
            </div>
        </div>

        <!-- Main container -->
        <div class="relative w-full max-w-2xl">
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header section -->
                <div class="bg-linear-to-r from-primary-main to-primary-light px-8 py-12">
                    <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang di EasyRent</h1>
                    <p class="text-primary-pale text-sm">Masuk ke Akun Anda Untuk Melanjutkan</p>
                </div>

                <!-- Form section -->
                <div class="p-8">
                    @if (session('failed'))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                            <p class="font-semibold">Login Failed</p>
                            <p class="text-sm">{{ session('failed') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-5">
                        @csrf

                        <!-- Email field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-primary-dark mb-2">
                                Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus
                                required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200 @error('email') border-red-500 @enderror"
                                placeholder="Enter your email">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <span class="inline-block w-1 h-1 bg-red-600 rounded-full mr-2"></span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password field -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-primary-dark mb-2">
                                Password
                            </label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Enter your password">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <span class="inline-block w-1 h-1 bg-red-600 rounded-full mr-2"></span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember me & Forgot password -->
                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="remember"
                                    class="w-4 h-4 text-primary-main rounded accent-primary-main">
                                <span class="ml-2 text-gray-700">Ingat saya</span>
                            </label>
                            <a href="#" class="text-primary-main hover:text-primary-light transition">
                                Lupa password?
                            </a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit"
                            class="w-full mt-8 bg-linear-to-r from-primary-main to-primary-light text-white font-semibold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            Masuk
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Belum punya akun?</span>
                        </div>
                    </div>

                    <!-- Register link -->
                    <div class="mt-6">
                        <a href="{{ route('register') }}"
                            class="block w-full text-center py-3 border-2 border-primary-main text-primary-main font-semibold rounded-lg hover:bg-primary-pale transition duration-200">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>

                <!-- Footer section -->
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-xs text-gray-500">
                    <p>© 2025 EasyRent. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
