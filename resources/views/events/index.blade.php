@extends('layouts.app')

@section('title', 'Acara')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8" x-data="{ activeTab: 'upcoming' }">
    <!-- Header & Toggle -->
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-3xl font-bold text-white">Acara</h1>

        <!-- Toggle Switch -->
        <div class="bg-[#26212c] p-1 rounded-lg border border-[#3a3442] flex text-sm">
            <button @click="activeTab = 'upcoming'"
                class="px-4 py-1.5 rounded-md transition-all font-medium"
                :class="activeTab === 'upcoming' ? 'bg-[#3a3442] text-white shadow-sm' : 'text-gray-400 hover:text-gray-200'">
                Akan Datang
            </button>
            <button @click="activeTab = 'past'"
                class="px-4 py-1.5 rounded-md transition-all font-medium"
                :class="activeTab === 'past' ? 'bg-[#3a3442] text-white shadow-sm' : 'text-gray-400 hover:text-gray-200'">
                Selesai
            </button>
        </div>
    </div>

    <!-- Upcoming Events -->
    <div x-show="activeTab === 'upcoming'">
        @if(count($upcomingEvents) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($upcomingEvents as $event)
                    <div class="bg-[#26212c] border border-[#3a3442] rounded-xl overflow-hidden hover:border-purple-500 transition-colors group">
                        <div class="h-48 overflow-hidden relative">
                            <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5">
                            <div class="text-xs font-bold text-purple-400 mb-2 uppercase tracking-wide">{{ $event['date'] }}</div>
                            <h3 class="text-xl font-bold text-white mb-2 leading-tight">{{ $event['title'] }}</h3>
                            <div class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $event['description'] }}</div>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 border-t border-[#3a3442] pt-4">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="truncate max-w-[120px]">{{ $event['location'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-users"></i>
                                    <span>{{ $event['attendees'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <div class="w-24 h-24 bg-[#26212c] rounded-2xl flex items-center justify-center mb-6 relative border border-[#3a3442]">
                    <i class="fa-regular fa-calendar text-4xl text-gray-600"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Tidak Ada Acara Akan Datang</h2>
                <p class="text-gray-500 mb-8 max-w-md">Anda tidak memiliki acara yang akan datang.</p>
            </div>
        @endif
    </div>

    <!-- Past Events -->
    <div x-show="activeTab === 'past'" style="display: none;">
        @if(count($pastEvents) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                 @foreach($pastEvents as $event)
                    <div class="bg-[#26212c] border border-[#3a3442] rounded-xl overflow-hidden hover:border-gray-500 transition-colors group opacity-75 hover:opacity-100">
                        <div class="h-48 overflow-hidden relative grayscale group-hover:grayscale-0 transition-all duration-500">
                            <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover">
                             <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                <span class="bg-black/70 text-white px-3 py-1 rounded-full text-sm font-bold border border-white/20">Selesai</span>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="text-xs font-bold text-gray-400 mb-2 uppercase tracking-wide">{{ $event['date'] }}</div>
                            <h3 class="text-xl font-bold text-gray-300 mb-2 leading-tight">{{ $event['title'] }}</h3>
                            <div class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $event['description'] }}</div>
                            
                            <div class="flex justify-between items-center text-sm text-gray-600 border-t border-[#3a3442] pt-4">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="truncate max-w-[120px]">{{ $event['location'] }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-users"></i>
                                    <span>{{ $event['attendees'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
             <!-- Empty State -->
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <div class="w-24 h-24 bg-[#26212c] rounded-2xl flex items-center justify-center mb-6 relative border border-[#3a3442]">
                    <i class="fa-regular fa-clock text-4xl text-gray-600"></i>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Tidak Ada Acara Selesai</h2>
                <p class="text-gray-500 mb-8 max-w-md">Anda belum mengikuti acara apapun yang telah selesai.</p>
            </div>
        @endif
    </div>

</div>
@endsection
