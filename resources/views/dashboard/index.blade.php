@extends('layouts.admin')

@section('title', 'Beranda Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- CARD EVENT -->
        <a href="{{ route('dashboard.events.index') }}"
            class="group relative bg-[#26212c] p-8 rounded-3xl border border-[#3a3442] hover:border-pink-500/50 transition-all shadow-xl overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-pink-500/5 blur-3xl rounded-full -mr-16 -mt-16 group-hover:bg-pink-500/10 transition-colors">
            </div>

            <div class="flex items-center gap-4 mb-6">
                <div
                    class="w-12 h-12 rounded-2xl bg-pink-500/10 border border-pink-500/20 flex items-center justify-center text-pink-500">
                    <i class="fa-solid fa-calendar-days text-xl"></i>
                </div>
                <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs">Total Acara</h3>
            </div>

            <div class="flex items-end justify-between">
                <p class="text-4xl font-black text-white tracking-tighter">{{ $totalEvents }}</p>
                <span class="text-xs text-pink-500 font-bold flex items-center gap-1">
                    Kelola <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </span>
            </div>
        </a>

        <!-- CARD USER -->
        <a href="{{ route('dashboard.users.index') }}"
            class="group relative bg-[#26212c] p-8 rounded-3xl border border-[#3a3442] hover:border-purple-500/50 transition-all shadow-xl overflow-hidden">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-purple-500/5 blur-3xl rounded-full -mr-16 -mt-16 group-hover:bg-purple-500/10 transition-colors">
            </div>

            <div class="flex items-center gap-4 mb-6">
                <div
                    class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-500">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <h3 class="text-gray-400 font-bold uppercase tracking-widest text-xs">Total Pengguna</h3>
            </div>

            <div class="flex items-end justify-between">
                <p class="text-4xl font-black text-white tracking-tighter">{{ $totalUsers }}</p>
                <span class="text-xs text-purple-500 font-bold flex items-center gap-1">
                    Kelola <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </span>
            </div>
        </a>

    </div>
@endsection