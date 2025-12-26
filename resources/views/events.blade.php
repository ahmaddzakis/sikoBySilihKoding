@section('title', 'Acara')

<div class="max-w-6xl mx-auto px-6 py-8">
    <!-- Header & Toggle -->
    <div class="flex justify-between items-center mb-12">
        <h1 class="text-3xl font-bold text-white">Acara</h1>

        <!-- Toggle Switch -->
        <div class="bg-[#26212c] p-1 rounded-lg border border-[#3a3442] flex text-sm">
            <button wire:click="setTab('upcoming')"
                class="px-4 py-1.5 rounded-md transition-all font-medium {{ $activeTab === 'upcoming' ? 'bg-[#3a3442] text-white shadow-sm' : 'text-gray-400 hover:text-gray-200' }}">
                Akan Datang
            </button>
            <button wire:click="setTab('past')"
                class="px-4 py-1.5 rounded-md transition-all font-medium {{ $activeTab === 'past' ? 'bg-[#3a3442] text-white shadow-sm' : 'text-gray-400 hover:text-gray-200' }}">
                Selesai
            </button>
        </div>
    </div>

    <!-- Empty State Container -->
    <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
        <!-- Icon -->
        <div
            class="w-24 h-24 bg-[#26212c] rounded-2xl flex items-center justify-center mb-6 relative border border-[#3a3442]">
            <i class="fa-regular fa-calendar text-4xl text-gray-600"></i>
            <!-- Notification Badge Style -->
            <div
                class="absolute -top-2 -right-2 w-8 h-8 bg-[#3a3442] rounded-full flex items-center justify-center border-4 border-[#1a161f] text-gray-400 font-bold text-sm">
                0
            </div>
            <!-- Decorative Elements simulating the card UI in image -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-4 left-4 w-8 h-2 bg-gray-500 rounded-full"></div>
                <div class="absolute top-8 left-4 w-12 h-2 bg-gray-500 rounded-full"></div>
                <div class="absolute bottom-4 right-4 w-6 h-6 bg-gray-500 rounded-md"></div>
            </div>
        </div>

        <!-- Text -->
        <h2 class="text-xl font-bold text-white mb-2">
            {{ $activeTab === 'upcoming' ? 'Tidak Ada Acara Akan Datang' : 'Tidak Ada Acara Selesai' }}
        </h2>
        <p class="text-gray-500 mb-8 max-w-md">
            {{ $activeTab === 'upcoming'
    ? 'Anda tidak memiliki acara yang akan datang. Mengapa tidak membuatnya satu?'
    : 'Anda belum mengikuti acara apapun yang telah selesai.' }}
        </p>

        <!-- Create Button -->
        <a href="/create"
            class="flex items-center gap-2 bg-[#2d2d30] hover:bg-[#3a3a3d] text-white px-5 py-2.5 rounded-lg transition-colors border border-[#3e3e42] font-medium text-sm">
            <i class="fa-solid fa-plus text-xs"></i>
            Buat Acara
        </a>
    </div>
</div>