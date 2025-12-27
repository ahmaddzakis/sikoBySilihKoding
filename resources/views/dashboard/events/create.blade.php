@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-slate-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Create Event</h1>
            <a href="{{ route('dashboard.events.index') }}" class="text-slate-500 hover:text-slate-700 font-medium text-sm">
                &larr; Back to List
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.events.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- EVENT NAME --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Event Name
                </label>
                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Nama Event"
                    class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                    required
                >
            </div>

            {{-- DATE & TIME --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Start Date & Time
                    </label>
                    <input
                        type="datetime-local"
                        name="waktu_mulai"
                        value="{{ old('waktu_mulai') }}"
                        class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        End Date & Time
                    </label>
                    <input
                        type="datetime-local"
                        name="waktu_selesai"
                        value="{{ old('waktu_selesai') }}"
                        class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                        required
                    >
                </div>
            </div>

            {{-- LOCATION --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Location
                </label>
                <input
                    type="text"
                    name="lokasi"
                    value="{{ old('lokasi') }}"
                    placeholder="Offline location / Online link"
                    class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                    required
                >
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Description
                </label>
                <textarea
                    name="description"
                    rows="4"
                    placeholder="Deskripsi event"
                    class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                >{{ old('description') }}</textarea>
            </div>

            {{-- CATEGORY --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">
                    Category ID (Optional)
                </label>
                <input
                    type="number"
                    name="category_id"
                    value="{{ old('category_id') }}"
                    placeholder="ID Kategori"
                    class="w-full rounded-lg border-slate-300 focus:border-sky-500 focus:ring-sky-500"
                >
            </div>

            {{-- BUTTON --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 rounded-lg transition shadow-md hover:shadow-lg transform active:scale-95"
                >
                    Create Event
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
