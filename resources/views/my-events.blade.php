@extends('layouts.app')

@section('title', 'Acara Saya')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-10">
        
        <!-- Header with Back Button -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('calendar') }}" class="w-10 h-10 rounded-xl bg-[#26212c] border border-[#3a3442] flex items-center justify-center text-gray-400 hover:text-white hover:border-gray-500 transition-all">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-white">Acara Saya</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
                <div class="bg-[#1a161f] p-5 rounded-3xl border border-[#2d2d2d] flex flex-col justify-between relative group hover:border-gray-600 transition-all h-full">
                    <!-- Top Section: Time -->
                    <div class="text-gray-400 text-sm font-medium mb-2">
                        {{ $event->waktu_mulai->format('g:i A') }}
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <!-- Left Content -->
                        <div class="flex-1 min-w-0">
                            <!-- User/Event Title -->
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-2 h-2 rounded-full bg-pink-500 shadow-[0_0_10px_rgba(236,72,153,0.5)] flex-shrink-0"></div>
                                <h3 class="text-white font-bold text-lg leading-tight truncate">{{ $event->judul }}</h3>
                            </div>

                            <!-- Location -->
                            <div class="flex items-center gap-2 text-gray-500 text-sm mb-1.5">
                                <i class="fa-solid fa-location-dot text-xs w-4 text-center flex-shrink-0"></i>
                                <span class="truncate">{{ Str::limit($event->lokasi, 20) }}</span>
                            </div>

                            <!-- Guests -->
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <i class="fa-solid fa-user-group text-xs w-4 text-center flex-shrink-0"></i>
                                <span>{{ $event->registrations_count ?? 0 }} guests</span>
                            </div>
                        </div>

                        <!-- Right Content: Image -->
                        <div class="w-24 h-24 rounded-2xl overflow-hidden bg-gray-800 flex-shrink-0 border border-[#2d2d2d]">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover" alt="Event Image">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-600 font-bold text-xs p-2 text-center bg-[#242424]">
                                    {{ Str::limit($event->judul, 10, '') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-center opacity-60">
                    <div class="w-20 h-20 bg-[#26212c] rounded-3xl flex items-center justify-center mb-6 border border-[#3a3442]">
                        <i class="fa-regular fa-calendar-xmark text-3xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum ada acara</h3>
                    <p class="text-gray-400">Anda belum membuat acara apapun.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
