<!-- ================= SEARCH OVERLAY ================= -->
<div x-show="searchOpen" @keydown.window.escape="searchOpen = false"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[100] flex items-start justify-center pt-24 px-4 sm:px-6" x-cloak>
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-[#0a0a0a]/80 backdrop-blur-sm" @click="searchOpen = false"></div>

    <!-- Modal Content -->
    <div x-show="searchOpen" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95 translate-y-[-20px]"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="relative w-full max-w-2xl bg-[#141414] border border-[#2d2d2d] rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] overflow-hidden">

        <!-- Search/Shortcuts View -->
        <div>
            <!-- Search Input Area -->
            <div class="relative p-4 border-b border-[#2d2d2d]">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                </div>
                <input type="text" placeholder="Cari acara, kalender, dan lainnya..."
                    class="w-full bg-transparent pl-12 pr-4 py-2 text-lg text-white placeholder-gray-600 focus:outline-none"
                    x-ref="searchInput" @show-search.window="setTimeout(() => $refs.searchInput.focus(), 100)">
            </div>

            <!-- Results area -->
            <div class="max-h-[60vh] overflow-y-auto p-4 space-y-8 custom-scrollbar">
                <!-- Shortcuts Section -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Pintasan</h3>
                    <div class="space-y-1">
                        <a href="/create"
                            class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-colors">
                            <i class="fa-solid fa-plus text-gray-400 group-hover:text-white"></i>
                            <span class="text-gray-300 group-hover:text-white font-medium">Buat Acara</span>
                        </a>
                        <a href="/"
                            class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-colors">
                            <i class="fa-solid fa-house text-gray-400 group-hover:text-white"></i>
                            <span class="text-gray-300 group-hover:text-white font-medium">Buka Beranda</span>
                        </a>
                        <a href="/calendar"
                            class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-colors">
                            <i class="fa-regular fa-calendar-days text-gray-400 group-hover:text-white"></i>
                            <span class="text-gray-300 group-hover:text-white font-medium">Buka Kalender</span>
                        </a>
                        <a href="/help"
                            class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-colors">
                            <i class="fa-regular fa-circle-question text-gray-400 group-hover:text-white"></i>
                            <span class="text-gray-300 group-hover:text-white font-medium">Buka Bantuan</span>
                            <i
                                class="fa-solid fa-arrow-right -rotate-45 ml-auto text-xs text-gray-600 group-hover:text-gray-400"></i>
                        </a>
                    </div>
                </div>

                <!-- Calendars Section -->
                <div>
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4 px-2">Kalender</h3>
                    <div class="space-y-1">
                        <a href="/profile"
                            class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-colors">
                            <div class="w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                            </div>
                            <span class="text-gray-300 group-hover:text-white font-medium">Personal</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>