<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SIKO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a0a;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card Container -->
        <div class="bg-[#1a1a1a] rounded-3xl p-8 border border-[#2a2a2a]">
            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <div class="w-24 h-24 bg-[#2a2a2a] rounded-full flex items-center justify-center p-4">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SIKO Logo" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Welcome Text -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang di SIKO</h1>
                <p class="text-gray-400">Silakan masuk di bawah ini.</p>
            </div>

            <!-- Email Form -->
            <form action="/signin" method="POST" class="space-y-6">
                @csrf

                <!-- Email Label -->
                <div>
                    <label class="text-white font-medium block mb-3">Email</label>

                    <!-- Email Input -->
                    <input type="email" name="email" placeholder="anda@email.com"
                        class="w-full px-4 py-3 bg-[#0a0a0a] border border-[#2a2a2a] rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-[#3a3a3a] transition"
                        required>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="text-white font-medium block mb-3">Password</label>
                    <input type="password" name="password" placeholder="Masukkan password"
                        class="w-full px-4 py-3 bg-[#0a0a0a] border border-[#2a2a2a] rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-[#3a3a3a] transition"
                        required>
                </div>

                <!-- Continue Button -->
                <button type="submit"
                    class="w-full py-3 bg-white text-black font-semibold rounded-xl hover:bg-gray-100 transition">
                    Masuk
                </button>


            </form>
        </div>
    </div>
</body>

</html>