<!-- dropdown notifikasi -->
<div class="relative" x-data="{ showNotifications: false }">
    <!-- tombol lonceng -->
    <button @click="showNotifications = !showNotifications"
        class="hover:text-white transition-colors relative block">
        <i class="fa-regular fa-bell text-lg"></i>
    </button>

    <!-- isi dropdown -->
    <div x-show="showNotifications" @click.away="showNotifications = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" 
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute right-0 mt-3 w-80 bg-[#1a161f] border border-[#3a3442] rounded-xl shadow-2xl z-[60]"
        style="display: none;">

        <!-- tampilan saat kosong -->
        <div class="py-12 px-8 text-center">
            <h3 class="text-white text-lg font-semibold mb-2">Masih Sepi di Sini</h3>
            <p class="text-textMuted text-sm leading-relaxed">Buat acara dan undang beberapa teman.</p>
        </div>
    </div>
</div>
