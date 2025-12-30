@extends('layouts.app')

@section('title', 'Buat Acara')

@section('content')
    <div class="max-w-6xl mx-auto px-6 py-6" x-data="eventForm()">

        <!-- Konten Utama -->
        <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-[400px_1fr] gap-12 lg:gap-20">
            @csrf

            <!-- Sisi Kiri: Preview dan Upload Gambar -->
            <div class="flex flex-col gap-5" x-data="{ imagePreview: null }">
                <!-- Wrapper Gambar: Menggunakan aspect-square agar tetap kotak -->
                <div
                    class="relative aspect-square w-full rounded-3xl overflow-hidden border border-[#3a3442] shadow-2xl shadow-black/50">
                    <img :src="imagePreview || '{{ asset('images/invite.jpg') }}'" class="w-full h-full object-cover">

                    <!-- Tombol Upload  -->
                    <label for="imageUpload"
                        class="absolute bottom-4 right-4 cursor-pointer bg-[#26212c]/90 hover:bg-[#2f2936] backdrop-blur-sm border border-[#3a3442] rounded-full p-3 flex items-center justify-center transition-all shadow-lg">
                        <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </label>
                    <input type="file" id="imageUpload" name="image" accept="image/*" class="hidden"
                        @change="const file = $event.target.files[0]; if(file) { const reader = new FileReader(); reader.onload = (e) => imagePreview = e.target.result; reader.readAsDataURL(file); }">
                </div>
            </div>

            <!-- Sisi Kanan: Form Detail Acara -->
            <div class="flex flex-col gap-6">

                <!-- Pilihan Visibilitas (Publik/Pribadi) -->
                <div class="flex justify-between items-start mb-2">
                    <div class="flex gap-3">
                        <div x-data="{ open: false }" class="relative">
                            <button type="button" @click="open = !open" @click.outside="open = false"
                                class="bg-[#26212c] hover:bg-[#2f2936] text-gray-300 text-xs font-medium px-3 py-1.5 rounded-lg border border-[#3a3442] flex items-center gap-2 transition-colors">
                                <div class="w-2 h-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-500"></div>
                                <span x-text="categoryName || 'Pilih Kategori'"></span>
                                <svg class="w-3 h-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div x-show="open" x-transition
                                class="absolute top-full left-0 mt-2 w-48 bg-[#26212c] border border-[#3a3442] rounded-xl shadow-xl z-20 py-1">
                                @foreach($categories as $category)
                                    <button type="button"
                                        @click="categoryId = {{ $category->id }}; categoryName = '{{ $category->nama }}'; open = false"
                                        class="w-full text-left px-4 py-2 hover:bg-[#2f2936] text-sm text-gray-300">{{ $category->nama }}</button>
                                @endforeach
                            </div>
                            <input type="hidden" name="category_id" :value="categoryId">
                        </div>
                    </div>
                </div>

                <!-- Input Judul Acara: Menggunakan font besar dan transparan -->
                <input type="text" name="judul" x-model="eventName" placeholder="Nama Acara"
                    class="bg-transparent text-5xl font-bold w-full outline-none placeholder-[#545454] focus:placeholder-gray-700 text-white transition-all caret-purple-500">

                <!-- Pemilih Tanggal & Waktu -->
                <div class="flex flex-col md:flex-row gap-3 mt-2 overflow-visible relative z-10" x-data="datePicker()">

                    <!-- Kartu Input Tanggal -->
                    <div class="flex-1 bg-[#26212c] border border-[#3a3442] rounded-2xl p-2 relative">

                        <!-- Baris Mulai -->
                        <div class="flex items-center gap-4 p-2 relative">
                            <!-- Label -->
                            <div class="flex items-center gap-3 w-24 pl-2 relative z-10">
                                <span class="w-2.5 h-2.5 rounded-full border border-gray-500 bg-[#26212c]"></span>
                                <span class="text-[15px] font-medium text-gray-300">Mulai</span>
                            </div>

                            <!-- Inputs -->
                            <div class="flex gap-1 flex-1">
                                <div class="relative flex-1">
                                    <button type="button" @click="toggleCalendar('start')"
                                        class="w-full text-left bg-[#2f2936] hover:bg-[#383240] rounded-lg px-3 py-2 text-[15px] text-gray-200 font-medium transition-colors">
                                        <span x-text="formatDate(startDate)"></span>
                                    </button>

                                    <!-- Kalendar Popup -->
                                    <div x-show="openPicker === 'start'" @click.outside="openPicker = null" x-transition
                                        class="absolute top-full left-0 mt-2 bg-[#1a161f] border border-[#3a3442] rounded-xl shadow-2xl p-4 w-72 z-50">
                                        <div class="flex justify-between items-center mb-4">
                                            <button type="button" @click="prevMonth"
                                                class="text-gray-400 hover:text-white">&lt;</button>
                                            <span class="text-sm font-bold text-white"
                                                x-text="monthNames[currentMonth] + ' ' + currentYear"></span>
                                            <button type="button" @click="nextMonth"
                                                class="text-gray-400 hover:text-white">&gt;</button>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center mb-2">
                                            <template x-for="day in ['M','S','S','R','K','J','S']">
                                                <span class="text-xs text-gray-500 font-bold" x-text="day"></span>
                                            </template>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center">
                                            <template x-for="blank in blanks">
                                                <div class="h-8"></div>
                                            </template>
                                            <template x-for="date in days">
                                                <button type="button" @click="selectDate(date, 'start')"
                                                    class="h-8 w-8 rounded-full text-sm flex items-center justify-center hover:bg-[#2f2936] transition-colors"
                                                    :class="isToday(date) ? 'bg-purple-600 text-white hover:bg-purple-600' : 'text-gray-300'"
                                                    x-text="date"></button>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-24 relative">
                                    <button type="button"
                                        @click="openPicker = (openPicker === 'startTime' ? null : 'startTime')"
                                        class="w-full h-full bg-[#2f2936] hover:bg-[#383240] rounded-lg px-2 flex items-center justify-center text-[15px] text-gray-200 font-medium transition-colors">
                                        <span x-text="startTime"></span>
                                    </button>
                                    <!-- Waktu Dropdown -->
                                    <div x-show="openPicker === 'startTime'" @click.outside="openPicker = null" x-transition
                                        class="absolute top-full left-0 mt-2 w-32 bg-[#2d2833] border border-[#3a3442] rounded-xl shadow-xl max-h-60 overflow-y-auto z-50 py-1 scrollBar-hidden">
                                        <template x-for="time in timeSlots">
                                            <button type="button" @click="startTime = time; openPicker = null"
                                                class="w-full text-left px-4 py-2 hover:bg-[#2f2936] text-sm text-gray-300"
                                                :class="startTime === time ? 'bg-[#2f2936] text-white' : ''"
                                                x-text="time"></button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Selesai -->
                        <div class="flex items-center gap-4 p-2 relative z-10">
                            <!-- Label -->
                            <div class="flex items-center gap-3 w-24 pl-2">
                                <span class="w-2.5 h-2.5 rounded-full border border-gray-500 bg-[#26212c]"></span>
                                <span class="text-[15px] font-medium text-gray-300">Akhir</span>
                            </div>

                            <!-- Inputs -->
                            <div class="flex gap-1 flex-1">
                                <div class="relative flex-1">
                                    <button type="button" @click="toggleCalendar('end')"
                                        class="w-full text-left bg-[#2f2936] hover:bg-[#383240] rounded-lg px-3 py-2 text-[15px] text-gray-200 font-medium transition-colors">
                                        <span x-text="formatDate(endDate)"></span>
                                    </button>

                                    <!-- Kalendar Popup selesai -->
                                    <div x-show="openPicker === 'end'" @click.outside="openPicker = null" x-transition
                                        class="absolute top-full left-0 mt-2 bg-[#1a161f] border border-[#3a3442] rounded-xl shadow-2xl p-4 w-72 z-50">
                                        <div class="flex justify-between items-center mb-4">
                                            <button type="button" @click="prevMonth"
                                                class="text-gray-400 hover:text-white">&lt;</button>
                                            <span class="text-sm font-bold text-white"
                                                x-text="monthNames[currentMonth] + ' ' + currentYear"></span>
                                            <button type="button" @click="nextMonth"
                                                class="text-gray-400 hover:text-white">&gt;</button>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center mb-2">
                                            <template x-for="day in ['M','S','S','R','K','J','S']"><span
                                                    class="text-xs text-gray-500 font-bold" x-text="day"></span></template>
                                        </div>
                                        <div class="grid grid-cols-7 gap-1 text-center">
                                            <template x-for="blank in blanks">
                                                <div class="h-8"></div>
                                            </template>
                                            <template x-for="date in days">
                                                <button type="button" @click="selectDate(date, 'end')"
                                                    class="h-8 w-8 rounded-full text-sm flex items-center justify-center hover:bg-[#2f2936] transition-colors"
                                                    :class="isSameDate(date, 'end') ? 'bg-purple-600 text-white' : 'text-gray-300'"
                                                    x-text="date"></button>
                                            </template>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-24 relative">
                                    <button type="button"
                                        @click="openPicker = (openPicker === 'endTime' ? null : 'endTime')"
                                        class="w-full h-full bg-[#2f2936] hover:bg-[#383240] rounded-lg px-2 flex items-center justify-center text-[15px] text-gray-200 font-medium transition-colors">
                                        <span x-text="endTime"></span>
                                    </button>
                                    <!-- Dropdown Waktu -->
                                    <div x-show="openPicker === 'endTime'" @click.outside="openPicker = null" x-transition
                                        class="absolute top-full left-0 mt-2 w-32 bg-[#2d2833] border border-[#3a3442] rounded-xl shadow-xl max-h-60 overflow-y-auto z-50 py-1 scrollBar-hidden">
                                        <template x-for="time in timeSlots">
                                            <button type="button" @click="endTime = time; openPicker = null"
                                                class="w-full text-left px-4 py-2 hover:bg-[#2f2936] text-sm text-gray-300"
                                                :class="endTime === time ? 'bg-[#2f2936] text-white' : ''"
                                                x-text="time"></button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- Pemilih Lokasi (buka Modal) -->
                <div class="w-full bg-[#26212c] hover:bg-[#2f2936] transition-colors border border-[#3a3442] rounded-xl p-3.5 flex items-center gap-3 text-left group cursor-pointer"
                    @click="openLocationModal = true">
                    <div
                        class="w-8 h-8 flex-shrink-0 rounded-lg bg-[#3d2b20] group-hover:bg-[#4a3422] flex items-center justify-center text-gray-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-[15px] font-medium text-gray-200" x-text="location || 'Tambahkan Lokasi Acara'">
                        </div>
                        <div class="text-xs text-gray-500" x-show="!location">Lokasi offline</div>
                    </div>
                </div>

                <!-- Pemilih Deskripsi (buka Modal) -->
                <div class="w-full bg-[#26212c] hover:bg-[#2f2936] transition-colors border border-[#3a3442] rounded-xl p-3.5 flex items-start gap-3 text-left group cursor-pointer"
                    @click="openDescriptionModal = true">
                    <div
                        class="w-8 h-8 flex-shrink-0 rounded-lg bg-[#3d2b20] group-hover:bg-[#4a3422] flex items-center justify-center text-gray-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </div>
                    <div class="flex-grow flex items-center min-h-[32px]">
                        <span class="text-[15px] font-medium text-gray-200"
                            x-text="description || 'Tambahkan Deskripsi'"></span>
                    </div>
                </div>

                <!-- Bagian Opsi Tambahan -->
                <div class="mt-4">
                    <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Opsi Acara</h3>
                    <div class="bg-transparent space-y-1">

                        <!-- Pilihan Harga Tiket -->
                        <div class="flex justify-between items-center py-2.5 px-2 hover:bg-[#26212c] rounded-lg transition-colors cursor-pointer group"
                            @click="tempTicketPrice = ticketPrice; openTicketModal = true">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-200" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                <span class="text-[15px] text-gray-300 font-medium">Harga Tiket</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-gray-400"
                                        x-text="ticketPrice ? (isNaN(ticketPrice) ? ticketPrice : 'Rp ' + Number(ticketPrice).toLocaleString('id-ID')) : 'Gratis'"></span>
                                    <svg class="w-3 h-3 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Memerlukan Persetujuan -->
                        <div class="flex justify-between items-center py-2.5 px-2 hover:bg-[#26212c] rounded-lg transition-colors cursor-pointer group"
                            @click="requiresApproval = !requiresApproval">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-200" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="text-[15px] text-gray-300 font-medium">Memerlukan Persetujuan</span>
                            </div>
                            <div class="w-9 h-5 rounded-full relative transition-colors"
                                :class="requiresApproval ? 'bg-purple-600' : 'bg-[#3a3442]'">
                                <div class="absolute left-1 top-1 w-3 h-3 bg-white rounded-full transition-all"
                                    :class="requiresApproval ? 'translate-x-4' : 'translate-x-0'"></div>
                            </div>
                        </div>

                        <!-- Pilihan Kapasitas -->
                        <div class="flex justify-between items-center py-2.5 px-2 hover:bg-[#26212c] rounded-lg transition-colors cursor-pointer group"
                            @click="tempCapacityLimit = capacityLimit; openCapacityModal = true">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-200" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <span class="text-[15px] text-gray-300 font-medium">Kapasitas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-gray-400"
                                        x-text="capacityLimit ? capacityLimit : 'Tak terbatas'"></span>
                                    <svg class="w-3 h-3 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Inputs for Form Submission -->
                <input type="hidden" name="description" :value="description">
                <input type="hidden" name="lokasi" :value="location">
                <input type="hidden" name="waktu_mulai" :value="formatISO(startDate, startTime)">
                <input type="hidden" name="waktu_selesai" :value="formatISO(endDate, endTime)">
                <input type="hidden" name="harga_tiket" :value="ticketPrice">
                <input type="hidden" name="kapasitas" :value="capacityLimit">
                <input type="hidden" name="requires_approval" :value="requiresApproval ? 1 : 0">

                <!-- Tombol Submit Akhir -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-white hover:bg-gray-200 text-black font-bold text-lg py-3.5 rounded-xl transition-all transform active:scale-[0.98] shadow-lg">
                        Buat Acara
                    </button>
                </div>

            </div>
        </form>

        <!-- Modal Kapasitas -->
        <div x-show="openCapacityModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-transition.opacity>
            <div @click.outside="openCapacityModal = false"
                class="bg-[#1a161f] border border-[#3a3442] w-[400px] rounded-2xl p-6 shadow-2xl transform transition-all"
                x-transition.scale>
                <!-- Icon Header -->
                <div
                    class="w-12 h-12 rounded-full bg-[#26212c] border border-[#3a3442] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Kapasitas Maksimal</h2>
                <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                    Tutup pendaftaran saat mencapai kapasitas.<br>
                    Hanya tamu yang disetujui yang dihitung.
                </p>
                <!-- Input Angka dengan Validasi Tailwind -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[15px] font-medium text-gray-200">Kapasitas Maksimal</span>
                        <input type="number" x-model="tempCapacityLimit"
                            :class="(tempCapacityLimit < 1 || tempCapacityLimit > 100000) && tempCapacityLimit !== '' ? 'border-red-500/50' : 'border-[#3a3442]'"
                            class="bg-[#2f2936] border rounded-lg w-32 py-2 px-3 text-right text-white font-medium outline-none focus:border-gray-500 placeholder-gray-600 appearance-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none transition-colors">
                    </div>
                    <p x-show="(tempCapacityLimit < 1 || tempCapacityLimit > 100000) && tempCapacityLimit !== ''"
                        class="text-xs text-red-500/80 mt-1 text-right" style="display: none;">
                        Kapasitas harus antara 1 dan 100.000.
                    </p>
                </div>
                <button @click="capacityLimit = tempCapacityLimit; openCapacityModal = false"
                    :disabled="(tempCapacityLimit < 1 || tempCapacityLimit > 100000) && tempCapacityLimit !== ''"
                    :class="(tempCapacityLimit < 1 || tempCapacityLimit > 100000) && tempCapacityLimit !== '' ? 'bg-gray-400 cursor-not-allowed opacity-50' : 'bg-white hover:bg-gray-200'"
                    class="w-full text-black font-bold py-3 rounded-xl transition-colors">
                    Konfirmasi
                </button>
            </div>
        </div>

        <!-- Modal Deskripsi -->
        <div x-show="openDescriptionModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-transition.opacity>
            <div @click.outside="openDescriptionModal = false"
                class="bg-[#1a161f] border border-[#3a3442] w-[480px] h-[320px] rounded-2xl p-6 shadow-2xl transform transition-all flex flex-col"
                x-transition.scale>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-white">Deskripsi Acara</h2>
                    <button @click="openDescriptionModal = false"
                        class="text-gray-400 hover:text-white bg-[#26212c] rounded-full p-1.5 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 mb-4">
                    <textarea x-model="description"
                        class="w-full h-full bg-transparent text-lg text-gray-200 placeholder-gray-600 outline-none resize-none leading-relaxed"
                        placeholder="Tambahkan detail acara..."></textarea>
                </div>
                <div class="flex justify-end pt-4 border-t border-[#3a3442]">
                    <button @click="openDescriptionModal = false"
                        class="bg-white text-black font-bold px-6 py-2 rounded-xl hover:bg-gray-200 transition-colors">
                        Selesai
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Lokasi -->
        <div x-show="openLocationModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-transition.opacity>
            <div @click.outside="openLocationModal = false"
                class="bg-[#1a161f] border border-[#3a3442] w-[400px] rounded-2xl p-6 shadow-2xl transform transition-all"
                x-transition.scale>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-white">Tambahkan Lokasi</h2>
                    <button @click="openLocationModal = false"
                        class="text-gray-400 hover:text-white bg-[#26212c] rounded-full p-1.5 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mb-6">
                    <input type="text" x-model="location"
                        class="w-full bg-[#2f2936] border border-[#3a3442] rounded-xl px-4 py-3 text-white placeholder-gray-600 outline-none focus:border-gray-500 transition-colors"
                        placeholder="Cari lokasi atau masukkan tautan...">
                </div>
                <button @click="openLocationModal = false"
                    class="w-full bg-white text-black font-bold py-3 rounded-xl hover:bg-gray-200 transition-colors">
                    Selesai
                </button>
            </div>
        </div>

        <!-- Modal Harga Tiket -->
        <div x-show="openTicketModal" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-transition.opacity>
            <div @click.outside="openTicketModal = false"
                class="bg-[#1a161f] border border-[#3a3442] w-[400px] rounded-2xl p-6 shadow-2xl transform transition-all"
                x-transition.scale>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-white">Harga Tiket</h2>
                    <button @click="openTicketModal = false"
                        class="text-gray-400 hover:text-white bg-[#26212c] rounded-full p-1.5 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Input Harga dengan Simbol Mata Uang -->
                <div class="mb-6">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                        <input type="number" x-model="tempTicketPrice"
                            :class="tempTicketPrice < 0 && tempTicketPrice !== '' ? 'border-red-500/50' : 'border-[#3a3442]'"
                            class="w-full bg-[#2f2936] border rounded-xl pl-12 pr-4 py-3 text-white placeholder-gray-600 outline-none focus:border-gray-500 transition-colors appearance-none [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                            placeholder="0">
                    </div>
                    <p x-show="tempTicketPrice < 0 && tempTicketPrice !== ''" class="text-xs text-red-500/80 mt-2 ml-1"
                        style="display: none;">
                        Harga tiket tidak boleh kurang dari 0.
                    </p>
                    <p x-show="!(tempTicketPrice < 0 && tempTicketPrice !== '')" class="text-xs text-gray-500 mt-2 ml-1">
                        Kosongkan untuk "Gratis"</p>
                </div>
                <button @click="ticketPrice = tempTicketPrice; openTicketModal = false"
                    :disabled="tempTicketPrice < 0 && tempTicketPrice !== ''"
                    :class="tempTicketPrice < 0 && tempTicketPrice !== '' ? 'bg-gray-400 cursor-not-allowed opacity-50' : 'bg-white hover:bg-gray-200'"
                    class="w-full text-black font-bold py-3 rounded-xl transition-colors">
                    Selesai
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function eventForm() {
            return {
                // Data Form (State Alpine.js)
                visibility: 'Kalender Pribadi',
                categoryId: '',
                categoryName: '',
                eventName: '',
                location: '',
                description: '',
                ticketPrice: '',
                tempTicketPrice: '',
                requiresApproval: false,

                // Logika Kapasitas
                openCapacityModal: false,
                capacityLimit: '',
                tempCapacityLimit: '',
                waitlistOverCapacity: false,

                // Deskripsi
                openDescriptionModal: false,

                // Modal-modal
                openLocationModal: false,
                openTicketModal: false,

                // Helper Validasi
                isCapacityInvalid() {
                    return (this.capacityLimit < 1 || this.capacityLimit > 100000) && this.capacityLimit !== '';
                },
                isPriceInvalid() {
                    return this.tempTicketPrice < 0 && this.tempTicketPrice !== '';
                },

                submitEvent() {
                    if (this.isCapacityInvalid() || this.isPriceInvalid()) {
                        alert('Mohon perbaiki kesalahan pada form sebelum melanjutkan.');
                        return;
                    }
                    alert(`Event Created: ${this.eventName}\nStart: ${this.startDate}\nEnd: ${this.endDate}`);
                }
            }
        }

        function datePicker() {
            const today = new Date();
            return {
                openPicker: null,
                startDate: new Date(),
                endDate: new Date(),
                startTime: '02:00 PM',
                endTime: '03:00 PM',
                currentMonth: today.getMonth(),
                currentYear: today.getFullYear(),
                monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                days: [],
                blanks: [],

                init() {
                    this.calculateDays();
                    this.generateTimeSlots();
                },

                calculateDays() {
                    let firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
                    let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();

                    this.blanks = Array.from({ length: firstDay });
                    this.days = Array.from({ length: daysInMonth }, (_, i) => i + 1);
                },

                prevMonth() {
                    if (this.currentMonth === 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    } else {
                        this.currentMonth--;
                    }
                    this.calculateDays();
                },

                nextMonth() {
                    if (this.currentMonth === 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    } else {
                        this.currentMonth++;
                    }
                    this.calculateDays();
                },

                toggleCalendar(type) {
                    this.openPicker = this.openPicker === type ? null : type;
                },

                selectDate(day, type) {
                    const selected = new Date(this.currentYear, this.currentMonth, day);
                    if (type === 'start') this.startDate = selected;
                    else this.endDate = selected;
                    this.openPicker = null;
                },

                isToday(day) {
                    const d = new Date(this.currentYear, this.currentMonth, day);
                    const now = new Date();
                    return d.toDateString() === now.toDateString();
                },

                isSameDate(day, type) {
                    const d = new Date(this.currentYear, this.currentMonth, day);
                    const target = type === 'start' ? this.startDate : this.endDate;
                    return d.toDateString() === target.toDateString();
                },

                formatDate(date) {
                    const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                    return `${days[date.getDay()]}, ${date.getDate()} ${months[date.getMonth()]}`;
                },

                timeSlots: [],

                generateTimeSlots() {
                    const times = [];
                    for (let i = 0; i < 24; i++) {
                        for (let j = 0; j < 2; j++) {
                            const hour = i % 12 || 12;
                            const minute = j === 0 ? '00' : '30';
                            const ampm = i < 12 ? 'AM' : 'PM';
                            // Format 01:00 PM
                            const str = `${hour.toString().padStart(2, '0')}:${minute} ${ampm}`;
                            times.push(str);
                        }
                    }
                    this.timeSlots = times;
                },

                formatISO(date, timeStr) {
                    if (!date) return '';
                    const d = new Date(date);
                    const year = d.getFullYear();
                    const month = (d.getMonth() + 1).toString().padStart(2, '0');
                    const day = d.getDate().toString().padStart(2, '0');

                    // timeStr is like "02:00 PM"
                    const [time, ampm] = timeStr.split(' ');
                    let [hours, minutes] = time.split(':');
                    hours = parseInt(hours);
                    if (ampm === 'PM' && hours < 12) hours += 12;
                    if (ampm === 'AM' && hours === 12) hours = 0;
                    const hoursStr = hours.toString().padStart(2, '0');

                    return `${year}-${month}-${day} ${hoursStr}:${minutes}:00`;
                }
            }
        }
    </script>
@endpush