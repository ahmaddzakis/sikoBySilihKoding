@extends('layouts.app')

@section('title', 'Acara')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-6">
        <!-- header: judul sama toggle mendatang/lampau -->
        <div class="flex justify-between items-center mb-16">
            <h1 class="text-4xl font-bold text-white tracking-tight">Acara</h1>

            <!-- toggle tab -->
            <div class="bg-[#26212c] p-1 rounded-xl border border-[#3a3442] flex text-sm">
                <a href="?tab=upcoming"
                    class="px-5 py-2 rounded-lg transition-all font-semibold {{ $activeTab === 'upcoming' ? 'bg-[#3a3442] text-white' : 'text-gray-400 hover:text-gray-200' }}">
                    Mendatang
                </a>
                <a href="?tab=past"
                    class="px-5 py-2 rounded-lg transition-all font-semibold {{ $activeTab === 'past' ? 'bg-[#3a3442] text-white' : 'text-gray-400 hover:text-gray-200' }}">
                    Lampau
                </a>
            </div>
        </div>

        @php
            $displayEvents = $activeTab === 'upcoming' ? $upcomingEvents : $pastEvents;
        @endphp

        @if(count($displayEvents) > 0)
            @if($activeTab === 'upcoming')
                @include('events-upcoming', ['events' => $displayEvents])
            @else
                @include('events-timeline', ['events' => $displayEvents])
            @endif
        @else
            <!-- kalo kosong muncul ini -->
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <div class="mb-4"></div>
                <h2 class="text-3xl font-black text-white mb-4 tracking-tight">
                    {{ $activeTab === 'upcoming' ? 'Tidak Ada Acara Mendatang' : 'Tidak Ada Acara Selesai' }}
                </h2>
                <p class="text-gray-500 mb-12 max-w-sm text-lg font-medium leading-relaxed">
                    {{ $activeTab === 'upcoming' ? 'Anda tidak memiliki acara mendatang.' : 'Anda belum mengikuti acara apa pun.' }}
                </p>
                @if($activeTab === 'upcoming')
                    <a href="{{ Auth::check() ? '/create' : route('login') }}"
                        class="flex items-center gap-2 bg-[#2d2d30] hover:bg-[#3a3a3d] text-white px-8 py-3.5 rounded-xl transition-all border border-[#3e3e42] font-bold text-sm shadow-xl mt-8">
                        <i class="fa-solid fa-plus text-xs opacity-50"></i>
                        Buat Acara
                    </a>
                @endif
            </div>
        @endif

    </div>
@endsection