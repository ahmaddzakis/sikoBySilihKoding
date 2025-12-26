@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="w-full max-w-[400px] bg-[#1a161f] border border-[#2a2a2a] rounded-[28px] p-8 shadow-2xl">
        <!-- Icon Header -->
        <div class="mb-8">
            <div class="w-14 h-14 bg-[#2f2936] rounded-full flex items-center justify-center mb-6">
                <i class="fa-solid fa-right-to-bracket text-white text-xl translate-x-0.5"></i>
            </div>

            <h1 class="text-2xl font-bold text-white mb-2">Welcome to Siko</h1>
            <p class="text-gray-400 text-sm">Please sign in or sign up below.</p>
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
                <div class="flex justify-between items-center">
                    <label for="email" class="text-white text-sm font-medium">Email</label>
                    <button type="button"
                        class="text-gray-500 text-xs hover:text-gray-300 flex items-center gap-1.5 transition-colors">
                        <i class="fa-solid fa-mobile-screen-button text-[10px]"></i>
                        Use Phone Number
                    </button>
                </div>
                <input type="email" name="email" id="email" placeholder="you@email.com" value="{{ old('email') }}" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <!-- Added Password Field (Standard necessity) -->
            <div class="space-y-2">
                <label for="password" class="text-white text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <button type="submit"
                class="w-full bg-white text-black font-semibold py-3.5 rounded-xl hover:bg-gray-200 transition-colors text-[15px] mt-2 shadow-lg">
                Continue with Email
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-[#2a2a2a]"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <!-- Space for label if needed -->
            </div>
        </div>

        <!-- Social Logins -->
        <div class="space-y-3">
            <button
                class="w-full bg-[#2f2936] text-gray-300 font-medium py-3.5 rounded-xl hover:bg-[#3d3645] transition-colors flex items-center justify-center gap-3 text-[15px]">
                <i class="fa-brands fa-google text-[16px]"></i>
                Sign in with Google
            </button>
            <button
                class="w-full bg-[#2f2936] text-gray-300 font-medium py-3.5 rounded-xl hover:bg-[#3d3645] transition-colors flex items-center justify-center gap-3 text-[15px]">
                <i class="fa-solid fa-key text-[16px]"></i>
                Sign in with Passkey
            </button>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('admin.login') }}" class="text-xs text-gray-500 hover:text-white transition-colors">
                Are you an Admin? Login here
            </a>
        </div>
    </div>
@endsection