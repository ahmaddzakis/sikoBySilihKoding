@extends('layouts.auth')

@section('title', 'Admin Login')

@section('content')
    <div class="w-full max-w-[400px] bg-[#1a161f] border border-[#2a2a2a] rounded-[28px] p-8 shadow-2xl">
        <!-- Icon Header -->
        <div class="mb-8">
            <div
                class="w-14 h-14 bg-red-500/10 rounded-full flex items-center justify-center mb-6 border border-red-500/20">
                <i class="fa-solid fa-shield-halved text-red-500 text-xl"></i>
            </div>

            <h1 class="text-2xl font-bold text-white mb-2">Admin Portal</h1>
            <p class="text-gray-400 text-sm">Access reserved for authorized personnel.</p>
        </div>

        <!-- Login Form -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
            @csrf

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-2">
                <label for="email" class="text-white text-sm font-medium">Admin Email</label>
                <input type="email" name="email" id="email" placeholder="admin@gmail.com" value="{{ old('email') }}"
                    required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-red-500/50 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="password" class="text-white text-sm font-medium">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-red-500/50 transition-all text-[15px] pr-12" />
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors focus:outline-none">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-red-600 text-white font-semibold py-3.5 rounded-xl hover:bg-red-700 transition-colors text-[15px] mt-2 shadow-lg shadow-red-900/20">
                Login to Dashboard
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-white transition-colors">
                Not an Admin? Back to User Login
            </a>
        </div>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection