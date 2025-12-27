<!-- TAMPILAN TIMELINE UNTUK ACARA SELESAI (LAMPAU) -->
<div class="relative space-y-12">
    <!-- Garis Vertikal Timeline -->
    <div class="absolute left-[138px] top-2 bottom-0 w-px border-l border-dashed border-[#3a3442] hidden md:block"></div>

    @foreach($events as $event)
        <div class="flex flex-col md:flex-row gap-8 relative">
            
            <!-- Kolom Tanggal (Kiri) -->
            <div class="w-32 flex-shrink-0 text-left md:text-right pt-1 mt-1 relative">
                <div class="text-white font-bold text-lg leading-tight">{{ $event['date'] }}</div>
                <div class="text-gray-500 text-sm">{{ $event['day'] }}</div>
                
                <!-- Titik Indikator di Garis Timeline -->
                <div class="absolute -right-[13px] top-3 w-2.5 h-2.5 rounded-full bg-[#3a3442] border-4 border-[#1a161f] hidden md:block z-10"></div>
            </div>

            <!-- Kartu Acara (Kanan) -->
            <div class="flex-grow bg-[#26212c]/40 border border-[#3a3442] rounded-2xl p-6 hover:bg-[#26212c]/60 transition-all group flex justify-between items-start gap-6">
                
                <!-- Detail Teks -->
                <div class="flex-grow">
                    <div class="text-gray-500 text-[15px] font-medium mb-2">{{ $event['time'] }}</div>
                    <h3 class="text-2xl font-bold text-white mb-4">{{ $event['title'] }}</h3>
                    
                    <div class="space-y-2 mb-6">
                        <!-- Lokasi -->
                        <div class="flex items-center gap-2 text-[15px]">
                            @if(isset($event['location_type']) && $event['location_type'] === 'alert')
                                <i class="fa-solid fa-triangle-exclamation text-yellow-500/80 text-sm"></i>
                                <span class="text-yellow-500/80 font-medium">{{ $event['location'] }}</span>
                            @else
                                <i class="fa-solid fa-video text-gray-400 text-sm"></i>
                                <span class="text-gray-300 font-medium">{{ $event['location'] }}</span>
                            @endif
                        </div>
                        <!-- Peserta -->
                        <div class="flex items-center gap-2 text-gray-500 text-[15px]">
                            <i class="fa-solid fa-user-group text-sm"></i>
                            <span class="font-medium">{{ $event['attendees'] }}</span>
                        </div>
                    </div>

                    <!-- Tombol Kelola & Avatar -->
                    <div class="flex items-center gap-3">
                        <button class="bg-[#3a3442]/50 hover:bg-[#3a3442] text-white text-sm font-bold px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                            Kelola Acara
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>

                        @if(!empty($event['avatars']))
                            <div class="flex -space-x-2 ml-1">
                                @foreach($event['avatars'] as $avatar)
                                    <img src="{{ $avatar }}" class="w-6 h-6 rounded-full border-2 border-[#1a161f]">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Gambar Acara -->
                <div class="w-32 h-32 rounded-xl overflow-hidden flex-shrink-0 border border-[#3a3442]">
                    <img src="{{ $event['image'] }}" class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                </div>

            </div>
        </div>
    @endforeach
</div>
