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
        class="relative w-full max-w-2xl bg-[#141414] border border-[#2d2d2d] rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] overflow-hidden"
        x-data="{
            query: '',
            results: [],
            isLoading: false,
            shortcuts: [
                { title: 'Buat Acara', icon: 'fa-solid fa-plus', url: '/create' },
                { title: 'Buka Beranda', icon: 'fa-solid fa-house', url: '/' },
                { title: 'Buka Kalender', icon: 'fa-regular fa-calendar-days', url: '/calendar' }
            ],
            calendars: [
                { title: 'Pribadi', color: 'bg-green-500', url: '/profile' }
            ],
            get filteredShortcuts() {
                if (this.query.length < 1) return this.shortcuts;
                return this.shortcuts.filter(s => s.title.toLowerCase().includes(this.query.toLowerCase()));
            },
            get filteredCalendars() {
                if (this.query.length < 1) return this.calendars;
                return this.calendars.filter(c => c.title.toLowerCase().includes(this.query.toLowerCase()));
            },
            async search() {
                if (this.query.length < 2) {
                    this.results = [];
                    return;
                }
                this.isLoading = true;
                try {
                    const response = await fetch(`/search?query=${this.query}`);
                    this.results = await response.json();
                } catch (error) {
                    console.error('Search failed:', error);
                } finally {
                    this.isLoading = false;
                }
            }
        }">

        <!-- Search/Shortcuts View -->
        <div>
            <!-- Search Input Area -->
            <div class="relative p-4 border-b border-[#2d2d2d]">
                <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-500"
                        :class="isLoading ? 'animate-pulse text-white' : ''"></i>
                </div>
                <input type="text" placeholder="Cari acara, kalender, dan lainnya..."
                    class="w-full bg-transparent pl-12 pr-4 py-2 text-lg text-white placeholder-gray-600 focus:outline-none"
                    x-model="query" @input.debounce.300ms="search" x-ref="searchInput"
                    @show-search.window="setTimeout(() => $refs.searchInput.focus(), 100)">
                <!-- Clear Button -->
                <button x-show="query.length > 0" @click="query = ''; results = []"
                    class="absolute inset-y-0 right-6 flex items-center text-gray-400 hover:text-white">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Results area -->
            <div class="max-h-[60vh] overflow-y-auto p-4 space-y-8 custom-scrollbar">

                <!-- Search Results (Events) -->
                <div x-show="results.length > 0">
                    <h3 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-4 px-2">Acara</h3>
                    <div class="space-y-1">
                        <template x-for="event in results" :key="event.id">
                            <a :href="`/events/${event.id}`"
                                class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-all">
                                <div class="w-12 h-12 rounded-lg bg-[#2d2d2d] overflow-hidden flex-shrink-0">
                                    <template x-if="event.image">
                                        <img :src="event.image" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!event.image">
                                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                                            <i class="fa-regular fa-image"></i>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-gray-200 group-hover:text-white font-medium truncate"
                                        x-text="event.title"></h4>
                                    <p class="text-xs text-gray-500 truncate">
                                        <span x-text="event.date"></span> • <span x-text="event.location"></span>
                                    </p>
                                </div>
                                <i
                                    class="fa-solid fa-chevron-right text-xs text-gray-600 group-hover:text-white opacity-0 group-hover:opacity-100 transition-all"></i>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- Shortcuts Section -->
                <div x-show="filteredShortcuts.length > 0">
                    <h3 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-4 px-2 opacity-60">
                        Pintasan</h3>
                    <div class="space-y-1">
                        <template x-for="shortcut in filteredShortcuts" :key="shortcut.title">
                            <a :href="shortcut.url"
                                class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-all">
                                <div class="w-5 h-5 flex items-center justify-center">
                                    <i :class="shortcut.icon"
                                        class="text-gray-400 group-hover:text-white transition-colors"></i>
                                </div>
                                <span class="text-gray-300 group-hover:text-white font-medium"
                                    x-text="shortcut.title"></span>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- Calendars Section -->
                <div x-show="filteredCalendars.length > 0">
                    <h3 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-4 px-2 opacity-60">
                        Kalender</h3>
                    <div class="space-y-1">
                        <template x-for="calendar in filteredCalendars" :key="calendar.title">
                            <a :href="calendar.url"
                                class="flex items-center gap-4 px-3 py-3 rounded-xl hover:bg-[#1e1e1e] group transition-all">
                                <div class="w-6 h-6 rounded-lg flex items-center justify-center"
                                    :class="calendar.color + '/20'">
                                    <span class="w-2 h-2 rounded-full" :class="calendar.color"></span>
                                </div>
                                <span class="text-gray-300 group-hover:text-white font-medium"
                                    x-text="calendar.title"></span>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- Empty State -->
                <div x-show="query.length >= 2 && results.length === 0 && filteredShortcuts.length === 0 && filteredCalendars.length === 0"
                    class="py-12 text-center">
                    <p class="text-gray-500 text-sm font-medium">Tidak ada hasil ditemukan untuk "<span
                            class="text-gray-300" x-text="query"></span>"</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>