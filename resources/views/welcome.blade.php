@extends('layouts.app')

@section('content')
    <div class="halo min-h-screen  ">

        @include('layouts.partials.navbar')

        <section class="relative w-full h-screen bg-cover bg-center overflow-hidden flex items-center justify-center"
            style="background-image: linear-gradient(135deg, rgba(10,10,15,0.55) 0%, rgba(234,88,12,0.15) 100%), url('/images/hero2-temp.jpg'); background-attachment: fixed;">

            <div class="absolute inset-0 bg-linear-to-r from-gray-950 via-transparent to-gray-950 opacity-40"></div>

            <div class="relative z-10 flex items-center justify-start h-full max-w-7xl w-full mx-auto px-6 md:px-12">
                <div class="max-w-3xl">
                    <div class="mb-6 inline-block">
                        <span class="text-primary-light font-semibold tracking-widest uppercase text-sm">Layanan Kendaraan
                            Terpercaya</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-black leading-tight mb-6 text-white tracking-tighter">
                        Mobilitas<br>Tanpa Batas
                    </h1>
                    <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-2xl leading-relaxed font-light">
                        Nikmati pilihan kendaraan yang dirancang untuk memenuhi setiap kebutuhan perjalanan Anda. Hadirkan
                        kenyamanan dan pengalaman perjalanan yang lebih berkualitas.
                    </p>
                    <a href="#"
                        class="inline-block px-8 py-4 bg-primary-main hover:bg-primary-dark text-white font-bold rounded-lg transition-all duration-300 shadow-2xl hover:shadow-primary-main/40 hover:shadow-2xl transform hover:translate-y-1">
                        Lihat Armada
                    </a>
                </div>
            </div>

            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
                <div class="flex flex-col items-center gap-2">
                    <span class="text-gray-400 text-xs uppercase tracking-widest font-semibold">Scroll</span>
                    <div class="w-0.5 h-6 bg-linear-to-b from-primary-light to-transparent animate-pulse"></div>
                </div>
            </div>
        </section>

        <section class="py-20 md:py-32 bg-gray-50 border-t border-gray-200">
            <div class="max-w-6xl mx-auto px-6 md:px-12">
                <div class="mb-20">
                    <span class="text-primary-main font-semibold tracking-widest uppercase text-sm">Komitmen Kami</span>
                    <h2 class="text-5xl md:text-6xl font-black text-gray-900 mt-4 mb-2 tracking-tight">
                        Pelayanan Terbaik dalam Setiap Detail
                    </h2>
                    <div class="w-24 h-1 bg-linear-to-r from-primary-main to-primary-light mt-6"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="group p-8 rounded-2xl bg-white border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/10">
                        <div
                            class="w-14 h-14 bg-linear-to-br from-primary-main to-primary-light rounded-xl mb-6 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-crown text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-main transition-colors">
                            Armada Premium</h3>
                        <p class="text-gray-600 leading-relaxed font-light">
                            Kendaraan pilihan yang dirawat dengan standar tinggi, memberikan pengalaman berkendara yang
                            nyaman, aman, dan selalu bisa diandalkan.
                        </p>
                    </div>

                    <div
                        class="group p-8 rounded-2xl bg-white border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/10">
                        <div
                            class="w-14 h-14 bg-linear-to-br from-primary-main to-primary-light rounded-xl mb-6 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-shield-halved text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-main transition-colors">
                            Perlindungan Lengkap
                        </h3>
                        <p class="text-gray-600 leading-relaxed font-light">
                            Asuransi menyeluruh dan bantuan darurat 24/7 untuk rasa tenang sepanjang perjalanan—di mana pun
                            dan kapan pun.
                        </p>
                    </div>

                    <div
                        class="group p-8 rounded-2xl bg-white border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/10">
                        <div
                            class="w-14 h-14 bg-linear-to-br from-primary-main to-primary-light rounded-xl mb-6 flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-bolt text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-primary-main transition-colors">
                            Pemesanan Tanpa Ribet
                        </h3>
                        <p class="text-gray-600 leading-relaxed font-light">
                            Proses reservasi super mudah, syarat fleksibel, dan keuntungan ekstra untuk para member.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 md:py-32 bg-gray-50 border-t border-gray-200">
            <div class="max-w-6xl mx-auto px-6 md:px-12">
                <div class="mb-20">
                    <span class="text-primary-main font-semibold tracking-widest uppercase text-sm">Koleksi</span>
                    <h2 class="text-5xl md:text-6xl font-black text-gray-900 mt-4 mb-2 tracking-tight">
                        Armada Unggulan Kami
                    </h2>
                    <div class="w-24 h-1 bg-linear-to-r from-primary-main to-primary-light mt-6"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/20">
                        <div class="relative h-72 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="/images/sedan.jpg"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-8 relative z-10">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Elegan & Ringkas</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed font-light">
                                Teman perjalanan perkotaan yang stylish dan efisien, cocok buat kamu yang ingin tampil keren
                                tanpa ribet.
                            </p>
                            <a href="/vehicles"
                                class="inline-flex items-center text-primary-main font-semibold hover:text-primary-light transition-colors duration-300 group/link">
                                Explore <span
                                    class="ml-2 group-hover/link:translate-x-2 transition-transform duration-300">→</span>
                            </a>
                        </div>
                    </div>

                    <div
                        class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/20">
                        <div class="relative h-72 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="/images/motorcycle.jpg"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-8 relative z-10">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Gesit untuk Mobilitas Kota</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed font-light">
                                Motor lincah yang pas buat selap-selip dan keliling kota dengan cepat, praktis, dan tetap
                                gaya.
                            </p>
                            <a href="/vehicles"
                                class="inline-flex items-center text-primary-main font-semibold hover:text-primary-light transition-colors duration-300 group/link">
                                Explore <span
                                    class="ml-2 group-hover/link:translate-x-2 transition-transform duration-300">→</span>
                            </a>
                        </div>
                    </div>

                    <div
                        class="group relative bg-white rounded-2xl overflow-hidden border border-gray-200 hover:border-primary-main/50 transition-all duration-500 hover:shadow-xl hover:shadow-primary-main/20">
                        <div class="relative h-72 bg-gray-100 flex items-center justify-center overflow-hidden">
                            <img src="/images/suv.jpg"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-8 relative z-10">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nyaman & Lega</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed font-light">
                                Pilihan tepat untuk keluarga atau perjalanan jauh—ruang luas, nyaman, dan bikin perjalanan
                                tetap santai dari awal sampai akhir.
                            </p>
                            <a href="/vehicles"
                                class="inline-flex items-center text-primary-main font-semibold hover:text-primary-light transition-colors duration-300 group/link">
                                Explore <span
                                    class="ml-2 group-hover/link:translate-x-2 transition-transform duration-300">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="relative py-24 md:py-32 overflow-hidden">
            <div class="absolute inset-0 bg-linear-to-r from-primary-main via-primary-light to-primary-main"></div>
            <div class="absolute inset-0 bg-linear-to-b from-transparent via-primary-main/10 to-transparent"></div>

            <div class="relative z-10 max-w-4xl mx-auto px-6 md:px-12 text-center">
                <h2 class="text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">
                    Mulai Perjalanan Terbaik Anda
                </h2>
                <p class="text-lg md:text-xl text-white/95 mb-10 leading-relaxed max-w-2xl mx-auto font-light">
                    Dapatkan kendaraan ideal untuk setiap kebutuhan perjalanan. Booking sekarang dan akses berbagai manfaat
                    khusus anggota.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#"
                        class="inline-block px-10 py-4 bg-white text-primary-main font-bold rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-2xl hover:shadow-[0_20px_40px_rgba(255,255,255,0.2)] transform hover:scale-105">
                        Pesan Sekarang
                    </a>
                    <a href="#"
                        class="inline-block px-10 py-4 border-2 border-white text-white font-bold rounded-lg hover:bg-white/10 transition-all duration-300">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
