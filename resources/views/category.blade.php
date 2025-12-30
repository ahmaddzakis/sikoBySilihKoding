@extends('layouts.app')

@section('title', ucfirst($category ?? 'Kategori'))

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-8" x-data="{ category: '{{ ucfirst($category ?? 'Teknologi') }}' }">

        <!-- Hero Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
            <!-- Left Text -->
            <div class="space-y-6">
                <!-- Icon & Title -->
                <div>
                    <!-- Dynamic Icon based on category (Simple logic for demo) -->
                    <div class="w-16 h-16 rounded-2xl bg-[#26212c] border border-[#3a3442] flex items-center justify-center text-3xl mb-6 shadow-2xl text-orange-500"
                        x-show="category === 'Teknologi'">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-[#26212c] border border-[#3a3442] flex items-center justify-center text-3xl mb-6 shadow-2xl text-yellow-500"
                        x-show="category === 'Makanan'">
                        <i class="fa-solid fa-burger"></i>
                    </div>
                    <div class="w-16 h-16 rounded-2xl bg-[#26212c] border border-[#3a3442] flex items-center justify-center text-3xl mb-6 shadow-2xl text-white"
                        x-show="category !== 'Teknologi' && category !== 'Makanan'">
                        ✨
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-4 tracking-tight" x-text="category"></h1>

                    <div class="flex items-center gap-4 text-[#a1a1aa] text-sm font-medium">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ $eventCount }} Acara</span>
                        </div>
                    </div>
                </div>

                <p class="text-gray-400 text-lg leading-relaxed max-w-md">
                    {{ $description }}
                </p>

            </div>

            <!-- Right Card (3D Style) -->
            <div class="relative group">
                <!-- Background Blob -->
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-blue-500 rounded-[2rem] blur opacity-25 group-hover:opacity-40 transition duration-1000">
                </div>

                <!-- Card Container -->
                <div
                    class="relative aspect-video bg-[#1e1a24] rounded-[2rem] border border-[#3a3442] overflow-hidden flex items-center justify-center">

                    <!-- Inner Image / 3D Element Placeholder -->
                    <!-- Using a gradient circle to mimic the 3D element in screenshot -->
                    <div
                        class="relative w-64 h-64 rounded-full bg-gradient-to-b from-[#706487] to-[#26212c] flex items-center justify-center shadow-2xl">
                        <div class="w-56 h-56 rounded-full bg-[#1e1a24] flex items-center justify-center overflow-hidden">
                            <!-- Category Images -->
                            @if(strtolower($category ?? '') === 'teknologi')
                                <img src="{{ asset('images/categories/teknologi.png') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="Teknologi" />
                            @elseif(strtolower($category ?? '') === 'makanan')
                                <img src="{{ asset('images/categories/makanan.png') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="Makanan" />
                            @elseif(strtolower($category ?? '') === 'ai')
                                <img src="{{ asset('images/categories/ai.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="ai" />
                            @elseif(strtolower($category ?? '') === 'seni')
                                <img src="{{ asset('images/categories/art.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="seni" />
                            @elseif(strtolower($category ?? '') === 'iklim')
                                <img src="{{ asset('images/categories/iklim.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="iklim" />
                            @elseif(strtolower($category ?? '') === 'kebugaran')
                                <img src="{{ asset('images/categories/kebugaran.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="kebugaran" />
                            @elseif(strtolower($category ?? '') === 'kesehatan')
                                <img src="{{ asset('images/categories/kesehatan.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="kesehatan" />
                            @elseif(strtolower($category ?? '') === 'musik')
                                <img src="{{ asset('images/categories/musik.jpg') }}"
                                    class="w-full h-full object-cover opacity-80 mix-blend-screen" alt="musik" />
                            @else
                                <!-- Placeholder untuk kategori lainnya - tambahkan gambar sesuai nama kategori -->
                                <div
                                    class="w-full h-full bg-gradient-to-br from-purple-600/30 to-blue-600/30 flex items-center justify-center">
                                    <span class="text-gray-500 text-sm">{{ ucfirst($category ?? 'Kategori') }}</span>
                                </div>
                            @endif
                        </div>
                        <!-- Gold highlight overlay -->
                        <div class="absolute inset-0 rounded-full border border-purple-500/20"></div>
                    </div>

                    <!-- Decorative Text -->
                    <div class="absolute top-8 right-8 writing-vertical-rl text-[10px] text-gray-600 tracking-widest font-mono uppercase opacity-50 hidden md:block"
                        style="writing-mode: vertical-rl;">
                        Startups<br>Hackathon Bootcamp<br>AR/VR Product Design
                    </div>

                    <!-- Bottom Labels -->
                    <div class="absolute bottom-6 left-8 text-[10px] font-bold text-gray-600 uppercase tracking-widest">
                        Discover
                    </div>
                    <div class="absolute bottom-6 right-8 text-[10px] font-bold uppercase tracking-widest flex gap-1">
                        <span class="text-purple-500">Tech</span> <span class="text-gray-600">Events</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- Section: Major Upcoming Events -->
        <div class="mb-16">
            <h2 class="text-xl font-bold text-white mb-6">Acara Mendatang</h2>

            <div class="bg-[#26212c] rounded-2xl border border-[#3a3442] overflow-hidden">
                @if(count($events) > 0)
                    @foreach($events->groupBy('month_name') as $month => $monthEvents)
                        <!-- Month Label -->
                        <div class="px-6 py-4 border-b border-[#3a3442] flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                            <span class="text-sm font-medium text-gray-400">{{ $month }}</span>
                        </div>

                        @foreach($monthEvents as $item)
                            <!-- Event Item -->
                            <a href="{{ route('events.show', $item['id']) }}"
                                class="flex flex-col md:flex-row items-center gap-6 px-6 py-5 hover:bg-[#2f2936] transition-colors group">
                                <!-- Logo/Image -->
                                <div
                                    class="w-12 h-12 rounded-lg bg-blue-900 text-blue-200 font-bold flex items-center justify-center shrink-0 overflow-hidden">
                                    @if($item['image'])
                                        <img src="{{ $item['image'] }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($item['title'], 0, 3) }}
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-white font-bold text-base truncate">{{ $item['title'] }}</h3>
                                    <div class="text-gray-500 text-sm mt-0.5">{{ $item['location'] }}</div>
                                </div>

                                <!-- Date -->
                                <div class="text-right hidden md:block shrink-0 w-24">
                                    <div class="text-gray-400 text-sm font-mono">{{ $item['date'] }}</div>
                                </div>

                                <!-- Arrow -->
                                <div class="text-gray-600 group-hover:text-white transition-colors">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                @else
                    <div class="px-6 py-12 text-center text-gray-500">
                        <p>Belum ada acara mendatang untuk kategori ini.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Section: Nearby Events & Sidebar -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left: Nearby Events (Map Placeholder) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white">Acara Terdekat</h2>
                    <button
                        class="w-8 h-8 rounded-full bg-[#3a3442] text-gray-400 hover:text-white flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </div>

                <!-- Map Container -->
                <div
                    class="bg-black/40 rounded-3xl border border-[#3a3442] h-80 relative overflow-hidden flex flex-col items-center justify-center text-center p-6">
                    <!-- Dots Pattern Background -->
                    <div class="absolute inset-0 opacity-20"
                        style="background-image: radial-gradient(#4a4452 1px, transparent 1px); background-size: 20px 20px;">
                    </div>
                    <!-- Map Pins (Decorative) -->
                    <div class="absolute inset-0">
                        <i
                            class="fa-solid fa-location-dot text-[#3a3442] absolute top-1/4 left-1/4 text-2xl animate-pulse"></i>
                        <i class="fa-solid fa-location-dot text-[#3a3442] absolute bottom-1/3 right-1/3 text-xl"></i>
                        <i class="fa-solid fa-location-dot text-[#3a3442] absolute top-1/3 right-10 text-lg"></i>
                    </div>

                    <div class="relative z-10 max-w-sm mx-auto">
                        <h3 class="text-white font-bold mb-2">Tidak Ada Acara di Sekitar</h3>
                        <p class="text-gray-500 text-sm mb-6">
                            Saat ini tidak ada acara yang relevan di dekat Anda. Anda dapat menjelajahi semua acara di peta.
                        </p>
                        <button
                            class="bg-[#3a3442] hover:bg-[#2f2936] text-white px-5 py-2.5 rounded-full text-sm font-medium transition-colors border border-gray-600/50">
                            <i class="fa-solid fa-map mr-2"></i> Jelajahi Acara
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right: Category Sidebar (Simplified) -->
            <div class="space-y-6">
                <!-- Spacing Element to align with header height/margin if needed, or just standard flow -->
                <div class="h-10 hidden lg:block"></div>

                <div class="bg-transparent p-1">
                    <div
                        class="w-12 h-12 rounded-xl bg-orange-500/10 text-orange-500 border border-orange-500/20 flex items-center justify-center text-2xl mb-4">
                        <i class="fa-solid fa-microchip" x-show="category === 'Teknologi'"></i>
                        <i class="fa-solid fa-burger" x-show="category === 'Makanan'"></i>
                        <div x-show="category !== 'Teknologi' && category !== 'Makanan'">✨</div>
                    </div>

                    <h3 class="text-white font-bold text-lg mb-4" x-text="category"></h3>

                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Berlangganan untuk tetap mendapatkan informasi terbaru tentang acara, kalender, dan pembaruan
                        lainnya.
                    </p>
                </div>
            </div>

        </div>

    </div>
@endsection