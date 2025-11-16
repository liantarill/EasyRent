{{-- Sidebar component --}}
<div class="flex">

    {{-- Sidebar --}}
    <aside id="sidebar"
        class="z-20 hidden md:flex md:flex-col w-64 min-h-screen bg-primary-main text-white transition-all"
        aria-label="Sidebar">
        {{-- Brand --}}
        <div class="flex items-center justify-between px-4 py-4 border-b border-primary-dark">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-md bg-primary-accent flex items-center justify-center font-bold">A</div>
                <span class="font-semibold text-lg">{{ $title ?? config('app.name', 'MyApp') }}</span>
            </a>

            {{-- Collapse button (desktop) --}}
            <button id="sidebarCollapseBtn"
                class="hidden lg:inline-flex items-center p-1 rounded hover:bg-primary-accent/20"
                aria-label="Collapse sidebar"
                onclick="document.getElementById('sidebar').classList.toggle('collapsed')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </button>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-2 py-4 overflow-y-auto">
            @php
                $isActive = function ($pattern) {
                    return request()->is($pattern) ? 'bg-primary-dark/40' : 'hover:bg-primary-dark/25';
                };
            @endphp

            <a href="{{ route('admin.dashboard') ?? url('/') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/dashboard*') }}">
                <span class="truncate">Dashboard</span>
            </a>

            <a href="{{ route('admin.vehicles.index') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/vehicles*') }}">
                <span class="truncate">Vehicles</span>
            </a>

            <a href="{{ route('admin.rents.index') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/rents*') }}">
                <span class="truncate">Rents</span>
            </a>

            <a href=""
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('reports*') }}">
                <span class="truncate">Reports</span>
            </a>

            <div class="mt-4 pt-3 border-t border-primary-dark/40"></div>

            <a href=""
                class="group flex items-center gap-3 px-3 py-2 rounded-md mt-3 {{ $isActive('settings*') }}">
                <span class="truncate">Settings</span>
            </a>
        </nav>

        {{-- Bottom: user --}}
        <div class="px-4 py-4 border-t border-primary-dark/40">
            @auth
                <div class="flex items-center gap-3">
                    <div
                        class="h-10 w-10 rounded-full bg-primary-pale text-primary-main flex items-center justify-center font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-primary-pale/80">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-md bg-primary-dark hover:bg-primary-accent">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-md bg-primary-dark hover:bg-primary-accent text-center">
                    Login
                </a>
            @endauth
        </div>
    </aside>

    {{-- Main area (includes mobile topbar) --}}
    <div class="flex-1 min-h-screen flex flex-col">

        {{-- Mobile topbar --}}
        <header class="w-full md:hidden flex items-center justify-between bg-primary-main text-white px-4 py-3">
            <div class="flex items-center gap-3">
                <button id="mobileOpenBtn" aria-label="Open sidebar"
                    onclick="document.getElementById('mobileSidebar').classList.remove('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ url('/') }}" class="font-semibold">{{ $title ?? config('app.name', 'MyApp') }}</a>
            </div>

            <div>
                @auth
                    <a href="#" class="text-sm">{{ Auth::user()->name }}</a>
                @endauth
            </div>
        </header>

        {{-- Mobile off-canvas sidebar --}}
        <div id="mobileSidebar" class="md:hidden fixed inset-0 z-30 hidden">
            {{-- backdrop --}}
            <div class="absolute inset-0 bg-black/40"
                onclick="document.getElementById('mobileSidebar').classList.add('hidden')"></div>

            {{-- panel --}}
            <aside class="relative w-72 h-full bg-primary-main text-white p-4">
                <div class="flex items-center justify-between mb-4">
                    <a href="{{ url('/') }}"
                        class="font-semibold">{{ $title ?? config('app.name', 'MyApp') }}</a>
                    <button onclick="document.getElementById('mobileSidebar').classList.add('hidden')">
                        ✕
                    </button>
                </div>

                {{-- mobile nav (reuse same links) --}}
                <nav class="space-y-1">
                    <a href="{{ route('admin.dashboard') ?? url('/') }}"
                        class="block px-3 py-2 rounded {{ $isActive('admin/dashboard*') }}">Dashboard</a>
                    <a href="{{ route('admin.vehicles.index') }}"
                        class="block px-3 py-2 rounded {{ $isActive('admin/vehicles*') }}">Vehicles</a>
                    <a href="{{ route('admin.rents.index') }}"
                        class="block px-3 py-2 rounded {{ $isActive('admin/rents*') }}">Rents</a>
                    <a href="" class="block px-3 py-2 rounded {{ $isActive('reports*') }}">Reports</a>
                    <a href="" class="block px-3 py-2 rounded {{ $isActive('settings*') }}">Settings</a>
                </nav>

                <div class="mt-6">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full px-3 py-2 rounded bg-primary-dark hover:bg-primary-accent">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="block w-full px-3 py-2 rounded bg-primary-dark hover:bg-primary-accent text-center">Login</a>
                    @endauth
                </div>
            </aside>
        </div>

        {{-- Content wrapper --}}
        <main class="p-6">
            {{-- slot / content --}}
            {{ $slot ?? ($content ?? '') }}
        </main>
    </div>
</div>
