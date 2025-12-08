@extends('layouts.app')

@section('content')
    <div class="relative w-full min-h-screen bg-white flex overflow-hidden">

        <!-- Left Panel -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden items-center justify-center">

            <!-- Decorative gradient circles -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary-main/20 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-light/10 rounded-full blur-3xl opacity-50"></div>

            <!-- Background image -->
            <div class="absolute inset-0 opacity-30"
                style="background-image: url('/images/hero2-temp.jpg'); background-size: cover; background-position: center;">
            </div>

            <!-- Branding Content -->
            <div class="relative z-10 text-center px-8">
                <a href="/" class="text-white font-black text-3xl tracking-widest">
                    EASY<span class="text-primary-light">RENT</span>
                </a>

                <h2 class="text-5xl font-black text-white mt-8 mb-6 leading-tight">
                    Pulihkan<br>Akses Akun Anda
                </h2>

                <p class="text-lg text-gray-300 max-w-sm mx-auto leading-relaxed">
                    Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
                </p>

                <!-- Progress dots -->
                <div class="flex justify-center gap-2 mt-10">
                    <div class="h-1 w-8 bg-primary-light rounded-full"></div>
                    <div class="h-1 w-4 bg-gray-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Right Panel (FORM) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12">
            <div class="w-full max-w-md">

                <!-- Title -->
                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 bg-primary-main rounded-full"></div>
                        <span class="text-primary-main font-semibold tracking-widest uppercase text-xs">
                            Reset Password
                        </span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 mb-3">Pulihkan Akses</h1>
                    <p class="text-gray-600 text-base">Kami akan mengirimkan link untuk mengatur ulang password Anda.</p>
                </div>

                <!-- Success message -->
                @if (session('status'))
                    <div
                        class="mb-6 p-4 bg-primary-accent/30 border border-primary-main/30 rounded-xl flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-main mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <div>
                            <p class="font-semibold text-sm text-primary-main">Sukses!</p>
                            <p class="text-sm text-gray-700">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="font-semibold text-red-800 mb-2 text-sm">Terjadi kesalahan</p>
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-700 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- FORM -->
                <form method="POST" action="{{ route('forgot-password.sendResetEmail') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="reset">

                    <!-- Email -->
                    <div class="space-y-3">
                        <label for="email" class="text-sm font-semibold text-gray-900">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-900
                            focus:outline-none focus:border-primary-main focus:bg-white focus:ring-1
                            focus:ring-primary-main/20 transition duration-200 @error('email') border-red-500 bg-red-50 @enderror"
                            placeholder="nama@example.com">
                        @error('email')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full mt-4 bg-gradient-to-r from-primary-main to-primary-dark text-white font-bold py-3 px-4 rounded-xl hover:shadow-lg hover:shadow-primary-main/30 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Kirim Link Reset</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600 text-sm">
                        Ingat password?
                        <a href="{{ route('login') }}" class="font-semibold text-primary-main hover:text-primary-dark">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <!-- Tips block -->
                <div class="mt-8 p-4 bg-primary-accent/10 border border-primary-main/20 rounded-xl text-center">
                    <p class="text-xs text-gray-600">
                        <span class="font-semibold text-gray-900">Tip:</span>
                        Periksa folder spam jika email tidak masuk dalam beberapa menit.
                    </p>
                </div>

            </div>
        </div>

        <!-- Mobile Header -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 p-4">
            <a href="/" class="text-gray-900 font-black text-xl tracking-widest">
                EASY<span class="text-primary-main">RENT</span>
            </a>
        </div>
    </div>
@endsection
