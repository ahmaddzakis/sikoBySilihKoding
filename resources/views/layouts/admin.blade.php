<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard - @yield('title','Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 min-h-screen">
    <div class="flex">
        <aside class="w-64 bg-white border-r min-h-screen p-4">
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">Admin</a>
            </div>
            <nav class="space-y-2 text-sm">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-slate-50">Dashboard</a>

                <a href="{{ route('profile') }}" class="block px-3 py-2 rounded hover:bg-slate-50">Profile</a>
            </nav>
            <div class="mt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600">Logout</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6">
            <header class="mb-6">
                <h1 class="text-2xl font-semibold">@yield('title','Dashboard')</h1>
            </header>

            <section>
                @yield('content')
            </section>
        </main>
    </div>

    @vite(['resources/js/app.js'])
</body>
</html>
