@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">

            {{-- LEFT : EVENT IMAGE --}}
            <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-6 flex items-center justify-center">
                <div class="w-full aspect-square bg-white/20 rounded-lg flex items-center justify-center text-white text-lg">
                    Edit Cover
                </div>
            </div>

            {{-- RIGHT : FORM --}}
            <div class="md:col-span-2 p-8 space-y-6">

                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-slate-800">
                        Edit Event
                    </h1>
                    <a href="{{ route('dashboard.events.index') }}" class="text-sm text-slate-500 hover:text-slate-800">Back onto list</a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('dashboard.events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- EVENT NAME --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-600">
                            Event Name
                        </label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $event->judul) }}"
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
                                value="{{ old('waktu_mulai', $event->waktu_mulai) }}"
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
                                value="{{ old('waktu_selesai', $event->waktu_selesai) }}"
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
                            value="{{ old('lokasi', $event->lokasi) }}"
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
                        >{{ old('description', $event->description) }}</textarea>
                    </div>

                    {{-- CATEGORY --}}
                     <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-600">
                            Category ID (Optional)
                        </label>
                        <input
                            type="number"
                            name="category_id"
                            value="{{ old('category_id', $event->category_id) }}"
                            placeholder="ID Kategori"
                            class="mt-1 w-full rounded-lg border-slate-300"
                        >
                    </div>

                    {{-- BUTTON --}}
                    <div class="pt-6">
                        <button
                            type="submit"
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 rounded-lg transition"
                        >
                            Update Event
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
