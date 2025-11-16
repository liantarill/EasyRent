<nav id="nav" class="fixed top-0 right-0 left-0 z-50 transition-all duration-150 ease-linear">
    <div class="flex justify-between items-center px-6 md:px-16 py-5">
        <a href="/"
            class="text-white font-black text-2xl tracking-widest hover:text-primary-light transition-colors duration-300">
            EASY<span class="text-primary-main">RENT</span>
        </a>

        @auth
            <div class="hidden md:flex items-center space-x-1">
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Dashboard</a>
                    <a href="{{ route('admin.rents.index') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Rents</a>
                    <a href="{{ route('admin.vehicles.index') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Vehicles</a>
                @else
                    <a href="{{ route('customer.dashboard') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Dashboard</a>
                    <a href="{{ route('customer.vehicles.index') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Vehicles</a>
                    <a href="{{ route('customer.rents.index') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Transactions</a>
                    <a href="{{ route('customer.profile') }}"
                        class="px-4 py-2 text-gray-300 hover:text-white transition-colors duration-300 font-medium">Profile</a>
                @endif
            </div>
        @endauth

        <div class="hidden md:flex items-center space-x-4">
            @auth
                <span class="text-gray-400 text-sm">{{ Auth::user()->name }}</span>
                <div class="w-px h-6 bg-primary-main/20"></div>
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button
                        class="px-4 py-2 text-gray-300 hover:text-primary-light transition-colors duration-300 font-medium text-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-5 py-2 text-gray-300 hover:text-primary-light transition-colors duration-300 font-medium text-sm">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-6 py-2.5 font-semibold bg-primary-main text-white rounded-lg hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-primary-main/40 text-sm uppercase tracking-wide">
                    Register
                </a>
            @endauth
        </div>

        <button id="mobileMenuBtn"
            class="md:hidden text-white text-2xl hover:text-primary-light transition-colors duration-300">
            {{-- ☰ --}}
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <div id="mobileMenu"
        class="md:hidden max-h-0 transform origin-top scale-y-0 opacity-0 pointer-events-none transition-all duration-300 ease-out">
        <div class="px-6 py-6 space-y-4">

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Dashboard</a>
                    <a href="{{ route('admin.rents.index') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Rents</a>
                    <a href="{{ route('admin.vehicles.index') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Vehicles</a>
                @else
                    <a href="{{ route('customer.dashboard') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Dashboard</a>
                    <a href="{{ route('customer.vehicles.index') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Vehicles</a>
                    <a href="{{ route('customer.rents.index') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Transactions</a>
                    <a href="{{ route('customer.profile') }}"
                        class="block py-3 text-gray-300 hover:text-primary-light transition-colors duration-200 font-medium border-b border-white/5">Profile</a>
                @endif

                <div class="pt-4 mt-2 border-t border-primary-main/20">
                    <span class="block text-gray-400 text-sm mb-4">{{ Auth::user()->name }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button
                            class="w-full py-3 bg-primary-main hover:bg-primary-dark text-white rounded-lg transition-all duration-300 font-semibold uppercase tracking-wide text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="/login"
                    class="block w-full py-3 bg-white/10 hover:bg-white/20 text-white rounded-lg text-center transition-all duration-300 font-medium uppercase tracking-wide text-sm border border-white/10">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full py-3 bg-primary-main hover:bg-primary-dark text-white rounded-lg text-center transition-all duration-300 font-semibold uppercase tracking-wide text-sm">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<script>
    const btn = document.getElementById('mobileMenuBtn');
    const menu = document.getElementById('mobileMenu');

    btn.addEventListener('click', () => {
        const isOpen = menu.classList.contains('scale-y-100');

        if (isOpen) {
            // Tutup menu
            menu.classList.remove('scale-y-100', 'opacity-100', 'pointer-events-auto', 'max-h-[500px]');
            menu.classList.add('scale-y-0', 'opacity-0', 'pointer-events-none', 'max-h-0');
        } else {
            // Buka menu
            menu.classList.remove('scale-y-0', 'opacity-0', 'pointer-events-none', 'max-h-0');
            menu.classList.add('scale-y-100', 'opacity-100', 'pointer-events-auto', 'max-h-[500px]');
        }
    });

    const nav = document.getElementById('nav');

    function handleNav() {
        if (window.innerWidth >= 768) {
            if (window.scrollY < 150) {
                nav.classList.remove('bg-black/80', 'backdrop-blur-lg', 'border-b', 'border-primary-main/10');
            } else {
                nav.classList.add('bg-black/80', 'backdrop-blur-lg', 'border-b', 'border-primary-main/10');
            }
        } else {
            nav.classList.add('bg-black/80', 'backdrop-blur-lg', 'border-b', 'border-primary-main/10');
        }
    }

    // Jalankan saat scroll
    window.addEventListener('scroll', handleNav);

    // Jalankan saat resize
    window.addEventListener('resize', handleNav);

    // Jalankan sekali saat page load
    handleNav();
</script>
