@extends('layouts.app')

@section('content')
    <div class="relative w-full min-h-screen bg-white flex overflow-hidden">
        <!-- Left Panel - Branding & Visual Content -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden items-center justify-center">
            <!-- Decorative gradient elements -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-main/20 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-light/10 rounded-full blur-3xl opacity-50"></div>

            <!-- Background image overlay -->
            <div class="absolute inset-0 opacity-30"
                style="background-image: url('/images/hero2-temp.jpg'); background-size: cover; background-position: center;">
            </div>

            <!-- Content -->
            <div class="relative z-10 text-center px-8">
                <div class="mb-8">
                    <a href="/"
                        class="text-white font-black text-3xl tracking-widest hover:text-primary-light transition-colors duration-300">
                        EASY<span class="text-primary-light">RENT</span>
                    </a>
                </div>

                <h2 class="text-5xl font-black text-white mb-6 leading-tight tracking-tight">
                    Mobilitas<br>Tanpa Batas
                </h2>

                <p class="text-lg text-gray-300 mb-12 max-w-sm leading-relaxed font-light">
                    Nikmati pengalaman sewa kendaraan premium dengan layanan terpercaya dan armada berkualitas tinggi.
                </p>

                <!-- Progress indicators -->
                <div class="flex justify-center gap-2">
                    <div class="h-1 w-8 bg-primary-light rounded-full"></div>
                    <div class="h-1 w-4 bg-gray-600 rounded-full"></div>
                    <div class="h-1 w-4 bg-gray-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12">
            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 bg-primary-main rounded-full"></div>
                        <span class="text-primary-main font-semibold tracking-widest uppercase text-xs">Login</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 mb-3 tracking-tight">
                        Selamat Datang Kembali
                    </h1>
                    <p class="text-gray-600 text-base">
                        Masuk untuk mengakses armada kendaraan pilihan Anda
                    </p>
                </div>

                <!-- Messages -->
                @if (session('failed'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                        <p class="font-semibold text-sm">Login Gagal</p>
                        <p class="text-sm mt-1">{{ session('failed') }}</p>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg">
                        <p class="font-semibold text-sm">Password Berhasil Diperbarui</p>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="/login" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-3">
                        <label for="email" class="block text-sm font-semibold text-gray-900">
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 text-gray-900 rounded-xl focus:outline-none focus:border-primary-main focus:bg-white focus:ring-1 focus:ring-primary-main/20 transition duration-200 @error('email') border-red-500 bg-red-50 @enderror"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586 3.313 10.899a1 1 0 00-1.414 1.414l7 7a1 1 0 001.414 0l8-8z"
                                        clip-rule="evenodd" />
                                    </path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-3">
                        <label for="password" class="block text-sm font-semibold text-gray-900">
                            Password
                        </label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 text-gray-900 rounded-xl focus:outline-none focus:border-primary-main focus:bg-white focus:ring-1 focus:ring-primary-main/20 transition duration-200 @error('password') border-red-500 bg-red-50 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18.101 12.93a1 1 0 00-1.414-1.414L10 17.586 3.313 10.899a1 1 0 00-1.414 1.414l7 7a1 1 0 001.414 0l8-8z"
                                        clip-rule="evenodd" />
                                    </path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="flex items-center justify-between text-sm py-1">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 bg-white border-2 border-gray-300 rounded-md accent-primary-main cursor-pointer">
                            <span class="ml-2 text-gray-700 group-hover:text-gray-900 transition">Ingat saya</span>
                        </label>
                        <a href="{{ route('forgot-password.index') }}"
                            class="text-primary-main hover:text-primary-dark font-medium transition duration-200">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit"
                        class="w-full mt-8 bg-gradient-to-r from-primary-main to-primary-dark text-white font-bold py-3 px-4 rounded-xl hover:shadow-lg hover:shadow-primary-main/30 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Masuk Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-8 relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-white text-gray-500 font-medium">atau</span>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <div class="mt-8">
                    <p class="text-center text-gray-600 text-sm mb-4">
                        Belum memiliki akun?
                    </p>
                    <a href="/register"
                        class="block w-full text-center py-3 px-4 border-2 border-primary-main text-primary-main font-bold rounded-xl hover:bg-primary-accent/50 hover:border-primary-dark transition-all duration-200 group">
                        Buat Akun Baru
                    </a>
                </div>

                <!-- Footer -->
                <p class="text-center text-xs text-gray-500 mt-8">
                    Dengan masuk, Anda menyetujui <a href="#" class="text-primary-main hover:text-primary-dark">Syarat
                        & Ketentuan</a> kami
                </p>
            </div>
        </div>

        <!-- Mobile Header (visible on small screens) -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 p-4">
            <a href="/" class="text-gray-900 font-black text-xl tracking-widest">
                EASY<span class="text-primary-main">RENT</span>
            </a>
        </div>

        <!-- Mobile adjustment -->
        <style>
            @media (max-width: 1024px) {
                .lg\:flex {
                    padding-top: 4rem;
                }
            }
        </style>
    </div>
@endsection
