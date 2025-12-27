@extends('layouts.app')

@section('title', 'Bantuan')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-white mb-4">Selamat Datang!</h1>
            <p class="text-xl text-gray-400">Bagaimana kami bisa membantu?</p>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-16">
            <div class="absolute inset-y-0 left-6 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-500 text-lg"></i>
            </div>
            <input type="text" placeholder="Cari dokumen bantuan, tutorial, dan lainnya..."
                class="w-full bg-[#26212c] border border-[#3a3442] rounded-2xl pl-16 pr-6 py-5 text-lg text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all shadow-xl">
        </div>

        <!-- Sections -->
        <div class="space-y-12">
            <!-- Section: Acara -->
            <div>
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-6">Acara</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card 1 -->
                    <div
                        class="p-6 bg-[#26212c] border border-[#3a3442] rounded-3xl hover:border-purple-500/30 transition-all group cursor-pointer shadow-lg">
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">Proses
                            Pendaftaran Acara</h3>
                        <p class="text-gray-400 leading-relaxed">Apa yang terjadi saat tamu mendaftar untuk acara Anda? Mari
                            kita telusuri alurnya.</p>
                    </div>
                    <!-- Card 2 -->
                    <div
                        class="p-6 bg-[#26212c] border border-[#3a3442] rounded-3xl hover:border-purple-500/30 transition-all group cursor-pointer shadow-lg">
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-purple-400 transition-colors">Membuat
                            Acara</h3>
                        <p class="text-gray-400 leading-relaxed">Pelajari cara membuat dan menyiapkan acara pertama Anda di
                            Siko.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection