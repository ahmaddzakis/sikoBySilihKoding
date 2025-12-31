@extends('layouts.app')

@section('title', 'Temukan Acara')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- bagian header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">
                Temukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-500">Acara
                    Resmi</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl">
                Jelajahi berbagai acara menarik yang diselenggarakan langsung oleh tim Siko. Temukan inspirasi dan
                pengalaman baru di sini.
            </p>
        </div>

        @if($events->isEmpty())
            <div
                class="flex flex-col items-center justify-center py-20 bg-surface/30 rounded-3xl border border-dashed border-border">
                <div class="w-20 h-20 bg-surface rounded-full flex items-center justify-center mb-6 shadow-xl">
                    <i class="fa-solid fa-compass text-3xl text-gray-600"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Belum ada acara resmi</h3>
                <p class="text-gray-500">Cek kembali nanti untuk pembaruan acara terbaru dari admin.</p>
            </div>
        @else
            <!-- daftar acara -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <a href="{{ route('events.show', $event['id']) }}" class="group block">
                        <div
                            class="bg-surface border border-border rounded-3xl overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-pink-500/10 hover:border-pink-500/30">
                            <!-- wadah gambarnya -->
                            <div class="relative aspect-[16/10] overflow-hidden">
                                @if($event['image'])
                                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                                        <i class="fa-regular fa-image text-4xl text-gray-700"></i>
                                    </div>
                                @endif

                                <!-- label harga -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-black/60 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-full border border-white/10">
                                        {{ $event['price'] > 0 ? 'Rp ' . number_format($event['price'], 0, ',', '.') : 'Gratis' }}
                                    </span>
                                </div>
                            </div>

                            <!-- isinya -->
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="w-2 h-2 rounded-full bg-pink-500 animate-pulse"></span>
                                    <span class="text-xs font-bold uppercase tracking-widest text-pink-500/80">Acara Resmi</span>
                                </div>
                                <h2
                                    class="text-xl font-bold text-white mb-3 line-clamp-2 leading-tight group-hover:text-pink-400 transition-colors">
                                    {{ $event['title'] }}
                                </h2>

                                <div class="space-y-2">
                                    <div class="flex items-center gap-3 text-sm text-gray-400">
                                        <i class="fa-regular fa-calendar-check w-4"></i>
                                        <span>{{ $event['date'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-gray-400">
                                        <i class="fa-solid fa-location-dot w-4"></i>
                                        <span class="truncate">{{ $event['location'] }}</span>
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-border flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-gradient-to-tr from-pink-500 to-purple-500 flex items-center justify-center">
                                            <i class="fa-solid fa-user-shield text-[10px] text-white"></i>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">{{ $event['organizer'] }}</span>
                                    </div>
                                    <span
                                        class="text-pink-500 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                        Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection