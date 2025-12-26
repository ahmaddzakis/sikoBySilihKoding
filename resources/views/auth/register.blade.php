@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="w-full max-w-[400px] bg-[#1a161f] border border-[#2a2a2a] rounded-[28px] p-8 shadow-2xl">
        <!-- Icon Header -->
        <div class="mb-8">
            <div class="w-14 h-14 bg-[#2f2936] rounded-full flex items-center justify-center mb-6">
                <i class="fa-solid fa-user-plus text-white text-xl"></i>
            </div>

            <h1 class="text-2xl font-bold text-white mb-2">Create an account</h1>
            <p class="text-gray-400 text-sm">Join Siko to start managing your events.</p>
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
                <label for="name" class="text-white text-sm font-medium">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Your name" value="{{ old('name') }}" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="email" class="text-white text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" placeholder="you@email.com" value="{{ old('email') }}" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="password" class="text-white text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <div class="space-y-2">
                <label for="password_confirmation" class="text-white text-sm font-medium">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                    required
                    class="w-full bg-transparent border border-[#3a3442] rounded-xl px-4 py-3.5 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500 transition-all text-[15px]" />
            </div>

            <button type="submit"
                class="w-full bg-white text-black font-semibold py-3.5 rounded-xl hover:bg-gray-200 transition-colors text-[15px] mt-2 shadow-lg">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-white hover:underline transition-colors">
                    Log in here
                </a>
            </p>
        </div>
    </div>
@endsection