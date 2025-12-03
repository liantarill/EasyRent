@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-bg">
        @include('layouts.partials.navbar')

        <div class="max-w-6xl mx-auto px-6 lg:px-10 pt-28 pb-14 space-y-10">
            <!-- Hero Section -->
            <section
                class="bg-linear-to-r from-[#e9f9f4] via-[#f5fbff] to-[#f0f9ff] rounded-3xl p-8 lg:p-10 shadow-[0_20px_50px_rgba(0,0,0,0.04)] border border-white/70">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div class="space-y-3 max-w-3xl">
                        <p class="text-sm font-semibold tracking-wide text-[#00b894] uppercase">Pengaturan Akun</p>
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 leading-tight">Profil Saya</h1>
                        <p class="text-gray-600">Kelola informasi pribadi dan dokumen Anda untuk proses penyewaan yang
                            lebih mudah.</p>
                    </div>
                    <div class="bg-white rounded-2xl px-5 py-4 shadow-sm border border-gray-100">
                        <div class="text-sm text-gray-500">Status Profil</div>
                        <div class="text-lg font-semibold text-gray-900">
                            {{ $isProfileComplete ? 'Lengkap' : 'Belum Lengkap' }}</div>
                        <div class="mt-1 inline-flex items-center gap-2 text-sm font-semibold"
                            style="color: {{ $isProfileComplete ? '#00b894' : '#f59e0b' }}">
                            <span class="w-2 h-2 rounded-full"
                                style="background: {{ $isProfileComplete ? '#00b894' : '#f59e0b' }}"></span>
                            {{ $isProfileComplete ? 'Terverifikasi' : 'Perlu Dilengkapi' }}
                        </div>
                    </div>
                </div>
            </section>

            <!-- Alert Messages -->
            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 rounded-2xl p-5 flex items-start gap-3 shadow-sm animate-fadeIn">
                    <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-semibold text-green-900 mb-1">Berhasil!</p>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="bg-red-50 border border-red-200 rounded-2xl p-5 flex items-start gap-3 shadow-sm animate-fadeIn">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl mt-0.5"></i>
                    <div class="flex-1">
                        <p class="font-semibold text-red-900 mb-2">Terjadi Kesalahan:</p>
                        <ul class="space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start gap-2">
                                    <span class="text-red-400 mt-1">•</span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <!-- Profile Completion Status -->
            @if (!$isProfileComplete)
                <div
                    class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 shadow-sm flex items-start gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 mb-2">Profil Belum Lengkap</h3>
                        <p class="text-gray-600 text-sm mb-3">Lengkapi data berikut untuk dapat melakukan penyewaan:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($missingFields as $field)
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white rounded-lg text-sm font-medium text-gray-700 border border-yellow-200">
                                    <i class="fas fa-circle text-yellow-500 text-xs"></i>
                                    {{ $field }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Overview Card -->
            <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="bg-linear-to-r from-[#00b894]/5 to-[#3b82f6]/5 p-6 lg:p-8">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="relative group">
                            <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile/profile.png')) }}"
                                alt="Foto profil"
                                class="w-24 h-24 lg:w-28 lg:h-28 rounded-full object-cover border-4 border-white shadow-lg group-hover:scale-105 transition-transform">
                            <div
                                class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#00b894] rounded-full border-4 border-white flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>
                        <div class="flex-1 text-center sm:text-left">
                            <h2 class="text-2xl font-extrabold text-gray-900 mb-1">{{ $user->name }}</h2>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-sm text-gray-600">
                                <span class="flex items-center justify-center sm:justify-start gap-2">
                                    <i class="fas fa-envelope text-[#00b894]"></i>
                                    {{ $user->email }}
                                </span>
                                <span class="flex items-center justify-center sm:justify-start gap-2">
                                    <i class="fas fa-phone text-[#00b894]"></i>
                                    {{ $user->phone_number ?? 'Belum diisi' }}
                                </span>
                            </div>
                            <div class="mt-3 flex flex-wrap justify-center sm:justify-start gap-2">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-white rounded-lg text-xs font-semibold text-gray-700 border border-gray-200">
                                    <i class="fas fa-user text-[#00b894]"></i>
                                    &#64;{{ $user->username }}
                                </span>
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-white rounded-lg text-xs font-semibold text-gray-700 border border-gray-200">
                                    <i class="fas fa-id-card text-[#3b82f6]"></i>
                                    Customer
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Personal Information Form -->
            <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#00b894]/10 flex items-center justify-center">
                            <i class="fas fa-user-edit text-[#00b894]"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Informasi Pribadi</h2>
                            <p class="text-sm text-gray-600">Perbarui data pribadi Anda</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('customer.profile.update') }}" method="POST" class="p-6 lg:p-8 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-at text-[#00b894] mr-1"></i>Username
                            </label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00b894] focus:border-transparent transition"
                                placeholder="username_anda">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-[#00b894] mr-1"></i>Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00b894] focus:border-transparent transition"
                                placeholder="Nama lengkap Anda">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-[#00b894] mr-1"></i>Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00b894] focus:border-transparent transition"
                                placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-[#00b894] mr-1"></i>Nomor Telepon
                            </label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00b894] focus:border-transparent transition"
                                placeholder="08xxxxxxxxxx">
                        </div>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-[#00b894] to-[#00a080] text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-[#00b894]/30 active:scale-95 transition-all duration-300">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>

            <!-- Documents Grid -->
            <div class="grid gap-4 sm:grid-cols-2">
                <!-- Profile Picture -->
                <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#3b82f6]/10 flex items-center justify-center">
                                <i class="fas fa-camera text-[#3b82f6]"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Foto Profil</h3>
                                <p class="text-sm text-gray-600">Unggah foto profil Anda</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 lg:p-8">
                        <div class="flex justify-center mb-6">
                            <div class="relative group">
                                <img src="{{ asset('storage/' . ($user->profile_picture ?? 'profile/profile.png')) }}"
                                    alt="Foto profil" id="profilePreview"
                                    class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow-md group-hover:border-[#3b82f6] transition-colors">
                                <div
                                    class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('customer.profile.picture') }}" method="POST"
                            enctype="multipart/form-data" id="profilePictureForm">
                            @csrf
                            <div class="space-y-4">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#3b82f6] transition-colors cursor-pointer"
                                    onclick="document.getElementById('profilePictureInput').click()">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-sm font-semibold text-gray-700 mb-1">Klik untuk memilih foto</p>
                                    <p class="text-xs text-gray-500">JPG, JPEG, PNG • Maksimal 2MB</p>
                                    <input type="file" id="profilePictureInput" name="profile_picture"
                                        accept="image/*" required class="hidden"
                                        onchange="previewImage(this, 'profilePreview')">
                                </div>
                                <button type="submit"
                                    class="w-full px-4 py-3 bg-[#3b82f6] text-white font-semibold rounded-xl hover:bg-[#2563eb] active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-upload"></i>
                                    Unggah Foto Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- ID Card Photo -->
                <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#10b981]/10 flex items-center justify-center">
                                <i class="fas fa-id-card text-[#10b981]"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Foto Identitas</h3>
                                <p class="text-sm text-gray-600">KTP/SIM untuk verifikasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 lg:p-8">
                        <div
                            class="mb-6 border-2 border-dashed border-gray-300 rounded-xl p-4 min-h-[180px] flex items-center justify-center bg-gray-50">
                            @if ($user->id_card_photo)
                                @if (str_ends_with($user->id_card_photo, '.enc'))
                                    <img src="{{ route('customer.profile.id_card.view') }}" alt="Foto identitas"
                                        id="idCardPreview" class="max-w-full max-h-48 rounded-lg shadow-sm">
                                @else
                                    <img src="{{ asset('storage/' . $user->id_card_photo) }}" alt="Foto identitas"
                                        id="idCardPreview" class="max-w-full max-h-48 rounded-lg shadow-sm">
                                @endif
                            @else
                                <div class="text-center" id="idCardPlaceholder">
                                    <i class="fas fa-id-card text-5xl text-gray-300 mb-3"></i>
                                    <p class="text-sm text-gray-500">Belum ada foto identitas</p>
                                </div>
                                <img id="idCardPreview" class="max-w-full max-h-48 rounded-lg shadow-sm hidden">
                            @endif
                        </div>
                        <form action="{{ route('customer.profile.id_card') }}" method="POST"
                            enctype="multipart/form-data" id="idCardForm">
                            @csrf
                            <div class="space-y-4">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#10b981] transition-colors cursor-pointer"
                                    onclick="document.getElementById('idCardInput').click()">
                                    <i class="fas fa-file-upload text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-sm font-semibold text-gray-700 mb-1">Klik untuk memilih identitas</p>
                                    <p class="text-xs text-gray-500">JPG, JPEG, PNG • Maksimal 4MB</p>
                                    <input type="file" id="idCardInput" name="id_card_photo" accept="image/*"
                                        required class="hidden" onchange="previewIdCard(this)">
                                </div>
                                <button type="submit"
                                    class="w-full px-4 py-3 bg-[#10b981] text-white font-semibold rounded-xl hover:bg-[#059669] active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-shield-alt"></i>
                                    Unggah Foto Identitas
                                </button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>

            <!-- Password Change Section -->
            <section class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#f59e0b]/10 flex items-center justify-center">
                            <i class="fas fa-lock text-[#f59e0b]"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Keamanan Akun</h2>
                            <p class="text-sm text-gray-600">Ubah password untuk keamanan akun</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 lg:p-8">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                        <i class="fas fa-info-circle text-yellow-600 mt-0.5"></i>
                        <p class="text-sm text-yellow-800">Pastikan password baru Anda kuat dan unik. Minimal 8
                            karakter dengan kombinasi huruf dan angka.</p>
                    </div>
                    <button type="button" onclick="alert('Fitur ubah password akan segera tersedia!')"
                        class="inline-flex items-center gap-2 px-6 py-3 border-2 border-[#f59e0b] text-[#f59e0b] font-semibold rounded-xl hover:bg-[#f59e0b] hover:text-white active:scale-95 transition-all duration-300">
                        <i class="fas fa-key"></i>
                        Ubah Password
                    </button>
                </div>
            </section>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function previewIdCard(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const preview = document.getElementById('idCardPreview');
                const placeholder = document.getElementById('idCardPlaceholder');

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Auto-hide success messages after 5 seconds
        setTimeout(() => {
            const successAlert = document.querySelector('.animate-fadeIn');
            if (successAlert) {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s';
                setTimeout(() => successAlert.remove(), 500);
            }
        }, 5000);
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
@endsection
