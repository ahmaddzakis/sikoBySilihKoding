@extends('layouts.app')

@section('title', 'Kalender')

@section('content')
    <!-- Container Utama: Menggunakan Tailwind untuk layouting dan spacing -->
    <div class="max-w-6xl mx-auto px-6 py-10">

        <!-- Header Halaman -->
        <h1 class="text-3xl font-bold mb-8 text-white">Kalender</h1>

        <!-- Bagian: Kalender Saya -->
        <div class="mb-12">
            <!-- Header Bagian: Judul dan Tombol Tambah -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white">Kalender Saya</h2>

                <!-- Tombol 'Buat'-->
                <button
                    class="flex items-center gap-2 px-3 py-1.5 bg-surface/50 border border-border hover:bg-surfaceHover rounded text-sm font-medium transition-colors text-white">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Buat
                </button>
            </div>

            <!-- Grid Layout untuk Kartu Kalender -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Kartu Kalender User -->
                <a href="{{ route('calendar.my-events') }}" class="block">
                    <div
                        class="bg-surface border border-border rounded-xl p-6 hover:border-textMuted transition-colors cursor-pointer group h-full">
                        <div class="flex flex-col items-start gap-3">

                            <!-- Avatar profile-->
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border border-border bg-gradient-to-tr from-green-400 to-blue-500">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>

                            <!-- Informasi Kalender -->
                            <div class="mt-1">
                                <h3 class="font-bold text-base text-white group-hover:text-white transition-colors">
                                    {{ Auth::user()->name }}
                                </h3>
                                <p class="text-sm text-textMuted group-hover:text-white/80 transition-colors">
                                    {{ Auth::user()->events()->count() }} Acara
                                </p>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <!-- Footer Placeholder -->
        <!-- Bagian ini bisa diisi footer atau dikosongkan jika sudah ada di layout utama -->

    </div>
@endsection