@extends('layouts.app')


@section('content')
    <div class="min-h-screen w-full  bg-cover flex items-center justify-center p-20 relative overflow-hidden"
        style="background-image: linear-gradient(135deg, rgba(10,10,15,0.55) 0%, rgba(234,88,12,0.15) 100%), url('/images/hero3.jpg'); background-attachment: fixed;">

        <div class="relative w-full max-w-lg">
            <div
                class="bg-linear-to-br from-gray-900 to-gray-900/50 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                <div class="relative px-8 py-12 border-b border-gray-800">
                    <div class="relative z-10">
                        <div class="mb-4 inline-block">
                            <span class="text-primary-light font-semibold tracking-widest uppercase text-xs">Gabung
                                Sekarang</span>
                        </div>
                        <h1 class="text-3xl font-black text-white mb-2 tracking-tight">Buat Akun</h1>
                        <p class="text-gray-300 text-sm">
                            Mulai perjalanan sewa kendaraan terbaik Anda dengan EASYRENT</p>
                    </div>
                </div>

                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border-l-4 border-red-500 text-red-400 rounded">
                            <p class="font-semibold">Validation Errors:</p>
                            <ul class="text-sm mt-2 list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        <div>
                            <label for="username" class="block text-sm font-semibold text-gray-300 mb-3">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200"
                                placeholder="Choose your username">
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-300 mb-3">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200"
                                placeholder="Your full name">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-3">Email
                                Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200"
                                placeholder="your@email.com">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-300 mb-3">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200"
                                placeholder="Create a strong password">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-300 mb-3">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-3 bg-gray-800/50 border-2 border-gray-700 text-white rounded-lg focus:outline-none focus:border-primary-main focus:bg-gray-800 transition duration-200"
                                placeholder="Confirm your password">
                        </div>

                        <!-- Premium submit button -->
                        <button type="submit"
                            class="w-full mt-8 bg-linear-to-r from-primary-main to-primary-light text-white font-bold py-3 rounded-lg hover:shadow-2xl hover:shadow-primary-main/30 transform hover:translate-y-1 transition duration-300">
                            Sign Up
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-800"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-linear-to-br from-gray-900 to-gray-900/50 text-gray-400">Already have an
                                account?</span>
                        </div>
                    </div>

                    <!-- Login link -->
                    <div class="mt-6">
                        <a href="/login"
                            class="block w-full text-center py-3 border-2 border-primary-main text-primary-light font-semibold rounded-lg hover:bg-primary-main/10 hover:text-primary-main transition duration-200">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
