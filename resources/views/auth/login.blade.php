@extends('layouts.app')

@section('content')
    <div class="relative w-full h-screen bg-cover bg-center overflow-hidden flex items-center justify-center"
        style="background-image: linear-gradient(135deg, rgba(10,10,15,0.55) 0%, rgba(234,88,12,0.15) 100%), url('/images/hero3.jpg'); background-attachment: fixed;">

        <nav id="nav" class="fixed top-0 right-0 left-0 z-50 transition-all duration-150 ease-linear">
            <div class="flex justify-between items-center px-6 md:px-16 py-5">
                <a href="/"
                    class="text-white font-black text-2xl tracking-widest hover:text-primary-light transition-colors duration-300">
                    EASY<span class="text-primary-main">RENT</span>
                </a>
            </div>
        </nav>



        <div class="relative w-full max-w-lg">
            <div
                class="bg-linear-to-br from-gray-900 to-gray-900/50 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">

                <div class="relative px-8 py-12 border-b border-gray-800">

                    <div class="relative z-10">
                        <div class="mb-4 inline-block">
                            <span class="text-primary-light font-semibold tracking-widest uppercase text-xs">
                                Login Easyrent
                            </span>
                        </div>
                        <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Selamat Datang Kembali</h1>
                        <p class="text-gray-300 text-sm">Masuk untuk mengakses pengalaman sewa kendaraan terbaik Anda</p>
                    </div>
                </div>
                <div class="p-8">
                    @if (session('failed'))
                        <div class="mb-6 p-4 bg-red-500/10 border-l-4 border-red-500 text-red-400 rounded">
                            <p class="font-semibold">Login Failed</p>
                            <p class="text-sm">{{ session('failed') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="/login" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-3">
                                Email Address
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus
                                required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200 @error('email') border-red-500 @enderror"
                                placeholder="your@email.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-300 mb-3">
                                Password
                            </label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Enter your password">
                            @error('password')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" name="remember"
                                    class="w-4 h-4 bg-gray-800 border-gray-700 rounded accent-primary-main">
                                <span class="ml-2 text-gray-400 group-hover:text-gray-300 transition">Remember me</span>
                            </label>
                            <a href="{{ route('forgot-password.index') }}"
                                class="text-primary-light hover:text-primary-main transition duration-200">
                                Forgot password?
                            </a>
                        </div>

                        <button type="submit"
                            class="w-full mt-8 bg-linear-to-r from-primary-main to-primary-light text-white font-bold py-3 rounded-lg hover:shadow-2xl hover:shadow-primary-main/30 transform hover:translate-y-1 transition duration-300">
                            Sign In
                        </button>
                    </form>


                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-800"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-linear-to-br from-gray-900 to-gray-900/50 text-gray-400">Belum memiliki
                                akun?</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="/register"
                            class="block w-full text-center py-3 border-2 border-primary-main text-primary-light font-semibold rounded-lg hover:bg-primary-main/10 hover:text-primary-main transition duration-200">
                            Sign Up
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
