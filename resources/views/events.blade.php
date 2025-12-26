@extends('layouts.app')

@section('title', 'Acara')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-12">
        <!-- Header & Toggle -->
        <div class="flex justify-between items-center mb-24">
            <h1 class="text-4xl font-bold text-white tracking-tight">Acara</h1>

            <!-- Toggle Switch -->
            <div class="bg-[#1e1e1e] p-1.5 rounded-xl border border-[#2d2d2d] flex text-sm">
                <a href="?tab=upcoming"
                    class="px-6 py-2.5 rounded-lg transition-all font-bold {{ $activeTab === 'upcoming' ? 'bg-[#3e3e3e] text-white' : 'text-gray-500 hover:text-gray-300' }}">
                    Akan Datang
                </a>
                <a href="?tab=past"
                    class="px-6 py-2.5 rounded-lg transition-all font-bold {{ $activeTab === 'past' ? 'bg-[#3e3e3e] text-white' : 'text-gray-500 hover:text-gray-300' }}">
                    Selesai
                </a>
            </div>
        </div>

        @php
            $events = $activeTab === 'upcoming' ? $upcomingEvents : $pastEvents;
        @endphp


        @if(count($events) > 0)
            <!-- Event List Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                    <div
                        class="bg-[#1a1a1a] rounded-3xl overflow-hidden border border-[#2d2d2d] hover:border-[#3d3d3d] transition-all group">
                        <div class="h-56 bg-[#2d2d2d] relative overflow-hidden">
                            <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover">
                            <div
                                class="absolute top-4 right-4 bg-black/50 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-white border border-white/10 uppercase">
                                {{ $event['attendees'] }} Peserta
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="text-[10px] font-black text-purple-400 mb-2 uppercase tracking-[0.2em]">{{ $event['date'] }}
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-3 leading-tight">{{ $event['title'] }}</h3>
                            <div class="flex items-center text-gray-500 text-xs mb-6">
                                <i class="fa-solid fa-location-dot mr-2"></i>
                                <span>{{ $event['location'] }}</span>
                            </div>
                            <button
                                class="w-full py-3 bg-[#2d2d2d] hover:bg-[#3d3d3d] text-white rounded-2xl text-sm font-bold transition-all border border-[#3d3d3d]">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State Container -->
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <!-- Icon Section -->
                <div class="mb-12 relative scale-110">
                    <!-- Main Grid Icon -->
                    <div
                        class="w-[140px] h-[100px] bg-[#2d2d2d] rounded-[28px] p-4 flex flex-wrap gap-2.5 relative border border-[#3d3d3d]/30 shadow-2xl">
                        <div class="w-8 h-5 bg-[#1a1a1a] rounded-md opacity-40"></div>
                        <div class="w-14 h-5 bg-[#1a1a1a] rounded-md opacity-40"></div>
                        <div class="w-14 h-10 bg-[#1a1a1a] rounded-md opacity-40"></div>
                        <div class="w-7 h-10 bg-[#3d3d3d] rounded-md"></div>
                        <div class="w-9 h-5 bg-[#1a1a1a] rounded-md opacity-40"></div>

                        <!-- Badge -->
                        <div
                            class="absolute -top-3 -right-3 w-14 h-14 bg-[#2d2d2d] rounded-full border-[8px] border-[#1a161f] flex items-center justify-center shadow-lg">
                            <span class="text-2xl font-black text-[#555]">0</span>
                        </div>
                    </div>
                </div>

                <!-- Text Content -->
                <h2 class="text-3xl font-black text-white mb-4 tracking-tight">
                    {{ $activeTab === 'upcoming' ? 'Tidak Ada Acara Mendatang' : 'Tidak Ada Acara Selesai' }}
                </h2>
                <p class="text-[#888] mb-12 max-w-sm text-lg font-medium leading-relaxed">
                    {{ $activeTab === 'upcoming'
                ? 'Anda tidak memiliki acara mendatang. Mengapa tidak membuat satu?'
                : 'Anda belum mengikuti acara apa pun yang telah selesai.' }}
                </p>

                <!-- Action Button -->
                <a href="/create"
                    class="flex items-center gap-2 bg-[#2d2d30] hover:bg-[#3a3a3d] text-white px-8 py-3.5 rounded-xl transition-all border border-[#3e3e42] font-bold text-sm shadow-xl active:scale-95">
                    <i class="fa-solid fa-plus text-xs opacity-50"></i>
                    Buat Acara
                </a>
            </div>
        @endif
    </div>
@endsection