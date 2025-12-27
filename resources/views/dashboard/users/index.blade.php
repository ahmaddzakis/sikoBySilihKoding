@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-100 p-8" x-data="{ search: '' }">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h1 class="text-2xl font-bold text-slate-800">Users List</h1>
            
            {{-- SEARCH INPUT --}}
            <div class="relative w-full md:w-64">
                <form action="{{ route('dashboard.users.index') }}" method="GET">
                    <input 
                        type="text" 
                        name="search"
                        value="{{ request('search') }}"
                        x-model="search" 
                        placeholder="Cari user (Enter for DB)..." 
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-300 focus:outline-none focus:border-blue-500 transition-colors"
                    >
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
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

        {{-- TABLE CONTAINER --}}
        {{-- Max-height approx for 7 rows (header + 7 rows ~ 500px) --}}
        <div class="overflow-x-auto overflow-y-auto border border-slate-200 rounded-lg custom-scrollbar" style="max-height: 500px;">
            <table class="w-full text-left border-collapse">
                <thead class="sticky top-0 bg-slate-50 z-10 shadow-sm">
                    <tr class="text-slate-600 text-sm uppercase tracking-wider">
                        <th class="p-4 border-b border-slate-200">Name</th>
                        <th class="p-4 border-b border-slate-200">Email</th>
                        <th class="p-4 border-b border-slate-200">Role</th>
                        <th class="p-4 border-b border-slate-200 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition" 
                        x-show="search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())"
                    >
                        <td class="p-4 font-medium">{{ $user->name }}</td>
                        <td class="p-4">{{ $user->email }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            @if(auth()->id() !== $user->id)
                                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Delete User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <span class="text-xs text-slate-400">Current User</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-slate-500">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-xs text-slate-400 text-center">
            &darr; Scroll untuk melihat lebih banyak user &darr;
        </div>
    </div>
</div>
@endsection
