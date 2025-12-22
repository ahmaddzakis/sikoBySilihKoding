@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-6 py-24 sm:py-32 lg:py-40">
        <div class="text-center">
            <h1 class="text-5xl font-black tracking-tight text-white sm:text-7xl mb-8">
                Rayakan Momen<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">Tak Terlupakan</span>
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-400 max-w-2xl mx-auto">
                Platform terbaik untuk menemukan, membuat, dan mengelola acara Anda. Bergabunglah dengan komunitas kami dan mulailah perjalanan Anda hari ini.
            </p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/find" class="rounded-xl bg-white px-8 py-3.5 text-sm font-bold text-black shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white transition-all">
                    Temukan Acara
                </a>
                <a href="/create" class="text-sm font-semibold leading-6 text-white hover:text-purple-400 transition-colors">
                    Buat Acara <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decorative Blurs -->
    <div class="absolute top-0 -left-4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-0 -right-4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-32 left-20 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
</div>
@endsection
