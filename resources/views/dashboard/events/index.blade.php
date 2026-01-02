@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-[#1a161f] p-8" x-data="{ search: '{{ request('search') }}' }">
        <div class="max-w-6xl mx-auto bg-[#26212c] rounded-xl shadow-lg overflow-hidden p-8 border border-[#3a3442]">

            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-white">Manajemen Event</h1>

                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
                    <form action="{{ route('dashboard.events.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto items-center">
                        
                        {{-- Visibility Filter --}}
                        <div class="relative">
                            <select name="visibility" onchange="this.form.submit()" class="appearance-none w-full md:w-32 pl-3 pr-8 py-2 rounded-lg border border-[#3a3442] focus:outline-none focus:border-pink-500 transition-colors text-sm text-gray-300 bg-[#1a161f] cursor-pointer">
                                <option value="">Status</option>
                                @foreach($visibilities as $v)
                                    <option value="{{ $v->slug }}" {{ request('visibility') == $v->slug ? 'selected' : '' }}>
                                        {{ ucfirst($v->nama) }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                         {{-- Category Filter --}}
                         <div class="relative">
                            <select name="category" onchange="this.form.submit()" class="appearance-none w-full md:w-32 pl-3 pr-8 py-2 rounded-lg border border-[#3a3442] focus:outline-none focus:border-pink-500 transition-colors text-sm text-gray-300 bg-[#1a161f] cursor-pointer">
                                <option value="">Kategori</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>
                                        {{ $c->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        {{-- SEARCH INPUT --}}
                        <div class="relative w-full md:w-48">
                            <input type="text" name="search" x-model="search"
                                placeholder="Cari..."
                                class="w-full pl-9 pr-4 py-2 rounded-lg border border-[#3a3442] focus:outline-none focus:border-pink-500 transition-colors text-sm text-gray-300 bg-[#1a161f] placeholder-gray-600">
                            <div class="absolute left-3 top-2.5 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>

                    {{-- CREATE EVENT BUTTON --}}
                    <a href="{{ route('dashboard.events.create') }}"
                        class="flex items-center gap-2 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-bold px-4 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform active:scale-95 whitespace-nowrap text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Acara
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 text-green-500 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1a161f; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #3a3442; 
            border-radius: 4px; 
            border: 2px solid #1a161f;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #524a5e; 
        }
    </style>

            {{-- SCROLLABLE TABLE --}}
            {{-- Max-height adjusted to show approx 6 rows --}}
            <div class="overflow-x-auto overflow-y-auto border border-[#3a3442] rounded-lg custom-scrollbar"
                style="max-height: 450px;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-[#1a161f] z-10 shadow-sm">
                        <tr class="text-gray-400 text-sm uppercase tracking-wider">
                            <th class="p-4 border-b border-[#3a3442]">Nama Acara</th>
                            <th class="p-4 border-b border-[#3a3442]">Jadwal</th>
                            <th class="p-4 border-b border-[#3a3442] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#3a3442] text-gray-300">
                        @forelse($events as $e)
                            <tr class="hover:bg-[#3a3442]/30 transition" x-show="!search || '{{ strtolower($e->judul) }}'.includes(search.toLowerCase()) || '{{ strtolower($e->lokasi) }}'.includes(search.toLowerCase())">
                                <td class="p-4">
                                    <div class="font-medium text-white">{{ $e->judul }}</div>
                                    <div class="text-xs text-gray-500 mb-1">{{ $e->lokasi }}</div>
                                    <div class="flex gap-2 mt-1">
                                        <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full bg-indigo-500/20 text-indigo-400 border border-indigo-500/30">
                                            {{ $e->category->nama ?? 'Tanpa Kategori' }}
                                        </span>
                                        <span class="px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $e->visibility->slug == 'public' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-gray-500/20 text-gray-400 border border-gray-500/30' }}">
                                            {{ ucfirst($e->visibility->nama ?? 'Tidak Diketahui') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-sm whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($e->waktu_mulai)->translatedFormat('d M Y H:i') }} <br>
                                    <span class="text-xs text-gray-600">s/d</span>
                                    {{ \Carbon\Carbon::parse($e->waktu_selesai)->format('H:i') }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('dashboard.registrations.index', $e->id) }}"
                                            class="p-2 text-pink-500 hover:text-pink-400 hover:bg-pink-500/10 rounded-full transition"
                                            title="Kelola Peserta">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('dashboard.events.edit', $e->id) }}"
                                            class="p-2 text-yellow-500 hover:text-yellow-400 hover:bg-yellow-500/10 rounded-full transition"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('dashboard.events.destroy', $e->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus event ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-full transition"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-500">Belum ada event.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 text-xs text-gray-500 text-center">
                &darr; Scroll untuk melihat lebih banyak event &darr;
            </div>
        </div>
    </div>
@endsection