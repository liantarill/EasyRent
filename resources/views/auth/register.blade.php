@extends('layouts.app')

@push('styles')
    <style>
        body::before {
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)),
                url("{{ asset('images/bg.jpg') }}");
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <!-- Decorative background -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 right-10 w-40 h-40 bg-primary-light opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-40 h-40 bg-primary-light opacity-10 rounded-full blur-3xl"></div>
        </div>

        <!-- Main container -->
        <div class="relative w-full max-w-3xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-primary-main to-primary-light px-8 py-12">
                    <h1 class="text-3xl font-bold text-white mb-2">Buat Akun Baru</h1>
                    <p class="text-primary-pale text-sm">Daftar untuk mulai menggunakan EasyRent</p>
                </div>

                <!-- Form -->
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded">
                            <p class="font-semibold">Terjadi kesalahan:</p>
                            <ul class="text-sm mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-5">
                        @csrf

                        <!-- Username -->
                        <div>
                            <label for="username"
                                class="block text-sm font-semibold text-primary-dark mb-2">Username</label>
                            <input type="text" id="username" name="username" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200"
                                placeholder="Masukkan username">
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-primary-dark mb-2">Nama
                                Lengkap</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200"
                                placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-primary-dark mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200"
                                placeholder="Masukkan email aktif">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-sm font-semibold text-primary-dark mb-2">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200"
                                placeholder="Masukkan password">
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-primary-dark mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-main transition duration-200"
                                placeholder="Ulangi password">
                        </div>


                        <!-- Submit button -->
                        <button type="submit"
                            class="w-full mt-8 bg-gradient-to-r from-primary-main to-primary-light text-white font-semibold py-3 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200">
                            Daftar
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Sudah punya akun?</span>
                        </div>
                    </div>

                    <!-- Login link -->
                    <div class="mt-6">
                        <a href="{{ route('login') }}"
                            class="block w-full text-center py-3 border-2 border-primary-main text-primary-main font-semibold rounded-lg hover:bg-primary-pale transition duration-200">
                            Masuk Sekarang
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center text-xs text-gray-500">
                    <p>© 2025 EasyRent. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
