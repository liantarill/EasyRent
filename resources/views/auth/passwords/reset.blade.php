@extends('layouts.app')

@section('content')
    <div class="relative w-full min-h-screen bg-white flex overflow-hidden">
        <!-- Left Panel - Branding & Visual Content -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden items-center justify-center">
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-primary-main/20 rounded-full blur-3xl opacity-50 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-primary-light/10 rounded-full blur-3xl opacity-50 pointer-events-none">
            </div>

            <!-- Background image overlay -->
            <div class="absolute inset-0 opacity-30"
                style="background-image: url('/images/hero2-temp.jpg'); background-size: cover; background-position: center;">
            </div>

            <div class="relative z-10 text-center px-8">
                <a href="/"
                    class="text-white font-black text-3xl tracking-widest hover:text-primary-light transition-colors duration-300">
                    EASY<span class="text-primary-light">RENT</span>
                </a>

                <h2 class="text-5xl font-black text-white mb-6 leading-tight tracking-tight mt-6">
                    Aman &amp; Terpercaya
                </h2>

                <p class="text-lg text-gray-300 mb-12 max-w-sm leading-relaxed font-light">
                    Pilih password baru yang kuat untuk mengamankan akun Anda dan lanjutkan menikmati layanan kami.
                </p>

                <div class="flex justify-center gap-2">
                    <div class="h-1 w-8 bg-primary-light rounded-full"></div>
                    <div class="h-1 w-4 bg-gray-600 rounded-full"></div>
                    <div class="h-1 w-4 bg-gray-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Right Panel - New Password Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 md:p-12">
            <div class="w-full max-w-md">
                <!-- Header -->
                <div class="mb-10">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-2 h-2 bg-primary-main rounded-full"></div>
                        <span class="text-primary-main font-semibold tracking-widest uppercase text-xs">Reset
                            Password</span>
                    </div>
                    <h1 class="text-4xl font-black text-gray-900 mb-3">Buat Password Baru</h1>
                    <p class="text-gray-600 text-base">Pilih password yang kuat dan aman untuk akun Anda</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="text-sm font-semibold text-red-800 mb-2">Terjadi kesalahan</p>
                        <ul class="space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-700 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div
                    class="bg-white/80 dark:bg-gray-900/60 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
                    <div class="px-6 py-6 md:px-8 md:py-8">
                        <form method="POST" action="{{ route('reset-password.updatePassword') }}" class="space-y-5">
                            @csrf
                            @method('POST')

                            <!-- New Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <div class="mt-2 relative">
                                    <input type="password" name="password" id="password" required
                                        class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 text-gray-900 rounded-xl focus:outline-none focus:border-primary-main focus:ring-1 focus:ring-primary-main/20 transition duration-150 @error('password') border-red-500 bg-red-50 @enderror"
                                        placeholder="••••••••" autocomplete="new-password">
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Minimal 8 karakter dengan huruf besar, huruf kecil,
                                    dan angka</p>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="mt-2 w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 text-gray-900 rounded-xl focus:outline-none focus:border-primary-main focus:ring-1 focus:ring-primary-main/20 transition duration-150"
                                    placeholder="••••••••" autocomplete="new-password">
                            </div>

                            <!-- Strength Indicator (visual parity with previous) -->
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold text-gray-600">Tingkat Keamanan:</span>
                                    <div class="flex gap-1 flex-1">
                                        <div id="strength-1" class="h-1 flex-1 bg-red-300 rounded-full"></div>
                                        <div id="strength-2" class="h-1 flex-1 bg-gray-200 rounded-full"></div>
                                        <div id="strength-3" class="h-1 flex-1 bg-gray-200 rounded-full"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full mt-4 bg-gradient-to-r from-primary-main to-primary-dark text-white font-bold py-3 rounded-xl hover:shadow-lg hover:shadow-primary-main/30 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                Perbarui Password
                            </button>
                        </form>

                        <!-- Security Tips -->
                        <div class="mt-6 p-4 bg-primary-accent/10 rounded-xl border border-primary-main/20">
                            <div class="flex gap-3 items-start">
                                <svg class="w-5 h-5 text-primary-main flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 8a6 6 0 06-6-6H4a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="text-xs text-gray-600">
                                    <p class="font-semibold text-gray-900 mb-1">Tips Keamanan:</p>
                                    <ul class="space-y-0.5">
                                        <li>✓ Gunakan kombinasi huruf, angka, dan simbol</li>
                                        <li>✓ Hindari informasi pribadi yang mudah ditebak</li>
                                        <li>✓ Jangan gunakan password yang sama di situs lain</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
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

    @push('scripts')
        <script>
            // Simple password strength visual (lightweight, mirrors visual style)
            const pwd = document.getElementById('password');
            const s1 = document.getElementById('strength-1');
            const s2 = document.getElementById('strength-2');
            const s3 = document.getElementById('strength-3');

            function updateStrength(val) {
                const score = (val.length >= 8) + (/[A-Z]/.test(val)) + (/[0-9]/.test(val)) + (/[^A-Za-z0-9]/.test(val));
                // reset
                s1.className = 'h-1 flex-1 rounded-full';
                s2.className = 'h-1 flex-1 rounded-full';
                s3.className = 'h-1 flex-1 rounded-full';
                if (score <= 1) {
                    s1.classList.add('bg-red-300');
                    s2.classList.add('bg-gray-200');
                    s3.classList.add('bg-gray-200');
                } else if (score === 2 || score === 3) {
                    s1.classList.add('bg-yellow-300');
                    s2.classList.add('bg-yellow-300');
                    s3.classList.add('bg-gray-200');
                } else {
                    s1.classList.add('bg-green-400');
                    s2.classList.add('bg-green-400');
                    s3.classList.add('bg-green-400');
                }
            }

            if (pwd) {
                pwd.addEventListener('input', (e) => updateStrength(e.target.value));
                updateStrength(pwd.value || '');
            }
        </script>
    @endpush
@endsection
