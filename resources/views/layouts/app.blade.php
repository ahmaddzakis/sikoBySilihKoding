<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siko - @yield('title', 'Beranda')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Konfigurasi Tema Tailwind CSS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
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

    <style type="text/tailwindcss">
        @layer utilities {
            [x-cloak] {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen font-sans antialiased bg-gradient-to-br from-gray-950 via-[#13111C] to-[#341020] text-textMain selection:bg-pink-500 selection:text-white 
    [&::-webkit-scrollbar]:w-2 
    [&::-webkit-scrollbar-track]:bg-transparent 
    [&::-webkit-scrollbar-thumb]:bg-pink-900/50 
    [&::-webkit-scrollbar-thumb]:rounded 
    [&::-webkit-scrollbar-thumb:hover]:bg-pink-800 flex flex-col" x-data="layoutData()">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 bg-[#1a161f]/90 backdrop-blur-md z-50 border-b border-transparent transition-all"
        :class="{ 'border-[#3a3442]': window.scrollY > 10 }">
        <div class="max-w-6xl mx-auto px-6 h-16 flex justify-between items-center relative">

            <!-- Logo SIKO -->
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="SIKO Logo" class="h-10 w-auto">
                </a>
                <div x-data="{ 
                    time: '', 
                    updateTime() {
                        const now = new Date();
                        // Format: 10:17 PM
                        let timeStr = now.toLocaleTimeString('en-US', { 
                            hour: '2-digit', 
                            minute: '2-digit', 
                            hour12: true 
                        });
                        this.time = timeStr + ' GMT+7';
                    }
                }" x-init="updateTime(); setInterval(() => updateTime(), 60000)"
                    class="hidden sm:block text-gray-500 font-medium text-xs tracking-tight border-l border-gray-800 pl-4 py-1">
                    <span x-text="time"></span>
                </div>
            </div>

            <!-- Navigasi Menu: Desktop Only -->
            <nav class="hidden md:flex items-center gap-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="/events"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('events') || request()->is('/') ? 'text-white' : '' }}">
                    <i class="fa-regular fa-calendar"></i>
                    Acara
                </a>

                <a href="/find"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('find') ? 'text-white' : '' }}">
                    <i class="fa-solid fa-compass"></i>
                    Temukan
                </a>

                <a href="/calendar"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('calendar') ? 'text-white' : '' }}">
                    <i class="fa-regular fa-calendar-days"></i>
                    Kalender
                </a>
            </nav>

            <!-- Alat Samping Kanan (Search, Notification, Profile) -->
            <div class="flex items-center gap-6 text-sm text-gray-400">

                <!-- Tombol Pencarian -->
                <button @click="searchOpen = true" class="hover:text-white transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>

                <!-- Tombol Buat Acara -->
                <a href="/create" class="hidden md:block text-white hover:text-gray-300 transition-colors font-medium">
                    Buat Acara
                </a>

                <!-- Dropdown Notifikasi (File Terpisah) -->
                @include('notification')

                <!-- Dropdown Profil: Logika untuk user yang sudah Login atau Belum -->
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <!-- Avatar User -->
                        <div @click="open = !open"
                            class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-tr from-green-400 to-green-600 cursor-pointer border-2 border-[#3a3442] hover:scale-105 transition-all flex items-center justify-center">
                            @if(Auth::user()->avatar)
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="relative w-6 h-6 flex items-center justify-center">
                                    <div class="absolute top-1.5 left-1 w-1.5 h-1.5 bg-black/80 rounded-full"></div>
                                    <div class="absolute top-1.5 right-1 w-1.5 h-1.5 bg-black/80 rounded-full"></div>
                                    <div
                                        class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-2 border-b-2 border-black/80 rounded-full">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Menu Dropdown Profil -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-56 bg-[#1a161f] border border-[#3a3442] rounded-2xl shadow-2xl overflow-hidden z-[60]"
                            x-cloak>

                            <!-- Info Singkat User -->
                            <div class="px-4 py-4 border-b border-[#3a3442] bg-[#221d28]/30">
                                <div class="font-bold text-white">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</div>
                            </div>

                            <!-- Pilihan Menu -->
                            <div class="py-2">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-2.5 text-gray-300 hover:text-white hover:bg-white/5 transition-colors text-sm font-medium">
                                        <i class="fa-solid fa-gauge-high mr-2 text-xs opacity-50"></i> Dashboard
                                    </a>
                                @endif
                                <a href="/profile"
                                    class="block px-4 py-2.5 text-gray-300 hover:text-white hover:bg-white/5 transition-colors text-sm font-medium">
                                    <i class="fa-regular fa-user mr-2 text-xs opacity-50"></i> Lihat Profil
                                </a>
                                <div class="h-px bg-[#3a3442] my-1 mx-2"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2.5 text-red-400 hover:text-red-300 hover:bg-red-400/5 transition-colors text-sm font-medium">
                                        <i class="fa-solid fa-arrow-right-from-bracket mr-2 text-xs opacity-50"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Link Sign In jika belum login -->
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300 transition-colors font-medium">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-6xl mx-auto px-6 mt-8">
                <div
                    class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-6xl mx-auto px-6 mt-8">
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl text-sm font-medium">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span class="font-bold">Ada beberapa masalah:</span>
                    </div>
                    <ul class="list-disc list-inside ml-7 mt-1 opacity-80 decoration-none">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    @if(!request()->is('create'))
        <footer class="w-full mt-auto">
            <div class="max-w-6xl mx-auto px-6 pb-10">
                <div class="mt-20 pt-8 border-t border-border">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Logo & Navigasi -->
                        <div class="flex items-center gap-6">
                            <img src="{{ asset('images/logo.png') }}" alt="Siko Logo"
                                class="h-6 w-auto grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
                            <div class="flex items-center gap-4">
                                <a href="/find"
                                    class="text-textMuted hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                                    <span>Temukan</span>
                                </a>
                                <span class="text-gray-800 text-xs">|</span>
                                <a href="/calendar"
                                    class="text-textMuted hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                                    <span>Kalender</span>
                                </a>
                            </div>
                        </div>

                        <!-- Sisi Kanan: Icon Instagram -->
                        <a href="https://instagram.com/siko.events" target="_blank"
                            class="text-textMuted hover:text-white transition-colors text-lg">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    @endif

    @include('search')

    <!-- ================= SCRIPTS ================= -->
    <script>
        function layoutData() {
            return {
                searchOpen: false,

                init() {
                    this.$watch('searchOpen', value => {
                        if (value) {
                            document.body.style.overflow = 'hidden';
                            window.dispatchEvent(new CustomEvent('show-search'));
                        } else {
                            document.body.style.overflow = '';
                        }
                    });

                    window.addEventListener('keydown', (e) => {
                        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                            e.preventDefault();
                            this.searchOpen = !this.searchOpen;
                        }
                    });
                }
            }
        }
    </script>

    @stack('scripts')
</body>

</html>