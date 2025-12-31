@extends('layouts.app')

@section('title', 'Kalender')

@section('content')
    <!-- container utama: ngatur tata letak sama jarak luar -->
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- halaman kalender -->
        <h1 class="text-3xl font-bold mb-8 text-white">Kalender</h1>

        <!-- bagian buat lihat kalender punya user sendiri -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Kalender Saya</h2>
            </div>


            <!-- grid layout buat kartu-kartu kalender -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- kartu kalender user -->
                <a href="{{ route('calendar.my-events') }}" class="block">
                    <div
                        class="bg-surface border border-border rounded-xl p-6 hover:border-textMuted transition-colors cursor-pointer group h-full">
                        <div class="flex flex-col items-start gap-3">

                            <!-- foto profil yang punya kalender -->
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border border-border flex items-center justify-center {{ Auth::user()->avatar ? '' : 'bg-gradient-to-tr from-green-400 to-green-600' }}">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="relative w-6 h-6">
                                        <div class="absolute top-1.5 left-1 w-1 h-1.5 bg-black/80 rounded-full"></div>
                                        <div class="absolute top-1.5 right-1 w-1 h-1.5 bg-black/80 rounded-full"></div>
                                        <div class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-2 border-b-2 border-black/80 rounded-full"></div>
                                    </div>
                                @endif
                            </div>

                            <!-- informasi kalender -->
                            <div class="mt-1">
                                <h3 class="font-bold text-base text-white group-hover:text-white transition-colors">
                                    {{ Auth::user()->name }}
                                </h3>
                                <p class="text-sm text-textMuted group-hover:text-white/80 transition-colors">
                                    {{ Auth::user()->events()->count() }} Acara
                                </p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </div>
@endsection