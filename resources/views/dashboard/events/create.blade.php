@extends('layouts.admin')

@section('title', 'Buat Acara')

@section('content')
<div class="min-h-screen bg-slate-100 -m-8 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Buat Acara Baru</h1>
            <a href="{{ route('dashboard.events.index') }}" class="text-sm text-slate-500 hover:text-slate-800">
                Kembali ke Daftar
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

        <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nama Acara -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Nama Acara <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="judul" 
                    value="{{ old('judul') }}"
                    placeholder="Masukkan nama acara"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                    required
                >
            </div>

            <!-- Kategori dan Visibilitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="category_id" 
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        required
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Visibilitas <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="visibility_id" 
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        required
                    >
                        <option value="">Pilih Visibilitas</option>
                        @foreach($visibilities as $visibility)
                            <option value="{{ $visibility->id }}">{{ $visibility->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Waktu Mulai dan Selesai -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Waktu Mulai <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="waktu_mulai" 
                        value="{{ old('waktu_mulai') }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Waktu Selesai <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="datetime-local" 
                        name="waktu_selesai" 
                        value="{{ old('waktu_selesai') }}"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        required
                    >
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="lokasi" 
                    value="{{ old('lokasi') }}"
                    placeholder="Contoh: Ruang Seminar A, Gedung XYZ"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                    required
                >
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Deskripsi
                </label>
                <textarea 
                    name="description" 
                    rows="5"
                    placeholder="Masukkan deskripsi acara..."
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                >{{ old('description') }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Gambar Acara
                </label>
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100"
                >
                <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, JPEG (Max: 2MB)</p>
            </div>

            <!-- Opsi Acara -->
            <div class="border-t border-slate-200 pt-6 mt-6">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Opsi Acara</h3>
                
                <div class="space-y-4">
                    <!-- Harga Tiket -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Harga Tiket (Rp)
                        </label>
                        <input 
                            type="number" 
                            name="harga_tiket" 
                            value="{{ old('harga_tiket', 0) }}"
                            min="0"
                            placeholder="0 untuk gratis"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        >
                        <p class="text-xs text-slate-500 mt-1">Kosongkan atau isi 0 untuk acara gratis</p>
                    </div>

                    <!-- Kapasitas -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Kapasitas Maksimal
                        </label>
                        <input 
                            type="number" 
                            name="kapasitas" 
                            value="{{ old('kapasitas') }}"
                            min="1"
                            max="100000"
                            placeholder="Kosongkan untuk tidak terbatas"
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:border-sky-500 text-slate-800"
                        >
                        <p class="text-xs text-slate-500 mt-1">Kosongkan untuk kapasitas tidak terbatas</p>
                    </div>

                    <!-- Memerlukan Persetujuan -->
                    <div class="flex items-center gap-3">
                        <input 
                            type="checkbox" 
                            name="requires_approval" 
                            id="requires_approval"
                            value="1"
                            {{ old('requires_approval') ? 'checked' : '' }}
                            class="w-5 h-5 text-sky-600 border-slate-300 rounded focus:ring-sky-500"
                        >
                        <label for="requires_approval" class="text-sm font-medium text-slate-700">
                            Memerlukan persetujuan admin untuk pendaftaran
                        </label>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-3 pt-6">
                <button 
                    type="submit"
                    class="flex-1 bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-md hover:shadow-lg"
                >
                    <i class="fa-solid fa-plus mr-2"></i>
                    Buat Acara
                </button>
                <a 
                    href="{{ route('dashboard.events.index') }}"
                    class="px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition-all"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection