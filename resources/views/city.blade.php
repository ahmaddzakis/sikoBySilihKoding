@extends('layouts.app')

@section('title', ucfirst($city ?? 'Kota'))

@section('content')
<div class="relative min-h-screen bg-[#1a161f]" x-data="{ activeTab: 'events' }">

    <!-- Hero Section with Background Image -->
    <div class="relative h-[500px] w-full overflow-hidden">
        <!-- Background Image (Blurred) -->
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

    <!-- Main Content Area -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        
        <!-- Header Controls -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-white">Acara</h2>
            <div class="flex gap-2">
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
            
            <!-- Events List (Left Column) -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Today -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                        <span class="text-white font-bold">Hari ini</span>
                        <span class="text-gray-500">Minggu</span>
                    </div>

                    <!-- Event Card -->
                    <div class="bg-[#26212c] rounded-2xl border border-[#3a3442] p-5 hover:bg-[#2f2936] transition-all cursor-pointer group flex gap-5">
                        <!-- Date/Time Column can go here if needed layout diff -->
                        <div class="flex-1">
                            <div class="text-orange-500 text-xs font-bold uppercase tracking-wider mb-1 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                                LIVE 16.30
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">Goodie Oldie Thai Woodie 2025</h3>
                            
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex -space-x-2">
                                    <div class="w-5 h-5 rounded-full bg-pink-500 border border-[#26212c]"></div>
                                    <div class="w-5 h-5 rounded-full bg-blue-500 border border-[#26212c]"></div>
                                </div>
                                <span class="text-gray-400 text-sm">Oleh <span class="text-gray-300">welove, ชัยรัตน์, dkk...</span></span>
                            </div>

                            <div class="text-gray-500 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i>
                                ChangChui Creative Park
                            </div>
                            
                            <div class="mt-4 flex -space-x-2">
                                <img src="https://ui-avatars.com/api/?name=A&background=random" class="w-6 h-6 rounded-full border border-[#26212c]">
                                <img src="https://ui-avatars.com/api/?name=B&background=random" class="w-6 h-6 rounded-full border border-[#26212c]">
                                <img src="https://ui-avatars.com/api/?name=C&background=random" class="w-6 h-6 rounded-full border border-[#26212c]">
                                <div class="w-6 h-6 rounded-full bg-[#3a3442] border border-[#26212c] text-[9px] text-gray-300 flex items-center justify-center">+85</div>
                            </div>
                        </div>

                        <!-- Thumbnail -->
                        <div class="w-32 h-32 rounded-xl bg-cover bg-center shrink-0 border border-[#3a3442]" style="background-image: url('https://images.unsplash.com/photo-1543002588-bfa74002ed7e?q=80&w=2574&auto=format&fit=crop');">
                            <div class="w-full h-full bg-black/20 group-hover:bg-transparent transition-colors"></div>
                        </div>
                    </div>
                </div>

                <!-- Tomorrow -->
                <div>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                        <span class="text-white font-bold">Besok</span>
                        <span class="text-gray-500">Senin</span>
                    </div>

                    <!-- Event Card 2 -->
                    <div class="bg-[#26212c] rounded-2xl border border-[#3a3442] p-5 hover:bg-[#2f2936] transition-all cursor-pointer group flex gap-5">
                        <div class="flex-1">
                            <div class="text-gray-500 text-xs font-bold mb-1">18.30</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">Satoshi Square Monday #608</h3>
                            
                            <div class="flex items-center gap-2 mb-3">
                                <img src="https://ui-avatars.com/api/?name=S&background=random" class="w-5 h-5 rounded-full">
                                <span class="text-gray-400 text-sm">Oleh <span class="text-gray-300">Sean</span></span>
                            </div>

                            <div class="text-gray-500 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i>
                                CRAFT (Sukhumvit 23)
                            </div>
                        </div>
                        <div class="w-32 h-32 rounded-xl bg-cover bg-center shrink-0 border border-[#3a3442]" style="background-image: url('https://images.unsplash.com/photo-1518546305927-5a555bb7020d?q=80&w=2669&auto=format&fit=crop');"></div>
                    </div>
                </div>

                 <!-- Future Date -->
                <div>
                     <div class="flex items-center gap-2 mb-6">
                        <div class="w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                        <span class="text-white font-bold">24 Des</span>
                        <span class="text-gray-500">Rabu</span>
                    </div>

                    <!-- Event Card 3 -->
                    <div class="bg-[#26212c] rounded-2xl border border-[#3a3442] p-5 hover:bg-[#2f2936] transition-all cursor-pointer group flex gap-5">
                         <div class="flex-1">
                            <div class="text-gray-500 text-xs font-bold mb-1">18.00</div>
                            <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors">Boardgame Night with Uniswap and TP Squad</h3>
                             <div class="flex items-center gap-2 mb-3">
                                <img src="https://ui-avatars.com/api/?name=TP&background=random" class="w-5 h-5 rounded-full">
                                <span class="text-gray-400 text-sm">Oleh <span class="text-gray-300">TPSquad | TH & Gun | Uniswap</span></span>
                            </div>
                            <div class="text-gray-500 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-location-dot"></i>
                                Krung Thep Maha Nakhon
                            </div>
                            <div class="mt-4 flex -space-x-2">
                                <div class="w-6 h-6 rounded-full bg-[#3a3442] border border-[#26212c] text-[9px] text-gray-300 flex items-center justify-center">+22</div>
                            </div>
                        </div>
                         <div class="w-32 h-32 rounded-xl bg-cover bg-center shrink-0 border border-[#3a3442]" style="background-image: url('https://images.unsplash.com/photo-1610890716271-e21f35b8705b?q=80&w=2670&auto=format&fit=crop');"></div>
                    </div>
                </div>

            </div>

             <!-- Sidebar (Right Column) -->
            <div class="space-y-6">
                <!-- Info Card -->
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

                <!-- Map Widget -->
                <div class="w-full aspect-square rounded-2xl bg-[#26212c] border border-[#3a3442] overflow-hidden relative group cursor-pointer">
                    <!-- Map Image Placeholder -->
                    <div class="absolute inset-0 bg-cover bg-center opacity-50 contrast-125 grayscale-[50%]" style="background-image: url('https://api.mapbox.com/styles/v1/mapbox/dark-v10/static/100.5018,13.7563,12,0/600x600?access_token=Pk.xxx'); background-color: #242424;">
                        <!-- Using a generic dark map pattern via CSS if image fails -->
                        <div class="w-full h-full opacity-30" style="background-image: radial-gradient(#4a4452 1px, transparent 1px); background-size: 20px 20px;"></div>
                    </div>
                    
                    <!-- Pins -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-orange-500 rounded-full shadow-[0_0_20px_rgba(249,115,22,0.5)]"></div>
                    <div class="absolute top-1/3 left-1/3 w-2 h-2 bg-gray-500 rounded-full"></div>
                    <div class="absolute bottom-1/3 right-1/4 w-2 h-2 bg-gray-500 rounded-full"></div>

                    <!-- Labels based on screenshot -->
                    <div class="absolute top-4 left-4 text-gray-400 text-xs font-medium">Nonthaburi</div>
                    <div class="absolute top-1/2 left-1/2 mt-4 -ml-6 text-white text-sm font-bold shadow-black drop-shadow-md">Bangkok</div>
                    
                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full backdrop-blur-sm border border-white/20">Buka Peta</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
