<nav class="bg-primary-main text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <div class="flex items-center">
                <a href="/" class="text-xl font-bold">
                    {{ $title ?? 'EasyRent' }}
                </a>
            </div>

            <div class="hidden md:flex space-x-6">
                <a href="/" class="hover:text-primary-light">Home</a>
                <a href="/rents" class="hover:text-primary-light">Rents</a>
                <a href="/vehicles" class="hover:text-primary-light">Vehicles</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <span class="text-primary-pale">Hi, {{ Auth::user()->name }}</span>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="px-3 py-1 bg-primary-dark hover:bg-primary-accent text-white rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="/login" class="px-3 py-1 bg-primary-dark hover:bg-primary-accent text-white rounded">
                        Login
                    </a>
                @endauth
            </div>
            <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')"
                class="md:hidden text-3xl text-primary-pale">
                ☰
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="md:hidden hidden bg-primary-main border-t border-primary-dark">
        <div class="px-4 py-3 space-y-2">
            <a href="/" class="block py-2 text-primary-pale hover:text-white">Home</a>
            <a href="/rents" class="block py-2 text-primary-pale hover:text-white">Rents</a>
            <a href="/vehicles" class="block py-2 text-primary-pale hover:text-white">Vehicles</a>

            @auth
                <div class="pt-3 border-t border-primary-dark">
                    <span class="block text-primary-pale mb-2">Hi, {{ Auth::user()->name }}</span>
                    <form method="POST" action="/logout">
                        @csrf
                        <button class="w-full py-2 bg-primary-dark hover:bg-primary-accent text-white rounded">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="/login"
                    class="block w-full py-2 bg-primary-dark hover:bg-primary-accent rounded text-center text-white">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
