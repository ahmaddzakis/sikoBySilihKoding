@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-[#1a161f] p-8" x-data="{ search: '{{ request('search') }}' }">
        <div class="max-w-6xl mx-auto bg-[#26212c] rounded-xl shadow-lg overflow-hidden p-8 border border-[#3a3442]">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-white">Manajemen Pengguna</h1>
                
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
                    <form action="{{ route('dashboard.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto items-center">
                        
                        {{-- Role Filter --}}
                        <div class="relative">
                            <select name="role" onchange="this.form.submit()" class="appearance-none w-full md:w-32 pl-3 pr-8 py-2 rounded-lg border border-[#3a3442] focus:outline-none focus:border-pink-500 transition-colors text-sm text-gray-300 bg-[#1a161f] cursor-pointer">
                                <option value="">Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>

                    {{-- CREATE USER BUTTON --}}
                    <a href="{{ route('dashboard.users.create') }}"
                        class="flex items-center gap-2 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-bold px-4 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform active:scale-95 whitespace-nowrap text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Pengguna
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-500/10 border border-green-500/30 text-green-500 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded relative mb-4" role="alert">
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

            {{-- TABLE CONTAINER --}}
            <div class="overflow-x-auto overflow-y-auto border border-[#3a3442] rounded-lg custom-scrollbar" style="max-height: 450px;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-[#1a161f] z-10 shadow-sm">
                        <tr class="text-gray-400 text-sm uppercase tracking-wider">
                            <th class="p-4 border-b border-[#3a3442]">Nama</th>
                            <th class="p-4 border-b border-[#3a3442]">Email</th>
                            <th class="p-4 border-b border-[#3a3442]">Peran</th>
                            <th class="p-4 border-b border-[#3a3442] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#3a3442] text-gray-300">
                        @forelse($users as $user)
                        <tr class="hover:bg-[#3a3442]/30 transition" x-show="!search || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                            <td class="p-4 font-medium text-white">{{ $user->name }}</td>
                            <td class="p-4 text-gray-400">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role === 'admin' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/30' : 'bg-blue-500/20 text-blue-400 border border-blue-500/30' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @if(auth()->id() !== $user->id)
                                    <div class="flex items-center justify-center gap-2">

                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-500 hover:text-red-400 hover:bg-red-500/10 rounded-full transition" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500 italic">Saat Ini</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Tidak ada pengguna ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 text-xs text-gray-500 text-center">
                &darr; Scroll untuk melihat lebih banyak pengguna &darr;
            </div>
        </div>
    </div>
@endsection
