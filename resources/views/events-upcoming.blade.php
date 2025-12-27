<!-- TAMPILAN GRID UNTUK ACARA MENDATANG -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($events as $event)
        <div class="bg-[#26212c]/40 rounded-3xl overflow-hidden border border-[#3a3442] hover:border-gray-600 transition-all group">
            <div class="h-56 bg-[#1a161f] relative overflow-hidden">
                <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-white border border-white/10 uppercase">
                    {{ $event['attendees'] }} Peserta
                </div>
            </div>
            <div class="p-8">
                <div class="text-[10px] font-black text-purple-400 mb-2 uppercase tracking-[0.2em]">{{ $event['date'] }}</div>
                <h3 class="text-2xl font-bold text-white mb-3 leading-tight">{{ $event['title'] }}</h3>
                <div class="flex items-center text-gray-500 text-xs mb-6">
                    <i class="fa-solid fa-location-dot mr-2"></i>
                    <span>{{ $event['location'] }}</span>
                </div>
                <button class="w-full py-3 bg-[#3a3442]/50 hover:bg-[#3a3442] text-white rounded-2xl text-sm font-bold transition-all border border-[#3a3442]">
                    Lihat Detail
                </button>
            </div>
        </div>
    @endforeach
</div>
