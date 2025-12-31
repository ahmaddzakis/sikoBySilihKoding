@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-slate-100 p-8" x-data="{ search: '{{ request('search') }}' }">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
                
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto items-center">
                    <form action="{{ route('dashboard.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto items-center">
                        
                        {{-- Role Filter --}}
                        <div class="relative">
                            <select name="role" onchange="this.form.submit()" class="appearance-none w-full md:w-32 pl-3 pr-8 py-2 rounded-lg border border-slate-300 focus:outline-none focus:border-sky-500 transition-colors text-sm text-black bg-white cursor-pointer">
                                <option value="">Role</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>

                        {{-- SEARCH INPUT --}}
                        <div class="relative w-full md:w-48">
                            <input type="text" name="search" x-model="search"
                                placeholder="Cari..." 
                                class="w-full pl-9 pr-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:border-sky-500 transition-colors text-sm text-black placeholder-slate-500">
                            <div class="absolute left-3 top-2.5 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </form>

                    {{-- CREATE USER BUTTON --}}
                    <a href="{{ route('dashboard.users.create') }}"
                        class="flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-bold px-4 py-2 rounded-lg transition-all shadow-md hover:shadow-lg transform active:scale-95 whitespace-nowrap text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Pengguna
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9; 
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1; 
            border-radius: 4px; 
            border: 2px solid #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8; 
        }
    </style>

            {{-- TABLE CONTAINER --}}
            <div class="overflow-x-auto overflow-y-auto border border-slate-200 rounded-lg custom-scrollbar" style="max-height: 450px;">
                <table class="w-full text-left border-collapse">
                    <thead class="sticky top-0 bg-slate-50 z-10 shadow-sm">
                        <tr class="text-slate-600 text-sm uppercase tracking-wider">
                            <th class="p-4 border-b border-slate-200">Nama</th>
                            <th class="p-4 border-b border-slate-200">Email</th>
                            <th class="p-4 border-b border-slate-200">Peran</th>
                            <th class="p-4 border-b border-slate-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 transition" x-show="!search || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())">
                            <td class="p-4 font-medium text-slate-800">{{ $user->name }}</td>
                            <td class="p-4 text-slate-600">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'bg-blue-100 text-blue-700 border border-blue-200' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @if(auth()->id() !== $user->id)
                                    <div class="flex items-center justify-center gap-2">

                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full transition" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-400 italic">Saat Ini</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-slate-500">Tidak ada pengguna ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 text-xs text-slate-400 text-center">
                &darr; Scroll untuk melihat lebih banyak pengguna &darr;
            </div>
        </div>
    </div>
@endsection
