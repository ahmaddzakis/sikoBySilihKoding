@extends('layouts.app')

@section('title', 'Acara')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-12">
        <!-- Header: Judul dan Toggle Mendatang/Lampau -->
        <div class="flex justify-between items-center mb-16">
            <h1 class="text-4xl font-bold text-white tracking-tight">Acara</h1>

            <!-- Toggle Tab -->
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
            // Nantinya data ini akan dikirim dari Controller
            // $upcomingEvents: data acara dari backend untuk tab Mendatang
            // $pastEvents: data acara dari backend untuk tab Lampau
            
            // Masukkan kembali data dummy hanya untuk bagian Lampau agar tampilan demo tidak kosong
            $pastEventsDemo = [
                [
                    'date' => '21 Des',
                    'day' => 'Minggu',
                    'time' => '18.30',
                    'title' => 'kekrom',
                    'location' => 'Jakarta, Indonesia',
                    'location_type' => 'link',
                    'attendees' => 'Tidak ada tamu',
                    'image' => asset('images/invite.jpg'),
                    'avatars' => []
                ]
            ];

            $displayEvents = $activeTab === 'upcoming' ? ($upcomingEvents ?? []) : ($pastEvents ?? $pastEventsDemo);
        @endphp

        @if(count($displayEvents) > 0)
            @if($activeTab === 'upcoming')
                @include('events-upcoming', ['events' => $displayEvents])
            @else
                @include('events-timeline', ['events' => $displayEvents])
            @endif
        @else
            <!-- Tampilan Kosong (Empty State) -->
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <div class="mb-12 relative scale-110">
                    <div class="w-[140px] h-[100px] bg-[#26212c] rounded-[28px] p-4 flex flex-wrap gap-2.5 relative border border-[#3a3442] shadow-2xl">
                        <div class="w-8 h-5 bg-[#1a161f] rounded-md opacity-40"></div>
                        <div class="w-14 h-5 bg-[#1a161f] rounded-md opacity-40"></div>
                        <div class="w-14 h-10 bg-[#1a161f] rounded-md opacity-40"></div>
                        <div class="w-7 h-10 bg-[#3a3442] rounded-md"></div>
                        <div class="w-9 h-5 bg-[#1a161f] rounded-md opacity-40"></div>
                        <div class="absolute -top-3 -right-3 w-14 h-14 bg-[#26212c] rounded-full border-[8px] border-[#1a161f] flex items-center justify-center shadow-lg text-2xl font-black text-gray-700">0</div>
                    </div>
                </div>
                <h2 class="text-3xl font-black text-white mb-4 tracking-tight">
                    {{ $activeTab === 'upcoming' ? 'Tidak Ada Acara Mendatang' : 'Tidak Ada Acara Selesai' }}
                </h2>
                <p class="text-gray-500 mb-12 max-w-sm text-lg font-medium leading-relaxed">
                    {{ $activeTab === 'upcoming' ? 'Anda tidak memiliki acara mendatang.' : 'Anda belum mengikuti acara apa pun.' }}
                </p>
                @if($activeTab === 'upcoming')
                <a href="/create" class="flex items-center gap-2 bg-[#2d2d30] hover:bg-[#3a3a3d] text-white px-8 py-3.5 rounded-xl transition-all border border-[#3e3e42] font-bold text-sm shadow-xl mt-8">
                    <i class="fa-solid fa-plus text-xs opacity-50"></i>
                    Buat Acara
                </a>
                @endif
            </div>
        @endif

    </div>
@endsection
```