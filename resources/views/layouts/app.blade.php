<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siko - @yield('title', 'Home')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind Config -->
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

    <style>
        body {
            background-color: #1a161f;
            color: #ededed;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a161f;
        }

        ::-webkit-scrollbar-thumb {
            background: #3a3442;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4a4452;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="min-h-screen font-sans antialiased selection:bg-purple-500 selection:text-white" x-data="layoutData()">

    <!-- ================= NAVBAR ================= -->
    <header class="sticky top-0 bg-[#1a161f]/90 backdrop-blur-md z-50 border-b border-transparent transition-all"
        :class="{ 'border-[#3a3442]': window.scrollY > 10 }">
        <div class="max-w-6xl mx-auto px-6 h-16 flex justify-between items-center relative">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="SIKO Logo" class="h-10 w-auto">
                </a>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center gap-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="/events"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('events') || request()->is('/') ? 'text-white' : '' }}">
                    <i class="fa-regular fa-calendar"></i>
                    Acara
                </a>

                <a href="#"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                    <i class="fa-regular fa-calendar-days"></i>
                    Kalender
                </a>
            </nav>

            <!-- Right Tools -->
            <div class="flex items-center gap-6 text-sm text-gray-400">

                <a href="/create" class="hidden md:block text-white hover:text-gray-300 transition-colors font-medium">
                    Buat Acara
                </a>

                <button class="hover:text-white transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>

                <button class="hover:text-white transition-colors relative">
                    <i class="fa-regular fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-0.5 w-2 h-2 bg-red-500 rounded-full border-2 border-[#1a161f]">
                    </span>
                </button>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <div @click="open = !open"
                        class="w-8 h-8 rounded-full bg-gradient-to-tr from-green-400 to-blue-500 cursor-pointer border border-[#3a3442] hover:scale-105 transition-transform">
                    </div>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-3 w-56 bg-[#1a161f] border border-[#3a3442] rounded-2xl shadow-2xl overflow-hidden z-[60]"
                        x-cloak>
                        <!-- User Info -->
                        <div class="px-4 py-4 border-b border-[#3a3442] bg-[#221d28]/30">
                            <div class="font-bold text-white">mustika</div>
                            <div class="text-xs text-gray-500 truncate">mustika@gmail.com</div>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <form action="/login" method="GET">
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 text-red-400 hover:text-red-300 hover:bg-red-400/5 transition-colors text-sm font-medium">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ================= CONTENT ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= SCRIPTS ================= -->
    <script>
        function layoutData() {
            return {}
        }
    </script>

    @stack('scripts')
</body>

</html>