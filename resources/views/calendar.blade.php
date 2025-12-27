@extends('layouts.app')

@section('title', 'Kalender')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-8 text-white">Kalender</h1>

        <!-- Kalender Saya -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Kalender Saya</h2>
                <button
                    class="flex items-center gap-2 px-3 py-1.5 bg-surface/50 border border-border hover:bg-surfaceHover rounded text-sm font-medium transition-colors text-white">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Buat
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- User Calendar Card -->
                <a href="/profile" class="block">
                    <div
                        class="bg-surface border border-border rounded-xl p-6 hover:border-textMuted transition-colors cursor-pointer group h-full">
                        <div class="flex flex-col items-start gap-3">
                            <!-- Avatar -->
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-tr from-green-400 to-blue-500 border border-border">
                            </div>

                            <div class="mt-1">
                                <h3 class="font-bold text-base text-white group-hover:text-white transition-colors">Mustika
                                </h3>
                                <p class="text-sm text-textMuted group-hover:text-white/80 transition-colors">0 Pelanggan
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Separator -->
        <div class="border-t border-border my-8"></div>

        <!-- Kalender yang Berlangganan -->
        <div>
            <h2 class="text-xl font-bold mb-4 text-white">Kalender yang Berlangganan</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Empty State Card -->
                <div
                    class="bg-surface border border-border rounded-xl p-6 flex flex-col items-start justify-center text-left opacity-80 hover:opacity-100 transition-opacity min-h-[220px]">
                    <div class="relative mb-4">
                        <i class="fa-regular fa-calendar text-6xl text-border"></i>
                        <span
                            class="absolute top-[55%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-2xl font-bold text-border/70">0</span>
                    </div>

                    <h3 class="text-lg font-bold text-textMuted mb-1">Tidak Ada Langganan</h3>
                    <p class="text-sm text-textMuted/60 leading-relaxed">Anda belum berlangganan<br>kalender apa pun.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->

    </div>
@endsection