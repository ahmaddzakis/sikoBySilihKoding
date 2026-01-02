<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - SIKO</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        background: '#121212',
                        card: '#1e1e1e',
                        border: '#2a2a2a',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-[#121212] text-white font-sans selection:bg-purple-500/30">
    <!-- Navbar -->
    <nav class="w-full flex flex-col md:flex-row items-start md:items-center justify-between p-6 relative md:absolute top-0 left-0 z-50 gap-4">
        <!-- Left: Web Icon -->
        <a href="{{ url('/') }}" class="flex-shrink-0">
            <img src="{{ asset('favicon.png') }}" alt="SIKO Icon" class="h-8 w-auto hover:opacity-80 transition-opacity">
        </a>

        <!-- Right: Clock & Explore -->
        <div class="flex items-center gap-4 md:gap-6 text-sm font-medium text-gray-400">
            <div id="clock-wib" class="tracking-wide text-xs md:text-sm"></div>
            <a href="{{ url('/events') }}" class="hover:text-white transition-colors flex items-center gap-1 group text-xs md:text-sm">
                Explore Events
                <i class="fa-solid fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300 text-xs"></i>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-4 relative z-10 w-full">
        @yield('content')
    </main>

    <script>
        function updateClock() {
            const now = new Date();
            // Convert to WIB (UTC+7)
            const options = { 
                timeZone: 'Asia/Jakarta', 
                hour: 'numeric', 
                minute: 'numeric', 
                hour12: true 
            };
            const timeString = new Intl.DateTimeFormat('en-US', options).format(now);
            
            document.getElementById('clock-wib').textContent = `${timeString} WIB`;
        }

        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>