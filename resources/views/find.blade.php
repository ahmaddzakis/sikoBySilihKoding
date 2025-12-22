@extends('layouts.app')

@section('title', 'Temukan')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-6" x-data="{ activeTab: 'asia' }">
        
        <!-- Hero Section -->
        <div class="mb-12 mt-8">
            <h1 class="text-3xl font-bold text-white mb-3">Temukan Acara</h1>
            <p class="text-gray-400 text-base max-w-xl leading-relaxed">
                Jelajahi acara populer di dekat Anda, telusuri berdasarkan kategori, atau lihat beberapa kalender komunitas yang bagus.
            </p>
        </div>

        <!-- Categories Section -->
        <div class="mb-12">
            <h2 class="text-lg font-bold text-white mb-4">Jelajahi berdasarkan Kategori</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                
                <!-- Card Item -->
                <a href="{{ route('find.category', 'teknologi') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-orange-500/10 text-orange-500 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Teknologi</div>
                        <div class="text-[12px] text-gray-500">1 rb Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.category', 'makanan') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-yellow-500/10 text-yellow-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Makanan & Minuman</div>
                        <div class="text-[12px] text-gray-500">6 Acara</div>
                    </div>
                </a>
                
                <a href="{{ route('find.category', 'ai') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-pink-500/10 text-pink-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">AI</div>
                        <div class="text-[12px] text-gray-500">801 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.category', 'seni') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-lime-500/10 text-lime-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Seni & Budaya</div>
                        <div class="text-[12px] text-gray-500">432 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.category', 'iklim') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-green-500/10 text-green-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Iklim</div>
                        <div class="text-[12px] text-gray-500">206 Acara</div>
                    </div>
                </a>

                 <a href="{{ route('find.category', 'kebugaran') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-orange-600/10 text-orange-600 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Kebugaran</div>
                        <div class="text-[12px] text-gray-500">442 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.category', 'kesehatan') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-teal-500/10 text-teal-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Kesehatan</div>
                        <div class="text-[12px] text-gray-500">626 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.category', 'musik') }}" class="bg-[#26212c] hover:bg-[#2f2936] p-2 rounded-lg border border-[#3a3442] flex flex-col gap-1 transition-colors group">
                    <div class="w-6 h-6 rounded-md bg-purple-500/10 text-purple-500 flex items-center justify-center">
                         <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                     <div>
                        <div class="font-bold text-gray-200 group-hover:text-white">Musik</div>
                        <div class="text-[12px] text-gray-500">321 Acara</div>
                    </div>
                </a>

            </div>
        </div>

        <!-- Featured Calendars -->
        <div class="mb-12">
            <h2 class="text-lg font-bold text-white mb-4">Kalender Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Calendar Card 1 -->
                <div class="bg-[#26212c] border border-[#3a3442] rounded-xl p-3 hover:bg-[#2f2936] transition-colors cursor-pointer group">
                    <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-lg bg-gray-800 flex items-center justify-center">
                             <span class="text-base">🥁</span>
                        </div>
                        <span class="px-2 py-0.5 bg-[#342e3b] rounded-full text-[10px] font-bold text-gray-300 border border-[#4a4452]">Berlangganan</span>
                    </div>
                    <div class="mb-1">
                        <h3 class="text-sm font-bold text-white group-hover:text-purple-400 transition-colors">Reading Rhythms Global</h3>
                        <p class="text-[#a1a1aa] text-xs mt-1 line-clamp-2">Not a book club. A reading party. Read with friends to live music.</p>
                    </div>
                </div>

                <!-- Calendar Card 2 -->
                <div class="bg-[#26212c] border border-[#3a3442] rounded-xl p-3 hover:bg-[#2f2936] transition-colors cursor-pointer group">
                     <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-black font-bold text-sm">
                             BC
                        </div>
                        <span class="px-2 py-0.5 bg-[#342e3b] rounded-full text-[10px] font-bold text-gray-300 border border-[#4a4452]">Berlangganan</span>
                    </div>
                    <div class="mb-1">
                        <h3 class="text-sm font-bold text-white group-hover:text-purple-400 transition-colors">Build Club</h3>
                        <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Sydney
                        </div>
                        <p class="text-[#a1a1aa] text-xs mt-1 line-clamp-2">The best place in the world to learn AI. Curated with experts.</p>
                    </div>
                </div>

                <!-- Calendar Card 3 -->
                <div class="bg-[#26212c] border border-[#3a3442] rounded-xl p-3 hover:bg-[#2f2936] transition-colors cursor-pointer group">
                     <div class="flex justify-between items-start mb-2">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center">
                            <span class="text-lg text-black">∿</span>
                        </div>
                        <span class="px-2 py-0.5 bg-[#342e3b] rounded-full text-[10px] font-bold text-gray-300 border border-[#4a4452]">Berlangganan</span>
                    </div>
                    <div class="mb-1">
                        <h3 class="text-sm font-bold text-white group-hover:text-purple-400 transition-colors">South Park Commons</h3>
                        <p class="text-[#a1a1aa] text-xs mt-1 line-clamp-2">South Park Commons helps you get from -1 to 0. To learn more join us.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Local Events Section -->
        <div class="mb-20">
            <h2 class="text-lg font-bold text-white mb-6">Jelajahi Acara Lokal</h2>
            
            <!-- Tabs -->
            <div class="flex flex-wrap gap-2 mb-8">
                <button class="px-4 py-2 rounded-full text-xs font-bold transition-colors bg-[#3a3442] text-white">
                    Indonesia
                </button>
            </div>
            
            <!-- Cities Grid - Indonesia Only -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-y-8 gap-x-4">
                 <!-- Row 1 -->
                <a href="{{ route('find.city', 'Jakarta') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-red-500/20 text-red-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Jakarta</div>
                        <div class="text-[10px] text-gray-500">24 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Bandung') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-blue-500/20 text-blue-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Bandung</div>
                        <div class="text-[10px] text-gray-500">18 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Surabaya') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Surabaya</div>
                        <div class="text-[10px] text-gray-500">15 Acara</div>
                    </div>
                </a>
                 
                <a href="{{ route('find.city', 'Yogyakarta') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-yellow-500/20 text-yellow-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.85.577-4.147l.156-.479c.928-2.618 3.193-4.529 6.007-4.996" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Yogyakarta</div>
                        <div class="text-[10px] text-gray-500">22 Acara</div>
                    </div>
                </a>
                 
                 <!-- Row 2 -->
                <a href="{{ route('find.city', 'Bali') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-purple-500/20 text-purple-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Bali</div>
                        <div class="text-[10px] text-gray-500">31 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Semarang') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-teal-500/20 text-teal-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Semarang</div>
                        <div class="text-[10px] text-gray-500">12 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Medan') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-orange-500/20 text-orange-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Medan</div>
                        <div class="text-[10px] text-gray-500">9 Acara</div>
                    </div>
                </a>
                 
                <a href="{{ route('find.city', 'Makassar') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-pink-500/20 text-pink-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Makassar</div>
                        <div class="text-[10px] text-gray-500">8 Acara</div>
                    </div>
                </a>

                 <!-- Row 3 -->
                <a href="{{ route('find.city', 'Malang') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-lime-500/20 text-lime-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Malang</div>
                        <div class="text-[10px] text-gray-500">11 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Palembang') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-cyan-500/20 text-cyan-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Palembang</div>
                        <div class="text-[10px] text-gray-500">7 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Batam') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-indigo-500/20 text-indigo-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Batam</div>
                        <div class="text-[10px] text-gray-500">6 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Balikpapan') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-amber-500/20 text-amber-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Balikpapan</div>
                        <div class="text-[10px] text-gray-500">5 Acara</div>
                    </div>
                </a>

                 <!-- Row 4 -->
                <a href="{{ route('find.city', 'Manado') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-rose-500/20 text-rose-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Manado</div>
                        <div class="text-[10px] text-gray-500">4 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Bogor') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Bogor</div>
                        <div class="text-[10px] text-gray-500">10 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Tangerang') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-fuchsia-500/20 text-fuchsia-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Tangerang</div>
                        <div class="text-[10px] text-gray-500">8 Acara</div>
                    </div>
                </a>

                <a href="{{ route('find.city', 'Bekasi') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-sky-500/20 text-sky-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-white">Bekasi</div>
                        <div class="text-[10px] text-gray-500">7 Acara</div>
                    </div>
                </a>

            </div>


        </div>

    </div>
@endsection
