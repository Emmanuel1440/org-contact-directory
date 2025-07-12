<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: false, darkMode: true }"
      x-init="darkMode = localStorage.getItem('theme') === 'dark'"
      x-bind:class="{ 'dark': darkMode }">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.head')
    @livewireStyles
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white dark:bg-zinc-800 text-white min-h-screen flex">

    <!-- Mobile Toggle Button -->
    <div class="lg:hidden fixed top-4 left-4 z-50">
        <button @click="sidebarOpen = !sidebarOpen"
                class="p-2 rounded bg-zinc-800 text-white hover:bg-zinc-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path :class="{ 'hidden': sidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{ 'hidden': !sidebarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-zinc-900 border-r border-zinc-700 fixed z-40 transform lg:translate-x-0 transition-transform duration-200 ease-in-out"
           :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
        <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-700">
            <div class="text-xl font-extrabold">OCM System</div>
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                    class="text-white hover:text-yellow-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 3v1m0 16v1m8.66-11.34l-.71.71M4.05 19.95l-.71.71M21 12h-1M4 12H3m16.66 4.66l-.71-.71M4.05 4.05l-.71-.71M12 5a7 7 0 000 14 7 7 0 000-14z"/>
                </svg>
            </button>
        </div>

        <nav class="mt-4 px-4 space-y-2 text-sm">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 px-4 py-2 rounded hover:bg-zinc-800 hover:text-blue-400 {{ request()->routeIs('dashboard') ? 'bg-zinc-800 font-bold text-blue-400' : '' }}">
                <i data-lucide="home" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="{{ route('organizations.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded hover:bg-zinc-800 hover:text-blue-400 {{ request()->routeIs('organizations.*') ? 'bg-zinc-800 font-bold text-blue-400' : '' }}">
                <i data-lucide="buildings" class="w-4 h-4"></i> Organizations
            </a>
            <a href="{{ route('contacts.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded hover:bg-zinc-800 hover:text-blue-400 {{ request()->routeIs('contacts.*') ? 'bg-zinc-800 font-bold text-blue-400' : '' }}">
                <i data-lucide="user" class="w-4 h-4"></i> Contacts
            </a>
            <a href="{{ route('industries.index') }}"
               class="flex items-center gap-2 px-4 py-2 rounded hover:bg-zinc-800 hover:text-blue-400 {{ request()->routeIs('industries.*') ? 'bg-zinc-800 font-bold text-blue-400' : '' }}">
                <i data-lucide="tag" class="w-4 h-4"></i> Industries
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-zinc-700 text-sm">
            @auth
                <div class="mb-3 text-zinc-400">
                    👤 {{ auth()->user()->name }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 rounded bg-red-600 hover:bg-red-700 text-white">
                        🚪 Log Out
                    </button>
                </form>
            @endauth
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 ml-0 lg:ml-64 transition-all duration-200">
        {{ $slot }}
    </main>

    @livewireScripts
    @fluxScripts

    <!-- Lucide Icons -->
    <script type="module">
        import lucide from 'https://unpkg.com/lucide@latest/dist/esm/lucide.js';
        lucide.createIcons();
    </script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
