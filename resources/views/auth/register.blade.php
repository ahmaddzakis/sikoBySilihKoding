@extends('layouts.auth')

@section('title', 'Daftar')

@section('content')
    <div class="w-full max-w-[400px] bg-[#1a161f] border border-[#2a2a2a] rounded-[28px] p-8 shadow-2xl">
        <!-- Icon Header -->
        <div class="mb-8">
            <div class="w-14 h-14 bg-[#2f2936] rounded-full flex items-center justify-center mb-6">
                <i class="fa-solid fa-user-plus text-white text-xl"></i>
            </div>

            <h1 class="text-2xl font-bold text-white mb-2">Buat Akun</h1>
            <p class="text-gray-400 text-sm">Gabung Siko untuk mulai mengelola acaramu.</p>
        </div>

        <!-- Register Form -->
        <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
            @csrf

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs p-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-2">
                <label for="name" class="text-white text-sm font-medium">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Nama kamu" value="{{ old('name') }}" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="email" class="text-white text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" placeholder="kamu@email.com" value="{{ old('email') }}" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="password" class="text-white text-sm font-medium">Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="••••••••" required
                        class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px] pr-12" />
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors focus:outline-none">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="space-y-2">
                <label for="password_confirmation" class="text-white text-sm font-medium">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                        required
                        class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px] pr-12" />
                    <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors focus:outline-none">
                        <i class="fa-regular fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-white text-black font-semibold py-3.5 rounded-xl hover:bg-gray-200 transition-colors text-[15px] mt-2 shadow-lg">
                Buat Akun
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-white hover:underline transition-colors">
                    Masuk di sini
                </a>
            </p>
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