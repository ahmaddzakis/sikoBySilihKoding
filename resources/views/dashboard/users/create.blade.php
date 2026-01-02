@extends('layouts.admin')

@section('title', 'Buat Pengguna')

@section('content')
<div class="min-h-screen bg-[#1a161f] p-8 -m-8">
    <div class="max-w-2xl mx-auto bg-[#26212c] rounded-xl shadow-lg overflow-hidden p-8 border border-[#3a3442]">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Buat Pengguna Baru</h1>
            <a href="{{ route('dashboard.users.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                Kembali ke Daftar
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-500 px-4 py-3 rounded-lg relative mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Nama <span class="text-pink-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama pengguna"
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Email <span class="text-pink-500">*</span>
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    placeholder="Masukkan alamat email"
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                    required
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Password <span class="text-pink-500">*</span>
                </label>
                <input 
                    type="password" 
                    name="password" 
                    placeholder="Masukkan password (min. 6 karakter)"
                    class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 placeholder-gray-600 transition-colors"
                    required
                >
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Peran (Role) <span class="text-pink-500">*</span>
                </label>
                <div class="relative">
                    <select 
                        name="role" 
                        class="w-full px-4 py-3 bg-[#1a161f] border border-[#3a3442] rounded-lg focus:outline-none focus:border-pink-500 text-gray-200 appearance-none cursor-pointer transition-colors"
                        required
                    >
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                     <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-3 pt-6">
                <button 
                    type="submit"
                    class="flex-1 bg-gradient-to-r from-pink-600 to-purple-600 hover:from-pink-500 hover:to-purple-500 text-white font-bold py-3 px-6 rounded-lg transition-all shadow-lg hover:shadow-pink-500/25"
                >
                    <i class="fa-solid fa-plus mr-2"></i>
                    Buat Pengguna
                </button>
                <a 
                    href="{{ route('dashboard.users.index') }}"
                     class="px-6 py-3 bg-[#3a3442] hover:bg-[#4d4554] text-gray-200 font-medium rounded-lg transition-all"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
