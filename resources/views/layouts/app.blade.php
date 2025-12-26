<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siko - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

    <!-- Navbar -->
    <header class="sticky top-0 bg-[#1a161f]/90 backdrop-blur-md z-50 border-b border-transparent transition-all"
        :class="{'border-[#3a3442]': window.scrollY > 10}">
        <div class="max-w-6xl mx-auto px-6 h-16 flex justify-between items-center relative">

            <!-- Logo (Left) -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="SIKO Logo" class="h-10 w-auto">
                </a>
            </div>

            <!-- Center Navigation -->
            <nav class="hidden md:flex items-center gap-8 absolute left-1/2 transform -translate-x-1/2">
                <a href="/events"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('events') ? 'text-white' : '' }}">
                    <i class="fa-regular fa-calendar"></i>
                    Acara
                </a>
                <a href="#"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                    <i class="fa-regular fa-calendar-days"></i>
                    Kalender
                </a>
                <a href="/find"
                    class="text-gray-400 hover:text-white transition-colors text-sm font-medium flex items-center gap-2 {{ request()->is('find*') ? 'text-white' : '' }}">
                    <i class="fa-regular fa-compass"></i>
                    Temukan
                </a>
            </nav>

            <!-- Right Side Tools -->
            <div class="flex items-center gap-6 text-sm text-gray-400">
                <!-- Time -->
                <!-- <span class="hidden lg:block text-gray-500 font-mono">17.13 WIB</span> -->

                <!-- Create Event Link -->
                <a href="/create"
                    class="hidden md:block text-white hover:text-gray-300 transition-colors font-medium">Buat Acara</a>

                <!-- Search Icon -->
                <button class="hover:text-white transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </button>

                <!-- Bell Icon with Notification Dot -->
                <button class="hover:text-white transition-colors relative">
                    <i class="fa-regular fa-bell text-lg"></i>
                    <span
                        class="absolute -top-1 -right-0.5 w-2 h-2 bg-red-500 rounded-full border-2 border-[#1a161f]"></span>
                </button>

                <!-- Profile Avatar -->
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-tr from-green-400 to-blue-500 cursor-pointer border border-[#3a3442]">
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main>
        @yield('content')
    </main>



    <script>
        function layoutData() {
            return {
                // Shared layout state if needed
            }
        }
    </script>
    @stack('scripts')
</body>

</html>