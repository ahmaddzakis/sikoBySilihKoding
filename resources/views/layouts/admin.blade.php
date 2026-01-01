<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Settingan warna tema khusus admin, biar serasi sama bagian user -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0ea5e9', 
                        background: '#1a161f',
                        surface: '#26212c',
                        surfaceHover: '#2f2936',
                        border: '#3a3442',
                        textMain: '#ededed',
                        textMuted: '#a1a1aa',
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>

<body class="bg-[#1a161f] text-gray-200 min-h-screen font-sans selection:bg-pink-500 selection:text-white" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Overlay untuk mobile saat sidebar terbuka -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-black/50 z-40 md:hidden"
             x-cloak>
        </div>

        <!-- sidebar kiri buat menu-menu admin -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#26212c] border-r border-[#3a3442] p-6 flex flex-col gap-8 transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-auto"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <span class="text-xl font-bold bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">Admin</span>
                </div>
                <!-- Tombol close sidebar di mobile -->
                <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            
            <nav class="flex flex-col gap-2">
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-pink-500/10 text-pink-500 border border-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('dashboard.events.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard.events.*') ? 'bg-pink-500/10 text-pink-500 border border-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span class="font-medium">Manajemen Event</span>
                </a>

                <a href="{{ route('dashboard.users.index') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard.users.*') ? 'bg-pink-500/10 text-pink-500 border border-pink-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-users"></i>
                    <span class="font-medium">Manajemen Pengguna</span>
                </a>

                <a href="{{ route('profile') }}" 
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                    <i class="fa-regular fa-user"></i>
                    <span class="font-medium">Profil Saya</span>
                </a>
            </nav>

            <div class="mt-auto pt-6 border-t border-[#3a3442]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:text-red-300 hover:bg-red-400/5 transition-all w-full">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- konten utama -->
        <main class="flex-1 overflow-y-auto">
            <!-- header atas admin -->
            <header class="h-20 border-b border-[#3a3442] px-8 flex items-center justify-between bg-[#1a161f]/50 backdrop-blur-md sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <!-- Tombol hamburger untuk mobile -->
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-400 hover:text-white mr-2">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <h1 class="text-xl font-bold text-white tracking-tight">@yield('title', 'Dashboard Admin')</h1>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- info admin yang lagi login -->
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-bold text-white">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-widest">{{ Auth::user()->role }}</div>
                    </div>
                    <!-- foto profil admin -->
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-purple-600 border border-[#3a3442] overflow-hidden flex items-center justify-center">
                        @if(Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
            </header>

            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl flex items-center gap-3 text-sm font-medium">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @stack('scripts')
</body>

</html>