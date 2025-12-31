<div class="space-y-8">
    @foreach($events as $event)
        <div
            class="bg-[#26212c] p-6 rounded-3xl border border-[#3a3442] text-gray-200 shadow-2xl flex flex-col md:flex-row gap-6 max-w-4xl mx-auto group hover:border-[#4d4554] transition-all">
            <!-- Left Column: Poster & Host -->
            <div class="flex flex-col gap-4 w-full md:w-1/3">
                <!-- Event Poster -->
                <div
                    class="aspect-square rounded-2xl flex flex-col justify-center items-center relative overflow-hidden select-none {{ $event['image'] ? 'bg-gray-800' : 'bg-[#F5E625] p-6 text-black' }}">
                    @if($event['image'])
                        <img src="{{ $event['image'] }}"
                            class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <h2 class="text-5xl font-black leading-[0.85] tracking-tighter mix-blend-multiply mb-auto"
                            style="font-family: sans-serif;">
                            KAMU<br>MASUK<br>DAFTAR<br>TAMU*
                        </h2>
                        <div class="absolute bottom-6 right-6 text-2xl font-black leading-none tracking-tighter rotate-[-5deg] text-right"
                            style="font-family: sans-serif;">
                            *BETAPA<br>BERUNTUNGNYA<br>KAMU
                        </div>
                    @endif
                </div>

                <!-- Host Info -->
                <div class="flex flex-col gap-1">
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Diselenggarakan Oleh</span>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-emerald-400 flex items-center justify-center overflow-hidden">
                            <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-600"></div>
                        </div>
                        <span class="font-bold text-white text-sm">{{ $event['organizer'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="flex-1 flex flex-col gap-4">
                <!-- Header -->
                <div class="flex justify-between items-start">
                    <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                            <span
                                class="bg-[#3a2a4b] text-[#d4b3eb] px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1.5 border border-[#4d3664]">
                                @if($event['requires_approval'])
                                    <i class="fa-solid fa-lock text-[10px]"></i> Butuh Persetujuan
                                @else
                                    <i class="fa-solid fa-globe text-[10px]"></i> Acara Publik
                                @endif
                            </span>
                        </div>
                        <h1 class="text-4xl font-bold text-white tracking-tight mt-1 leading-tight">{{ $event['title'] }}
                        </h1>
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="space-y-3">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-[#332d3b] flex flex-col items-center justify-center text-gray-400 shrink-0 border border-[#3f384a]">
                            <span
                                class="text-[10px] font-bold uppercase leading-none mb-0.5">{{ $event['start_month'] }}</span>
                            <span class="text-lg font-bold text-white leading-none">{{ $event['start_day'] }}</span>
                        </div>
                        <div>
                            <div class="font-bold text-white text-md">{{ $event['date'] }}</div>
                            <div class="text-gray-400 text-sm">Bergabunglah dengan komunitas untuk acara ini</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="w-12 h-12 rounded-xl bg-[#332d3b] flex items-center justify-center text-gray-400 shrink-0 border border-[#3f384a]">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div class="font-bold text-white text-md flex items-center gap-2">
                                {{ $event['location'] }}
                            </div>
                        </div>
                    </div>
                </div>

                @if($event['requires_approval'])
                    <!-- Registration Status -->
                    <div class="bg-[#332d3b] rounded-2xl p-3 border border-[#3f384a]">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-[#4a4253] flex items-center justify-center text-gray-300 shrink-0">
                                <i class="fa-solid fa-user-check text-xs"></i>
                            </div>
                            <div>
                                <div class="font-bold text-white text-sm mb-0.5">Butuh Persetujuan</div>
                                <div class="text-gray-400 text-xs leading-relaxed">Pendaftaran Anda memerlukan persetujuan tuan rumah.</div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="h-px bg-[#3f384a] my-2"></div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga:</span>
                        <span
                            class="text-sm font-bold text-pink-500">{{ $event['price'] > 0 ? 'Rp ' . number_format($event['price'], 0, ',', '.') : 'GRATIS' }}</span>
                    </div>
                    <a href="{{ route('events.show', $event['id']) }}"
                        class="flex items-center gap-2 bg-white hover:bg-gray-200 text-black px-6 py-2 rounded-xl transition-all font-bold text-sm shadow-lg">
                        <i class="fa-solid fa-ticket"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>