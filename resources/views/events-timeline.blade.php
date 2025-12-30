<div
    class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-800 before:to-transparent">
    @foreach($events as $event)
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
            <!-- Icon -->
            <div
                class="flex items-center justify-center w-10 h-10 rounded-full border border-[#3a3442] bg-[#1a161f] text-gray-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                <i class="fa-solid fa-check text-xs"></i>
            </div>
            <!-- Content -->
            <div
                class="w-[calc(100%-4rem)] md:w-[45%] bg-[#26212c] p-6 rounded-2xl border border-[#3a3442] shadow-xl group-hover:border-gray-700 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-gray-500">{{ $event['date'] }}</span>
                </div>
                <h3 class="text-lg font-bold text-white mb-1">{{ $event['title'] }}</h3>
                <div class="text-gray-400 text-sm flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-xs text-gray-600"></i>
                    {{ $event['location'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>