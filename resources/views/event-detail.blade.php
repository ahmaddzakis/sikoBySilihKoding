@extends('layouts.app')

@section('title', $event->judul)

@section('content')
    <div class="min-h-screen pb-20">

        <div class="relative h-[400px] w-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('{{ $event->image_url }}'); filter: blur(20px); transform: scale(1.1);">
            </div>
            <div class="absolute inset-0 bg-black/60"></div>

            <div class="relative max-w-6xl mx-auto px-6 h-full flex items-end pb-12">
                <div class="flex flex-col md:flex-row gap-8 items-end w-full">
                    <!-- gambar utamanya -->
                    <div
                        class="w-full md:w-[400px] aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl border border-white/10 flex-shrink-0">
                        <img src="{{ $event->image_url }}"
                            alt="{{ $event->judul }}" class="w-full h-full object-cover">
                    </div>

                    <!-- info singkat -->
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center gap-3">
                            <span
                                class="px-3 py-1 rounded-full bg-pink-500/20 text-pink-400 text-xs font-bold uppercase tracking-wider border border-pink-500/30">
                                {{ $event->category->nama ?? 'Lainnya' }}
                            </span>
                            <span
                                class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-wider border border-blue-500/30">
                                {{ $event->visibility->nama ?? 'Publik' }}
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black text-white leading-tight">
                            {{ $event->judul }}
                        </h1>

                    </div>
                </div>
            </div>
        </div>

        <!-- area konten -->
        <div class="max-w-6xl mx-auto px-6 mt-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <!-- sisi kiri: deskripsi & detail -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- bagian deskripsi -->
                    <section>
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-align-left text-pink-500 text-lg"></i>
                            Tentang Acara
                        </h2>
                        <div class="text-gray-400 leading-relaxed text-lg whitespace-pre-wrap">
                            {{ $event->description ?: 'Tidak ada deskripsi untuk acara ini.' }}
                        </div>
                    </section>

                    <!-- bagian lokasi -->
                    <section>
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                            <i class="fa-solid fa-location-dot text-pink-500 text-lg"></i>
                            Lokasi
                        </h2>
                        <div
                            class="bg-[#1a161f] border border-[#3a3442] rounded-2xl p-6 flex flex-col md:flex-row gap-6 items-center">
                            <div
                                class="w-full md:w-48 h-32 rounded-xl bg-[#26212c] flex items-center justify-center border border-[#3a3442]">
                                <i class="fa-solid fa-map-location-dot text-4xl text-gray-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-white font-bold text-lg mb-1">{{ $event->lokasi }}</h3>
                                <p class="text-gray-500">Klik untuk melihat di Google Maps</p>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->lokasi) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 text-pink-500 hover:text-pink-400 font-bold mt-4 transition-colors">
                                    Lihat Peta <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- sisi kanan: tiket & waktu -->
                <div class="space-y-6">
                    <!-- kartu tiket -->
                    <div
                        class="bg-gradient-to-b from-[#26212c] to-[#1a161f] border border-[#3a3442] rounded-3xl p-8 sticky top-24 shadow-2xl">
                        <div class="space-y-6">
                            <!-- info waktu -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center flex-shrink-0 border border-pink-500/20">
                                        <i class="fa-regular fa-calendar-check text-pink-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Waktu Mulai</p>
                                        <p class="text-white font-bold">
                                            {{ $event->waktu_mulai->translatedFormat('l, d F Y') }}
                                        </p>
                                        <p class="text-gray-400 text-sm">{{ $event->waktu_mulai->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-purple-500/10 flex items-center justify-center flex-shrink-0 border border-purple-500/20">
                                        <i class="fa-regular fa-clock text-purple-500"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Waktu Selesai
                                        </p>
                                        <p class="text-white font-bold">
                                            {{ $event->waktu_selesai->translatedFormat('l, d F Y') }}
                                        </p>
                                        <p class="text-gray-400 text-sm">{{ $event->waktu_selesai->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-[#3a3442]">

                            @php
                                $isRegistered = auth()->check() ? $event->registrations->where('user_id', auth()->id())->first() : null;
                                $remainingSlots = $event->kapasitas ? $event->kapasitas - $event->registrations->count() : null;
                                $isFull = $event->kapasitas && $remainingSlots <= 0;
                                $isPast = $event->waktu_selesai->isPast();
                            @endphp

                            <!-- harga & kapasitas -->
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Tiket Masuk
                                    </p>
                                    <p class="text-3xl font-black text-white">
                                        {{ $event->harga_tiket > 0 ? 'Rp ' . number_format($event->harga_tiket, 0, ',', '.') : 'Gratis' }}
                                    </p>
                                </div>
                                @if($event->kapasitas)
                                    <div class="text-right">
                                        <p class="text-xs font-bold {{ $isFull ? 'text-red-500' : 'text-gray-500' }}">
                                            {{ max(0, $remainingSlots) }} Slot
                                        </p>
                                        <p class="text-[10px] text-gray-600">Tersedia</p>
                                    </div>
                                @endif
                            </div>

                            <!-- tombol aksi -->
                            @if(auth()->id() === $event->organizer_id && !$isPast)
                                <!-- edit dan delete tombol -->
                                <div class="space-y-3 mt-4">
                                    <a href="{{ route('dashboard.events.edit', $event->id) }}"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl transition-all transform active:scale-[0.98] shadow-xl text-lg flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit Acara
                                    </a>
                                </div>
                            @elseif($isPast)
                                <button disabled
                                    class="w-full bg-gray-600 text-gray-400 font-black py-4 rounded-2xl cursor-not-allowed shadow-xl text-lg mt-4">
                                    Acara Selesai
                                </button>
                            @elseif($isFull)
                                <button disabled
                                    class="w-full bg-red-500/20 text-red-500 border border-red-500/30 font-black py-4 rounded-2xl cursor-not-allowed shadow-xl text-lg mt-4">
                                    Stok Habis
                                </button>
                            @elseif(isset($existingRegistration) && $existingRegistration)
                                <!-- Jika sudah terdaftar, tampilkan info & tombol tiket -->
                                <div class="space-y-4 bg-white/5 p-4 rounded-2xl border border-white/10 mt-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">DATA PENDAFTARAN</p>
                                        <span class="text-[9px] bg-green-500/20 text-green-500 px-2 py-0.5 rounded font-bold uppercase tracking-tighter">SUDAH TERDAFTAR</span>
                                    </div>
                                    
                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1 ml-1">Nama Lengkap</label>
                                        <input type="text" value="{{ $existingRegistration->name }}" disabled
                                            class="w-full bg-[#1a161f] border border-[#3a3442] rounded-xl px-4 py-2.5 text-sm text-gray-400 cursor-not-allowed">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1 ml-1">Nomor Telepon (WA)</label>
                                        <input type="text" value="{{ $existingRegistration->phone }}" disabled
                                            class="w-full bg-[#1a161f] border border-[#3a3442] rounded-xl px-4 py-2.5 text-sm text-gray-400 cursor-not-allowed">
                                    </div>
                                    
                                    @if($event->harga_tiket > 0)
                                    <div class="mt-4 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
                                        <p class="text-sm text-yellow-500 font-bold mb-2">Informasi Pembayaran</p>
                                        <p class="text-xs text-gray-400">Total pembayaran: <span class="text-white font-bold">Rp {{ number_format($event->harga_tiket, 0, ',', '.') }}</span></p>
                                        
                                        @if($existingRegistration->status == 'pending')
                                             <div class="mt-2 text-[10px] text-yellow-400 flex items-center gap-2">
                                                <i class="fa-solid fa-clock"></i>
                                                <span>Menunggu Konfirmasi Admin</span>
                                             </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>

                                <a href="{{ route('tickets.download', $existingRegistration->id) }}" target="_blank"
                                    class="w-full bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-black py-4 rounded-2xl transition-all transform active:scale-[0.98] shadow-xl text-lg flex items-center justify-center gap-2 mt-4">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    Unduh E-Tiket (PDF)
                                </a>

                            @else
                                <!-- selalu tampilkan form pendaftaran  -->
                                <form action="{{ route('events.register', $event->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                                    @csrf
                                    <div class="space-y-4 bg-white/5 p-4 rounded-2xl border border-white/10">
                                        <div class="flex justify-between items-center mb-2">
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Data Pendaftaran</p>
                                            @if($isRegistered)
                                                <span class="text-[9px] bg-green-500/20 text-green-500 px-2 py-0.5 rounded font-bold uppercase tracking-tighter">Sudah Terdaftar</span>
                                            @endif
                                        </div>
                                        
                                        <!-- nama lengkap -->
                                        <div>
                                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1 ml-1">Nama Lengkap</label>
                                            <input type="text" name="name" required placeholder="Contoh: Ahmad Zaki" pattern="[a-zA-Z\s]+" title="Nama hanya boleh berisi huruf dan spasi" value="{{ old('name', auth()->user()->name ?? '') }}"
                                                class="w-full bg-[#1a161f] border {{ $errors->has('name') ? 'border-red-500' : 'border-[#3a3442]' }} rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-pink-500 transition-all">
                                            @error('name')
                                                <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- nomor telepon -->
                                        <div>
                                            <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1 ml-1">Nomor Telepon (WA)</label>
                                            <input type="tel" name="phone" required placeholder="0812xxxxxxx" pattern="[0-9]+" title="Nomor telepon hanya boleh berisi angka" value="{{ old('phone') }}"
                                                class="w-full bg-[#1a161f] border {{ $errors->has('phone') ? 'border-red-500' : 'border-[#3a3442]' }} rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-pink-500 transition-all">
                                            @error('phone')
                                                <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        @if($event->harga_tiket > 0)
                                            <div class="pt-2 border-t border-white/10"></div>
                                            <!-- info pembayaran -->
                                            <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-3">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-xs text-yellow-500 font-bold uppercase">Total Tagihan</span>
                                                    <span class="text-lg font-black text-white">Rp {{ number_format($event->harga_tiket, 0, ',', '.') }}</span>
                                                </div>
                                                <p class="text-[10px] text-gray-400 leading-relaxed">
                                                    Silakan transfer ke rekening <b>BCA 1234567890 (a.n. Siko Project)</b> dan upload bukti transfer di bawah ini.
                                                </p>
                                            </div>

                                            <!-- upload bukti -->
                                            <div>
                                                <label class="block text-[10px] uppercase font-bold text-gray-500 mb-1 ml-1">Bukti Transfer</label>
                                                <input type="file" name="payment_proof" required accept="image/*"
                                                    class="w-full bg-[#1a161f] border {{ $errors->has('payment_proof') ? 'border-red-500' : 'border-[#3a3442]' }} rounded-xl px-4 py-2 text-sm text-gray-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-pink-500/20 file:text-pink-500 hover:file:bg-pink-500/30 transition-all">
                                                <p class="text-[10px] text-gray-500 mt-1 italic">* Hanya file gambar (JPG, PNG) yang diperbolehkan</p>
                                                @error('payment_proof')
                                                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-white hover:bg-gray-200 text-black font-black py-4 rounded-2xl transition-all transform active:scale-[0.98] shadow-xl text-lg">
                                        {{ $event->harga_tiket > 0 ? 'Bayar & Daftar' : 'Daftar Sekarang' }}
                                    </button>
                                </form>
                            @endif
    
                            @if($event->requires_approval && $event->visibility->slug !== 'private' && !$isRegistered)
                                <p class="text-center text-xs text-gray-500 italic">
                                    * Pendaftaran membutuhkan persetujuan penyelenggara.
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- tombol kembali -->
                    <a href="javascript:history.back()"
                        class="flex items-center justify-center gap-2 text-gray-500 hover:text-white transition-colors py-4 font-bold text-sm">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Kembali ke halaman sebelumnya
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection