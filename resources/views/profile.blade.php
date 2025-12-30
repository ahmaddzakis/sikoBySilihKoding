@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="max-w-2xl mx-auto px-6 py-20 text-center md:text-left">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-500 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 text-sm">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-500 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header: Avatar & Info -->
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8 mb-12">
            <!-- Avatar -->
            <div class="group relative">
                <div
                    class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-tr {{ $user->avatar ? '' : 'from-green-400 to-green-600' }} flex items-center justify-center border-4 border-background shadow-2xl shrink-0">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <!-- Simple smiley face using div/icon -->
                        <div class="relative w-16 h-16">
                            <div class="absolute top-4 left-2 w-2.5 h-3 bg-black/80 rounded-full"></div>
                            <div class="absolute top-4 right-2 w-2.5 h-3 bg-black/80 rounded-full"></div>
                            <div
                                class="absolute bottom-2 left-1/2 -translate-x-1/2 w-10 h-5 border-b-4 border-black/80 rounded-full">
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Edit Overlay -->
                <div class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer"
                    onclick="document.getElementById('avatar-input').click()">
                    <i class="fa-solid fa-camera text-white text-2xl"></i>
                </div>

                <!-- Hidden Form -->
                <form id="avatar-form" action="{{ route('profile.avatar.update') }}" method="POST"
                    enctype="multipart/form-data" class="hidden">
                    @csrf
                    <input type="file" id="avatar-input" name="avatar" accept="image/*"
                        onchange="document.getElementById('avatar-form').submit()">
                </form>
            </div>

            <!-- Info -->
            <div class="flex flex-col justify-center h-32 py-2">
                <div class="flex items-center gap-4 mb-2 justify-center md:justify-start">
                    <h1 class="text-4xl font-bold text-white tracking-tight">{{ $user->name }}</h1>

                    @if($user->avatar)
                        <form action="{{ route('profile.avatar.delete') }}" method="POST"
                            onsubmit="return confirm('Hapus foto profil?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium transition-colors">
                                <i class="fa-solid fa-trash-can mr-1"></i> Hapus
                            </button>
                        </form>
                    @endif
                </div>

                <div class="flex flex-col gap-2 text-textMuted font-medium text-sm">
                    <div class="flex items-center gap-2 justify-center md:justify-start">
                        <i class="fa-regular fa-calendar text-xs opacity-60"></i>
                        <span>Bergabung {{ $user->created_at->format('F Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 justify-center md:justify-start">
                        <span class="text-white">{{ $createdEventsCount }}</span> Dibuat
                        <span class="mx-1 opacity-20">•</span>
                        <span class="text-white">{{ $registrations->count() }}</span> Diikuti
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="h-px bg-border/40 w-full mb-12"></div>

        <!-- content sections -->
        <div class="space-y-16">
            <!-- Joined Events Section -->
            <section>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fa-solid fa-ticket text-pink-500"></i>
                        Acara yang Diikuti
                    </h2>
                </div>

                @if($registrations->isEmpty())
                    <div class="p-12 border-2 border-dashed border-border/50 rounded-3xl flex flex-col items-center justify-center text-center opacity-60">
                        <i class="fa-solid fa-compass-drafting text-4xl mb-4 text-gray-600"></i>
                        <p class="text-gray-500 font-medium">Anda belum bergabung di acara apa pun.</p>
                        <a href="/find" class="mt-4 text-pink-500 font-bold hover:underline">Temukan Acara Resmi</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($registrations as $reg)
                            <a href="{{ route('events.show', $reg->event->id) }}" class="group block relative">
                                <div class="bg-yellow-400 rounded-3xl p-6 min-h-[220px] shadow-xl transform transition-transform group-hover:scale-[1.02] overflow-hidden">
                                    <!-- Background text effect -->
                                    <div class="absolute -right-4 -bottom-4 opacity-10 select-none pointer-events-none">
                                        <i class="fa-solid fa-ticket text-[120px] text-black -rotate-12"></i>
                                    </div>
                                    
                                    <div class="relative z-10 h-full flex flex-col justify-between">
                                        <div>
                                            <p class="text-[10px] font-black uppercase tracking-widest text-black/50 mb-4">Kamu masuk</p>
                                            <h3 class="text-4xl font-black text-black leading-none mb-1">DAFTAR</h3>
                                            <h3 class="text-4xl font-black text-black leading-none mb-4">TAMU*</h3>
                                            <p class="text-xs font-black text-black max-w-[120px] uppercase">*BETAPA BERUNTUNGNYA KAMU</p>
                                        </div>
                                        
                                        <div class="mt-8">
                                            <p class="text-sm font-black text-black truncate">{{ $reg->event->judul }}</p>
                                            <p class="text-[10px] font-bold text-black/60">{{ $reg->event->waktu_mulai->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    @if($reg->status === 'approved')
                                        <div class="absolute top-4 right-4 w-10 h-10 bg-black rounded-full flex items-center justify-center shadow-lg border-2 border-yellow-400">
                                            <i class="fa-solid fa-check text-yellow-400"></i>
                                        </div>
                                    @else
                                        <div class="absolute top-4 right-4 px-3 py-1 bg-black/20 text-black text-[10px] font-black rounded-full backdrop-blur-sm">
                                            MENUNGGU
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- Created Events Section (Brief) -->
            @if($createdEventsCount > 0)
            <section>
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <i class="fa-solid fa-calendar-plus text-pink-500"></i>
                        Acara yang Dibuat
                    </h2>
                    <a href="{{ route('calendar.my-events') }}" class="text-pink-500 text-sm font-bold hover:underline">Lihat Semua</a>
                </div>
                
                <div class="bg-surface border border-border rounded-2xl p-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-pink-500/10 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-folder-open text-pink-500"></i>
                        </div>
                        <div>
                            <p class="text-white font-bold">Koleksi Acara Anda</p>
                            <p class="text-gray-500 text-xs">Total {{ $createdEventsCount }} acara privat/publik</p>
                        </div>
                    </div>
                    <a href="{{ route('calendar.my-events') }}" class="w-10 h-10 bg-white/5 hover:bg-white/10 rounded-full flex items-center justify-center transition-colors">
                        <i class="fa-solid fa-chevron-right text-gray-400"></i>
                    </a>
                </div>
            </section>
            @endif
        </div>
    </div>
@endsection