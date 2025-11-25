@php
    $isActive = function ($pattern) {
        return request()->is($pattern) ? 'bg-primary-dark/40' : 'hover:bg-primary-dark/25';
    };
@endphp

<style>
    #sidebar.collapsed {
        width: 72px !important;
    }

    #sidebar.collapsed .hide-when-collapsed {
        opacity: 0 !important;
        pointer-events: none !important;
    }

    #sidebar.collapsed #sidebarCollapseBtn {
        display: none !important;
    }

    #sidebar.collapsed #sidebarExpandBtn {
        display: block !important;
    }

    #sidebar.collapsed #brandText {
        display: none !important;
    }
</style>

<script>
    (function() {
        const COLLAPSED_KEY = 'sidebar_collapsed';
        const isCollapsed = localStorage.getItem(COLLAPSED_KEY) === '1';
        if (isCollapsed) {
            document.documentElement.classList.add('sidebar-is-collapsed');
        }
    })();
</script>

<div class="flex">
    <aside id="sidebar"
        class="z-20 hidden md:flex flex-col transition-all duration-200 ease-in-out bg-primary-main text-white
               w-64 min-h-screen overflow-visible shadow-lg relative
               sidebar-is-collapsed:!w-[72px]"
        aria-label="Sidebar">
        <div class="flex items-center justify-between px-4 py-4 border-b border-primary-dark">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div id="brandIcon"
                    class="h-9 w-9 rounded-md bg-primary-accent flex items-center justify-center font-bold text-primary-main transition-all">
                    <span class="brand-text">A</span>
                </div>
                <span id="brandText" class="font-semibold text-lg transition-opacity hide-when-collapsed">
                    {{ $title ?? config('app.name', 'MyApp') }}</span>
            </a>

            <button id="sidebarCollapseBtn"
                class="inline-flex items-center justify-center p-2 rounded hover:bg-primary-accent/20 focus:outline-none"
                aria-label="Toggle sidebar" aria-pressed="false" title="Collapse sidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <button id="sidebarExpandBtn"
            class="hidden absolute top-4 -right-5 z-30 bg-primary-accent text-primary-main 
            w-9 h-9 rounded-full items-center justify-center shadow-md  shadow-amber-500
           hover:bg-primary-accent/80 hover:text-primary-main focus:outline-none"
            aria-label="Expand sidebar" title="Expand sidebar">
            <i class="fa-solid fa-caret-right text-lg"></i>
        </button>


        <nav id="navList" class="flex-1 px-2 py-4 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/dashboard*') }}">
                <span class="w-6 flex items-center justify-center">
                    <i class="fas fa-home"></i>
                </span>
                <span class="link-text truncate hide-when-collapsed">Dashboard</span>
            </a>

            <a href="{{ route('admin.vehicles.index') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/vehicles*') }}">
                <span class="w-6 flex items-center justify-center">
                    <i class="fas fa-car"></i>
                </span>
                <span class="link-text truncate hide-when-collapsed">Vehicles</span>
            </a>

            <a href="{{ route('admin.rents.index') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/rents*') }}">
                <span class="w-6 flex items-center justify-center">
                    <i class="fas fa-file-contract"></i>
                </span>
                <span class="link-text truncate hide-when-collapsed">Rents</span>
            </a>

            <a href="{{ route('admin.users.index') ?? url('/') }}"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mb-1 {{ $isActive('admin/users*') }}">
                <span class="w-6 flex items-center justify-center">
                    <i class="fas fa-users"></i>
                </span>
                <span class="link-text truncate hide-when-collapsed">Users</span>
            </a>

            <div class="mt-4 pt-3 border-t border-primary-dark/40"></div>

            <a href="#"
                class="group flex items-center gap-3 px-3 py-2 rounded-md mt-3 {{ $isActive('settings*') }}">
                <span class="w-6 flex items-center justify-center">
                    <i class="fas fa-cog"></i>
                </span>
                <span class="link-text truncate hide-when-collapsed">Settings</span>
            </a>
        </nav>

        <div id="sidebarBottom" class="px-4 py-4 border-t border-primary-dark/40">
            @auth
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="h-10 w-10 rounded-full bg-primary-pale text-primary-main flex items-center justify-center font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 hide-when-collapsed">
                        <div id="userNameText" class="text-sm font-medium">{{ Auth::user()->name }}</div>
                        <div id="userEmailText" class="text-xs text-primary-pale/80">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button id="logoutBtn"
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-md bg-primary-dark hover:bg-primary-accent transition-colors">
                        <span id="logoutIcon" class="w-6 flex items-center justify-center">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span id="logoutText" class="truncate hide-when-collapsed">Logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-md bg-primary-dark hover:bg-primary-accent text-center">Login</a>
            @endauth
        </div>
    </aside>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const brandtext = document.getElementById('brandText');
    const collapseBtn = document.getElementById('sidebarCollapseBtn');
    const expandBtn = document.getElementById('sidebarExpandBtn');
    const COLLAPSED_KEY = 'sidebar_collapsed';

    function setCollapsed(collapsed) {
        if (collapsed) {
            sidebar.classList.add('collapsed');
            document.documentElement.classList.add('sidebar-is-collapsed');
        } else {
            sidebar.classList.remove('collapsed');
            document.documentElement.classList.remove('sidebar-is-collapsed');
        }

        collapseBtn.setAttribute('aria-pressed', collapsed ? 'true' : 'false');
        brandtext.setAttribute('aria-pressed', collapsed ? 'true' : 'false');
        expandBtn.setAttribute('aria-pressed', collapsed ? 'true' : 'false');
        localStorage.setItem(COLLAPSED_KEY, collapsed ? '1' : '0');
    }

    // Apply state immediately on load
    const isCollapsed = localStorage.getItem(COLLAPSED_KEY) === '1';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
    }

    collapseBtn.addEventListener('click', () => {
        setCollapsed(!sidebar.classList.contains('collapsed'));
    });

    expandBtn.addEventListener('click', () => {
        setCollapsed(false);
    });
</script>
