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
                        <span class="text-white">0</span> Diikuti
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="h-px bg-border/40 w-full mb-24"></div>

        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center text-center">
            <!-- Empty Icon with 0 -->
            <div class="mb-12 relative opacity-60 grayscale">
                <div
                    class="w-[120px] h-[85px] bg-[#2d2d2d] rounded-2xl p-3 flex flex-wrap gap-2 relative border border-[#3d3d3d]/30">
                    <div class="w-7 h-4 bg-[#1a1a1a] rounded-md opacity-40"></div>
                    <div class="w-12 h-4 bg-[#1a1a1a] rounded-md opacity-40"></div>
                    <div class="w-12 h-8 bg-[#1a1a1a] rounded-md opacity-40"></div>
                    <div class="w-6 h-8 bg-[#3d3d3d] rounded-md"></div>

                    <div
                        class="absolute -top-3 -right-3 w-12 h-12 bg-[#2d2d2d] rounded-full border-[6px] border-background flex items-center justify-center shadow-lg">
                        <span class="text-xl font-black text-[#555]">0</span>
                    </div>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-white mb-2 tracking-tight">Belum Ada Apa-apa</h2>
            <p class="text-textMuted max-w-xs text-sm font-medium leading-relaxed">
                {{ $user->name }} belum memiliki acara publik saat ini.
            </p>
        </div>
    </div>
@endsection