@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">

            {{-- LEFT : EVENT IMAGE --}}
            <div class="bg-gradient-to-br from-sky-500 to-indigo-500 p-6 flex items-center justify-center">
                <div class="w-full aspect-square bg-white/20 rounded-lg flex items-center justify-center text-white text-lg">
                    Event Cover
                </div>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="md:col-span-2 p-8 space-y-6">

                <h1 class="text-2xl font-bold text-slate-800">
                    Create Event
                </h1>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                 @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.events.store') }}" method="POST">
                    @csrf

                    {{-- EVENT NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600">
                            Event Name
                        </label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Nama Event"
                            class="mt-1 w-full rounded-lg border-slate-300"
                            required
                        >
                    </div>

                    {{-- DATE & TIME --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-600">
                                Start
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_mulai"
                                value="{{ old('waktu_mulai') }}"
                                class="mt-1 w-full rounded-lg border-slate-300"
                                required
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-600">
                                End
                            </label>
                            <input
                                type="datetime-local"
                                name="waktu_selesai"
                                value="{{ old('waktu_selesai') }}"
                                class="mt-1 w-full rounded-lg border-slate-300"
                                required
                            >
                        </div>
                    </div>

                    {{-- LOCATION --}}
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Location
                        </label>
                        <input
                            type="text"
                            name="lokasi"
                            value="{{ old('lokasi') }}"
                            placeholder="Offline location / Online link"
                            class="mt-1 w-full rounded-lg border-slate-300"
                            required
                        >
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Description
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Deskripsi event"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >{{ old('description') }}</textarea>
                    </div>

                    {{-- CATEGORY --}}
                     <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Category ID (Optional)
                        </label>
                        <input
                            type="number"
                            name="category_id"
                            value="{{ old('category_id') }}"
                            placeholder="ID Kategori"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >
                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-6">
                        <button
                            type="submit"
                            class="w-full bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 rounded-lg transition"
                        >
                            Create Event
                        </button>
                    </div>

                </form>

                {{-- LIST OF EVENTS (CRUD) --}}
                <div class="pt-8 border-t border-slate-200">
                    <h2 class="text-lg font-semibold mb-4">My Events</h2>
                    
                    <div class="space-y-3">
                        @forelse($events as $e)
                            <div class="p-4 border rounded-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50">
                                <div>
                                    <div class="font-medium text-slate-800">{{ $e->judul }}</div>
                                    <div class="text-sm text-slate-500">
                                        {{ \Carbon\Carbon::parse($e->waktu_mulai)->format('d M Y H:i') }} — 
                                        {{ \Carbon\Carbon::parse($e->waktu_selesai)->format('H:i') }}
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('dashboard.events.edit', $e->id) }}" class="px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-yellow-900 rounded text-sm font-medium transition">Edit</a>
                                    <form action="{{ route('dashboard.events.destroy', $e->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus event ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded text-sm font-medium transition">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6 text-slate-500 bg-slate-50 rounded-lg border border-dashed border-slate-300">
                                Belum ada event.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
