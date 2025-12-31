@extends('layouts.app')

@section('title', ucfirst($city ?? 'Kota'))

<!-- bungkus utama halaman kota, pake state buat tab aktif -->
<div class="relative min-h-screen bg-[#1a161f]" x-data="{ activeTab: 'events' }">

    <!-- bagian atas (hero) yang ada foto background kotanya -->
    <div class="relative h-[500px] w-full overflow-hidden">
        <!-- foto background dari unsplash -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1508009603885-50cf7c579365?q=80&w=2548&auto=format&fit=crop');">
            <div class="absolute inset-0 bg-gradient-to-b from-[#1a161f]/30 via-[#1a161f]/60 to-[#1a161f]"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-6xl mx-auto px-6 h-full flex flex-col justify-center pt-20">
            <!-- Icon -->
            <div class="w-16 h-16 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center mb-6 border border-white/20">
                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>

            <div class="text-gray-300 text-lg font-medium mb-2">Apa yang Terjadi di</div>
            <h1 class="text-6xl font-black text-white mb-4 tracking-tight">{{ ucfirst($city) }}</h1>
            
            <div class="flex items-center gap-2 text-gray-300 font-mono text-sm mb-8">
                <i class="fa-regular fa-clock"></i>
                <span x-text="new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'}) + ' GMT+7'"></span>
            </div>

            <p class="text-gray-300 max-w-2xl text-lg leading-relaxed mb-8 drop-shadow-md">
                Di {{ ucfirst($city) }}, acara-acara mulai dari konferensi inovasi hingga sesi co-working dan pertemuan untuk para penggemar teknologi, menarik para profesional dan inovator dari berbagai industri untuk bersama-sama membentuk masa depan.
            </p>

            <button class="bg-white text-black font-bold px-8 py-3 rounded-full hover:bg-gray-200 transition-colors w-fit">
                Berlangganan
            </button>
        </div>
    </div>

    <!-- area isi utama -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        
        <!-- header buat daftar acaranya -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white">Acara</h2>
            <div class="flex gap-2">
                <!-- Tombol buat user kalau mau nambahin acara sendiri -->
                <button class="bg-[#26212c] hover:bg-[#2f2936] text-white px-4 py-2 rounded-lg border border-[#3a3442] flex items-center gap-2 text-sm font-medium transition-colors">
                    <i class="fa-solid fa-plus"></i> Kirim Acara
                </button>
                <button class="bg-[#26212c] hover:bg-[#2f2936] text-gray-400 hover:text-white w-10 h-10 rounded-lg border border-[#3a3442] flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-rss"></i>
                </button>
                <button class="bg-[#26212c] hover:bg-[#2f2936] text-gray-400 hover:text-white w-10 h-10 rounded-lg border border-[#3a3442] flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- events list (left column) -->
            <div class="lg:col-span-2 space-y-8">
                @if(count($events) > 0)
                    @foreach($events as $event)
                        <!-- kartu satuan buat setiap acara -->
                        <a href="{{ route('events.show', $event['id']) }}" class="bg-[#26212c] rounded-2xl border border-[#3a3442] p-5 hover:bg-[#2f2936] transition-all cursor-pointer group flex gap-5">
                            <div class="flex-1">
                                <div class="text-gray-500 text-xs font-bold mb-1">{{ $event['time'] }}</div>
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">{{ $event['title'] }}</h3>
                                
                                <div class="flex items-center gap-2 mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($event['organizer']) }}&background=random" class="w-5 h-5 rounded-full">
                                    <span class="text-gray-400 text-sm">Oleh <span class="text-gray-300">{{ $event['organizer'] }}</span></span>
                                </div>

                                <div class="text-gray-500 text-sm flex items-center gap-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $event['location'] }}
                                </div>
                                <div class="text-gray-500 text-[10px] mt-2 italic">
                                    {{ $event['date'] }}
                                </div>
                            </div>

                            <!-- foto thumbnail acaranya, kalau ngga ada dikasih icon default -->
                            <div class="w-32 h-32 rounded-xl bg-cover bg-center shrink-0 border border-[#3a3442] overflow-hidden">
                                @if($event['image'])
                                    <img src="{{ $event['image'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-[#1a161f] flex items-center justify-center">
                                        <i class="fa-solid fa-image text-gray-800 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="py-20 text-center">
                        <div class="text-5xl mb-6">🏜️</div>
                        <h3 class="text-xl font-bold text-white mb-2">Belum Ada Acara</h3>
                        <p class="text-gray-500">Tidak ada acara mendatang di {{ ucfirst($city) }} saat ini.</p>
                    </div>
                @endif
            </div>

             <!-- sidebar (kolom kanan) -->
            <div class="space-y-6">
                <!-- info card -->
                <div class="bg-transparent">
                    <div class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ ucfirst($city) }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Temukan acara terpanas di {{ ucfirst($city) }}, dan dapatkan pemberitahuan tentang acara baru sebelum tiketnya habis terjual.
                    </p>
                    <button class="w-full bg-white text-black font-bold py-2.5 rounded-full hover:bg-gray-200 transition-colors">
                        Berlangganan
                    </button>
                </div>

                <!-- widget peta (cuma placeholder/gambar aja) -->
                <div class="w-full aspect-square rounded-2xl bg-[#26212c] border border-[#3a3442] overflow-hidden relative group cursor-pointer">
                    <!-- ini pake mapbox static API buat gambarnya -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-50 contrast-125 grayscale-[50%]" style="background-image: url('https://api.mapbox.com/styles/v1/mapbox/dark-v10/static/100.5018,13.7563,12,0/600x600?access_token=Pk.xxx'); background-color: #242424;">
                        <div class="w-full h-full opacity-30" style="background-image: radial-gradient(#4a4452 1px, transparent 1px); background-size: 20px 20px;"></div>
                    </div>
                    
                    <!-- Titik lokasi (pin) di peta -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-orange-500 rounded-full shadow-[0_0_20px_rgba(249,115,22,0.5)]"></div>
                    <div class="absolute top-1/3 left-1/3 w-2 h-2 bg-gray-500 rounded-full"></div>
                    <div class="absolute bottom-1/3 right-1/4 w-2 h-2 bg-gray-500 rounded-full"></div>

                    <!-- Nama daerahnya -->
                    <div class="absolute top-4 left-4 text-gray-400 text-xs font-medium">Jakarta Pusat</div>
                    <div class="absolute top-1/2 left-1/2 mt-4 -ml-6 text-white text-sm font-bold shadow-black drop-shadow-md">Jakarta</div>
                    
                    <!-- Overlay buat tombol pas mouse diarahin ke peta -->
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full backdrop-blur-sm border border-white/20">Buka Peta</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
